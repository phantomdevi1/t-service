<?php
session_start();

// Проверка авторизации администратора
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: auth.php');
    exit();
}

// Подключаемся к базе данных
include 'config.php';

// Получаем записи на сервис, включая информацию о пользователе и услуге
$sql = "
    SELECT 
        u.name AS client_name, 
        u.phone AS client_phone, 
        u.email AS client_email, 
        s.name AS service_name, 
        s.price AS service_price, 
        b.appointment_date 
    FROM service_bookings b
    JOIN users u ON b.user_id = u.id
    JOIN services s ON b.service_id = s.id
    ORDER BY b.created_at DESC";

$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Запись на сервис</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="img/favicon.svg" type="image/x-icon">
</head>
<body>
<header class="header_page">
    <a href="admin_dashboard.php" class="header_page-first_href">Главная</a>
    <img src="img/logo_header.png" alt="Логотип">
    <a href="logout.php" class="header_page-second_href">Выйти</a>
</header>

<div class="content">
    <p class="title_page">Запись на сервис</p>

    <?php if ($result->num_rows > 0): ?>
        <table class="call_requests_table">
            <thead>
                <tr>
                    <th>Имя</th>
                    <th>Телефон</th>
                    <th>Email</th>
                    <th>Услуга</th>
                    <th>Желаемое время записи</th>
                    <th>Цена</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['client_name']) ?></td>
                        <td><?= htmlspecialchars($row['client_phone']) ?></td>
                        <td><?= htmlspecialchars($row['client_email']) ?></td>
                        <td><?= htmlspecialchars($row['service_name']) ?></td>
                        <td><?= htmlspecialchars($row['appointment_date']) ?></td>
                        <td><?= htmlspecialchars($row['service_price']) ?> руб.</td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Нет записей на сервис.</p>
    <?php endif; ?>
</div>
</body>
</html>
