<?php
session_start();


if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'client') {
    header('Location: auth.php');
    exit();
}


include 'config.php';

$success_message = '';
$error_message = '';


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['service_id'], $_POST['appointment_date'])) {
    $user_id = $_SESSION['user_id'];
    $service_id = intval($_POST['service_id']);
    $appointment_date = $_POST['appointment_date'];

    
    $check_sql = "SELECT COUNT(*) AS cnt FROM service_bookings WHERE service_id = ? AND appointment_date = ?";
    $stmt = $conn->prepare($check_sql);
    $stmt->bind_param("is", $service_id, $appointment_date);
    $stmt->execute();
    $stmt->bind_result($cnt);
    $stmt->fetch();
    $stmt->close();

    if ($cnt > 0) {
        $error_message = "Эта дата и время уже заняты. Пожалуйста, выберите другое время.";
    } else {
        
        $sql = "INSERT INTO service_bookings (user_id, service_id, appointment_date) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iis", $user_id, $service_id, $appointment_date);

        if ($stmt->execute()) {
            $success_message = "Вы успешно записались на услугу!";
        } else {
            $error_message = "Ошибка при записи: " . $conn->error;
        }

        $stmt->close();
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
    <a href="logout.php" class="header_page-second_href">Выйти</a>
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
            <label for="appointment_date">Выберите дату и время:</label>
            <input type="datetime-local" name="appointment_date" required>
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

            fetch(`get_booked_dates.php?service_id=${serviceId}`)
                .then(response => response.json())
                .then(bookedDates => {
                    let datetimeInput = document.querySelector('input[name="appointment_date"]');
                    datetimeInput.value = ''; 

                    
                    datetimeInput.addEventListener('input', function () {
                        let selectedDate = new Date(this.value);
                        let isDateBooked = bookedDates.some(date => new Date(date).getTime() === selectedDate.getTime());

                        
                        if (isDateBooked) {
                            alert('Эта дата и время уже заняты. Выберите другое время.');
                            this.value = ''; 
                        }
                    });
                })
                .catch(error => console.error('Ошибка загрузки занятых дат:', error));
        } else {
            document.getElementById('service_details').style.display = 'none';
        }
    }
</script>

</body>
</html>
