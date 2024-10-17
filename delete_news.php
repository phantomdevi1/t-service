<?php
// Подключаем конфигурационный файл
require_once 'config.php';

// Если был запрос на удаление новости
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $stmt = $conn->prepare("DELETE FROM news WHERE id = ?");
    $stmt->bind_param('i', $delete_id);
    $stmt->execute();
    header("Location: delete_news.php");
    exit;
}

// Выбор новостей из базы данных
$sql = "SELECT * FROM news ORDER BY published_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Новости</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="img/favicon.svg" type="image/x-icon">
</head>
<body>
<header class="header_page">
    <a href="admin_dashboard.php" class="header_page-first_href">главная</a>
    <img src="img/logo_header.png" alt="Логотип">
    <a href="logout.php" class="header_page-second_href">выйти</a>
</header>

<div class="news_block">
    <?php if ($result->num_rows > 0): ?>
        <?php while ($news = $result->fetch_assoc()): ?>
            <div class="block_with_news">
                <h2 class="title_news_block"><?= htmlspecialchars($news['title']) ?></h2>
                <hr class="hr_news_block">
                <p class="content_news_block"><?= htmlspecialchars($news['content']) ?></p>
                <hr class="hr_news_block">
                <p class="content_news_date">Опубликовано: <?= $news['published_at'] ?></p>
                <a href="delete_news.php?delete_id=<?= $news['id'] ?>" class="delete_news_btn" onclick="return confirm('Удалить эту новость?')">удалить новость</a>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>Новостей пока нет.</p>
    <?php endif; ?>
</div>

</body>
</html>
