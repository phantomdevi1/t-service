<?php
session_start();

// Проверяем, авторизован ли пользователь и является ли он клиентом
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'client') {
    header('Location: auth.php'); // Если нет, перенаправляем на страницу авторизации
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Личный кабинет клиента</title>
</head>
<body>
    <h1>Добро пожаловать в личный кабинет</h1>
</body>
</html>
