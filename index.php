<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="img/favicon.svg" type="image/x-icon">
</head>
<body>
    <header class="header_index">
        <a href="news.php">новости</a>        
        <img src="img/logo_index.png" alt="">
        <a href="auth.php">авторизация</a>
    </header> 
    <script src="button_up.js"></script>
    <button id="scrollToTopBtn" onclick="scrollToTop()">&#8593;</button>
 
    <div class="index_content">
    <div class="video-container">
        <iframe src="https://vk.com/video_ext.php?oid=-222651806&id=456239040&hd=4&autoplay=1&loop=1&controls=0" 
                width="100%" height="100%" 
                allow="autoplay; encrypted-media; fullscreen; picture-in-picture; screen-wake-lock;" 
                frameborder="0" allowfullscreen>
        </iframe>
    </div>


        <div class="slogan-block">
            <p>Т-Service — экспертный ремонт вашего TANK, на который можно положиться!</p>
        </div>
        <div class="advantages-block">
            <div class="first_slogan-block">
                <img class="slogan_img" src="img/first_img.png" alt="">
                <p class="slogan_text">Фиксированная стоимость обслуживания вне зависимости от внешних факторов</p>
            </div>

            <div class="second_slogan-block">
                <p class="slogan_text">Своевременное качественное ТО Вашего автомобиля в соответствии со стандартами</p>
                <img class="slogan_img" src="img/second_img.png" alt="">
            </div>

            <div class="third_slogan-block">
                <img class="slogan_img" src="img/third_img.png" alt="">
                <p class="slogan_text">Фиксированная стоимость обслуживания вне зависимости от внешних факторов</p>
            </div>
        </div>

        <div class="our_temmates_block">
            <p class="title_info_block">наша команда</p>
            <div class="temmate_info-block">
                <div class="temmate_info">
                    <p class="temmate_info-title">главный механник</p>
                    <img src="img/mechanik.svg" alt="">
                    <p class="temmate_info-content">Орлова Марья Валерьевна</p>
                </div>
                <div class="temmate_info">
                    <p class="temmate_info-title">директор</p>
                    <img src="img/director.svg" alt="">
                    <p class="temmate_info-content">Фомина Валерия Владимировна</p>
                </div>
                <div class="temmate_info">
                    <p class="temmate_info-title">менеджер</p>
                    <img src="img/manager.svg" alt="">
                    <p class="temmate_info-content">Савёлова Анна Андреевна</p>
                </div>
            </div>
        </div>

    <form action="submit_callback.php" method="POST" class="form_backcall">
        <p>остались вопросы?</p>
        <input class="backcall_input" type="number" name="number_phone" placeholder="номер телефона" required>
        <input class="backcall_input" type="text" name="name_callback" placeholder="имя" required>
        <input class="backcall_input" type="email" name="mail_callback" placeholder="e-mail" required>
        <input class="callback_btn" type="submit" name="callback_input" value="заказать звонок">
    </form>

    </div>

    <footer>
        <img src="img/logo_white.svg" alt="">
        <p>всегда выбирайте лучшее</p>
    </footer>

</body>
</html>