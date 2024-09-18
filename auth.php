<?php
session_start();


include 'config.php';


$error_message = '';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    $phone = $conn->real_escape_string($phone);

    $sql = "SELECT * FROM users WHERE phone = '$phone'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if ($password === $user['password']) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];


            if ($user['role'] === 'admin') {
                header('Location: admin_dashboard.php');
                exit();
            } else {
                header('Location: client_dashboard.php');
                exit();
            }
        } else {
            $error_message = 'Неправильный пароль';
        }
    } else {
        $error_message = 'Пользователь с таким номером телефона не найден';
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Авторизация</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="img/favicon.svg" type="image/x-icon">
    

    <script>
        function showError(message) {
            if (message) {
                alert(message);
            }
        }
    </script>
</head>
<body onload="showError('<?= htmlspecialchars($error_message) ?>')">
    <header class="header_page">
        <a href="index.php" class="header_page-first_href">главная</a>
        <img src="img/logo_header.png" alt="">
        <a href="news.php" class="header_page-second_href">новости</a>
    </header>
    <div class="content">
        <div class="auth_block">
            <p>авторизация</p>
            <form method="POST" action="">
                <input type="text" name="phone" class="login_auth" placeholder="Номер телефона" required>
                <input type="password" name="password" class="password_auth" placeholder="Пароль" required>
                <input type="submit" value="войти" class="submit_auth">
            </form>
        </div>
    </div>
</body>
</html>
