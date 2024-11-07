<?php
session_start();


if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'client') {
    header('Location: auth.php');
    exit();
}


include 'config.php';

$success_message = '';
$error_message = '';


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['service_id'], $_POST['appointment_date'], $_POST['appointment_time'])) {
    $user_id = $_SESSION['user_id'];
    $service_id = intval($_POST['service_id']);
    $appointment_date = $_POST['appointment_date'];
    $appointment_time = $_POST['appointment_time'];

    // Объединяем дату и время
    $appointment_datetime = $appointment_date . ' ' . $appointment_time . ':00';
    $appointment_datetime_object = new DateTime($appointment_datetime);
    $current_datetime = new DateTime();

    // Проверяем, что выбранное время в будущем
    if ($appointment_datetime_object <= $current_datetime) {
        $error_message = "Вы не можете выбрать прошедшую дату и время. Пожалуйста, выберите будущую дату и время.";
    } else {
        // Проверка занятости выбранного времени
        $check_sql = "SELECT COUNT(*) AS cnt FROM service_bookings WHERE service_id = ? AND appointment_date = ?";
        $stmt = $conn->prepare($check_sql);
        $stmt->bind_param("is", $service_id, $appointment_datetime);
        $stmt->execute();
        $stmt->bind_result($cnt);
        $stmt->fetch();
        $stmt->close();

        if ($cnt > 0) {
            $error_message = "Эта дата и время уже заняты. Пожалуйста, выберите другое время.";
        } else {
            // Вставка записи
            $sql = "INSERT INTO service_bookings (user_id, service_id, appointment_date) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("iis", $user_id, $service_id, $appointment_datetime);

            if ($stmt->execute()) {
                $success_message = "Вы успешно записались на услугу!";
            } else {
                $error_message = "Ошибка при записи: " . $conn->error;
            }

            $stmt->close();
        }
    }
}



$categories_sql = "SELECT id, name FROM service_categories";
$categories_result = $conn->query($categories_sql);


$conn->close();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>личный кабинет</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="img/favicon.svg" type="image/x-icon">
</head>
<body>
<header class="header_page">
    <img src="img/logo_header.png" alt="Logo">
    <a href="logout.php" class="header_page-second_href">выйти</a>
</header>

<div class="content">
    <p class="title_page">запись на сервис</p>

    <div class="order_service_block">
    <?php if ($error_message): ?>
        <div class="error_message"><?= htmlspecialchars($error_message) ?></div>
    <?php elseif ($success_message): ?>
        <div class="success_message"><?= htmlspecialchars($success_message) ?></div>
    <?php endif; ?>

    <label class="title_service_block" for="category">категории ремонтов:</label>
    <select id="category" name="category" onchange="loadServices(this.value)">
        <option value="">выберите категорию</option>
        <?php while ($row = $categories_result->fetch_assoc()): ?>
            <option value="<?= $row['id'] ?>"><?= htmlspecialchars($row['name']) ?></option>
        <?php endwhile; ?>
    </select>

    <div id="services_block" style="display:none;">
        <label class="title_service_block" for="services">услуги:</label>
        <select id="services" name="services" onchange="loadServiceDetails()">
            <option value="">выберите услугу</option>
        </select>
    </div>

    <div id="service_details" style="display:none;">
        <h3 id="service_name"></h3>
        <p id="service_description"></p>
        <p id="service_price"></p>

        <form method="POST" action="">
            <label for="appointment_date">Выберите дату:</label>
            <input type="date" name="appointment_date" required>

            <label for="appointment_time">Выберите время:</label>
            <select name="appointment_time" required>
                <option value="">Выберите время</option>
                <option value="09:00">9:00</option>
                <option value="11:00">11:00</option>
                <option value="13:00">13:00</option>
                <option value="15:00">15:00</option>
                <option value="17:00">17:00</option>
                <option value="19:00">19:00</option>
            </select>


            <input type="hidden" id="service_id" name="service_id">
            <button type="submit">Записаться</button>
        </form>


    </div>
</div>
</div>

<script>
    function loadServices(categoryId) {
        if (categoryId) {
            fetch(`get_services.php?category_id=${categoryId}`)
                .then(response => response.json())
                .then(data => {
                    let servicesSelect = document.getElementById('services');
                    servicesSelect.innerHTML = '<option value="">Выберите услугу</option>';
                    data.forEach(service => {
                        servicesSelect.innerHTML += `<option value="${service.id}" data-description="${service.description}" data-price="${service.price}">${service.name}</option>`;
                    });
                    document.getElementById('services_block').style.display = 'grid';
                })
                .catch(error => console.error('Ошибка загрузки услуг:', error));
        } else {
            document.getElementById('services_block').style.display = 'none';
            document.getElementById('service_details').style.display = 'none';
        }
    }

    
    function loadServiceDetails() {
    let selectedOption = document.getElementById('services').selectedOptions[0];
    if (selectedOption.value !== "") {
        let serviceId = selectedOption.value;
        let serviceName = selectedOption.textContent;
        let serviceDescription = selectedOption.getAttribute('data-description');
        let servicePrice = selectedOption.getAttribute('data-price');

        document.getElementById('service_name').textContent = serviceName;
        document.getElementById('service_description').textContent = serviceDescription;
        document.getElementById('service_price').textContent = 'Цена: ' + servicePrice + ' руб.';
        document.getElementById('service_id').value = serviceId;
        document.getElementById('service_details').style.display = 'flex';

        // Сброс времени, если дата или услуга изменена
        document.querySelector('select[name="appointment_time"]').value = "";

        // Добавляем обработчик для поля даты
        document.querySelector('input[name="appointment_date"]').addEventListener('change', function () {
            let appointmentDate = this.value;
            if (appointmentDate) {
                // Запрос занятых временных слотов для выбранной даты и услуги
                fetch(`get_booked_dates.php?service_id=${serviceId}&appointment_date=${appointmentDate}`)
                    .then(response => response.json())
                    .then(bookedTimes => {
                        let timeSelect = document.querySelector('select[name="appointment_time"]');
                        timeSelect.querySelectorAll('option').forEach(option => {
                            // Делаем все опции активными перед применением новых данных
                            option.disabled = false;
                        });

                        // Делаем занятые временные слоты некликабельными
                        bookedTimes.forEach(bookedTime => {
                            let timeOption = timeSelect.querySelector(`option[value="${bookedTime.slice(0,5)}"]`);
                            if (timeOption) {
                                timeOption.disabled = true;
                            }
                        });
                    })
                    .catch(error => console.error('Ошибка загрузки занятых временных слотов:', error));
            }
        });
    } else {
        document.getElementById('service_details').style.display = 'none';
    }
    }


    document.querySelector('form').addEventListener('submit', function(e) {
    let dateInput = document.querySelector('input[name="appointment_date"]').value;
    let timeSelect = document.querySelector('select[name="appointment_time"]').value;

    if (!dateInput || !timeSelect) {
        alert('Пожалуйста, выберите дату и время для записи.');
        e.preventDefault();
        return;
    }

    // Проверка, что выбранное время в будущем
    let selectedDateTime = new Date(`${dateInput}T${timeSelect}`);
    let currentDateTime = new Date();

    if (selectedDateTime <= currentDateTime) {
        alert('Вы не можете выбрать прошедшую дату и время. Пожалуйста, выберите будущую дату и время.');
        e.preventDefault();
    }
    });


</script>

</body>
</html>
