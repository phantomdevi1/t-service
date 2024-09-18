<?php
session_start();

// Проверка авторизации администратора
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: auth.php');
    exit();
}

include 'config.php';

$success_message = '';
$error_message = '';

// Если форма отправлена
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получаем данные из формы
    $title = $_POST['title'];
    $content = $_POST['content'];

    if (!empty($title) && !empty($content)) {
        $stmt = $conn->prepare("INSERT INTO news (title, content, published_at) VALUES (?, ?, NOW())");
        $stmt->bind_param("ss", $title, $content);

        if ($stmt->execute()) {
            $success_message = 'Новость успешно добавлена!';
        } else {
            $error_message = 'Ошибка при добавлении новости: ' . $conn->error;
        }

        $stmt->close();
    } else {
        $error_message = 'Пожалуйста, заполните все поля.';
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>добавление новостей</title>
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
        <p class="title_page">Добавление новостей</p>

        <?php if ($success_message): ?>
            <p style="color: green;"><?= htmlspecialchars($success_message) ?></p>
        <?php elseif ($error_message): ?>
            <p style="color: red;"><?= htmlspecialchars($error_message) ?></p>
        <?php endif; ?>

        <form method="POST" action="" class="form_grid">
            <input class="input_title_news" type="text" name="title" placeholder="Заголовок" required>
            <textarea class="textarea_content_news" name="content" placeholder="Текст новости" required></textarea>
            <input class="submit_new_news" type="submit" value="Добавить новость">
        </form>
    </div>
</body>
</html>
