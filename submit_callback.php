<?php
// Подключаем файл конфигурации с подключением к базе данных
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Получаем данные с формы
    $name = $_POST['name_callback'];
    $phone = $_POST['number_phone'];
    $email = $_POST['mail_callback'];

    // Проверяем, что все поля заполнены
    if (!empty($name) && !empty($phone) && !empty($email)) {
        // Подготовка SQL-запроса для добавления записи
        $sql = "INSERT INTO call_requests (name, phone, email) VALUES (?, ?, ?)";
        
        // Подготавливаем запрос
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            // Привязываем параметры
            $stmt->bind_param("sss", $name, $phone, $email);

            // Выполняем запрос
            if ($stmt->execute()) {
                // Если успешно, показываем сообщение
                echo "
                <div class='notification'>
                    <p>Заявка успешно отправлена! Вы будете перенаправлены через 5 секунд...</p>
                </div>
                <script>
                    setTimeout(function() {
                        window.location.href = 'index.php';
                    }, 5000);
                </script>
                ";
            } else {
                echo "Ошибка при отправке заявки: " . $stmt->error;
            }

            // Закрываем подготовленный запрос
            $stmt->close();
        } else {
            echo "Ошибка при подготовке запроса: " . $conn->error;
        }
    } else {
        echo "Все поля формы должны быть заполнены!";
    }
} else {
    echo "Некорректный метод отправки данных.";
}

// Закрываем соединение с базой данных
$conn->close();
?>
<style>

.notification {
    position: fixed;
    top: 20%;
    left: 50%;
    transform: translateX(-50%);
    background-color: #B5CFB7;
    color: white;
    padding: 20px;
    font-size: 18px;
    border-radius: 5px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    text-align: center;
    z-index: 1000;
    width: 300px;
}

.notification p {
    margin: 0;
}
</style>
