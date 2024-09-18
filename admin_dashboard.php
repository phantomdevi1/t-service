<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: auth.php'); 
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>панель администратора</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="img/favicon.svg" type="image/x-icon">
</head>
<body>
    <header class="header_page">
        <img src="img/logo_header.png" alt="">
        <a href="logout.php" class="header_page-second_href">выйти</a>
    </header>
    <div class="admin_panel_block">
        <div class="cart_admin_panel"><a href="new_news.php"><img src="img/news_card.png" alt=""></a></div>
        <div class="cart_admin_panel"><a href="services_admin.php"><img src="img/order_card.png" alt=""></a></div>
        <div class="cart_admin_panel"><a href="callback_admin.php"><img src="img/call_card.png" alt=""></a></div>
    </div>
</body>
</html>