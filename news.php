<?php
// Подключение к базе данных
include 'config.php';

// Запрос для получения всех новостей
$sql = "SELECT title, content, published_at FROM news ORDER BY published_at DESC";
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
        <a href="index.php" class="header_page-first_href">главная</a>
        <img src="img/logo_header.png" alt="">
        <a href="" class="header_page-second_href">авторизация</a>
    </header>
    <div class="content">
        <p class="title_page">новости</p>
        <div class="news_block">
            <?php if ($result->num_rows > 0): ?>
                <?php while($news = $result->fetch_assoc()): ?>
                    <div class="block_with_news">
                        <p class="title_news_block">🚗 <?= htmlspecialchars($news['title']) ?> 🚗</p>
                        <hr class="hr_news_block">
                        <p class="content_news_block"><?= nl2br(htmlspecialchars($news['content'])) ?></p>
                        <hr class="hr_news_block">
                        <p class="content_news_date"><?= date('d.m.Y', strtotime($news['published_at'])) ?></p>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>Новостей нет.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>

<?php
$conn->close();
?>
