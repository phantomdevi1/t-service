<?php
session_start();

// Завершаем сессию
session_destroy();

// Перенаправляем пользователя на страницу авторизации
header('Location: auth.php');
exit();
?>