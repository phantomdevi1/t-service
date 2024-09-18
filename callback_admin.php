<?php
session_start();

// Проверка авторизации администратора
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: auth.php');
    exit();
}

// Подключаемся к базе данных
include 'config.php';

// Получаем запросы на звонок
$sql = "SELECT * FROM call_requests ORDER BY created_at DESC";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Запросы на звонок</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="img/favicon.svg" type="image/x-icon">
</head>
<body>
    <header class="header_page">
        <a href="admin_dashboard.php" class="header_page-first_href">главная</a>
        <img src="img/logo_header.png" alt="">
        <a href="logout.php" class="header_page-second_href">выйти</a>
    </header>

    <div class="content">
        <p class="title_page">запросы на звонок</p>

        <?php if ($result->num_rows > 0): ?>
            <table class="call_requests_table">
                <thead>
                    <tr>
                        <th>Имя</th>
                        <th>Телефон</th>
                        <th>Email</th>
                        <th>Дата запроса</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['name']) ?></td>
                            <td><?= htmlspecialchars($row['phone']) ?></td>
                            <td><?= htmlspecialchars($row['email']) ?></td>
                            <td><?= htmlspecialchars($row['created_at']) ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Нет запросов на звонок.</p>
        <?php endif; ?>
    </div>
</body>
</html>
