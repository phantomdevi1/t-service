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
        <div class="slider">
             <div class="slides">
            <!-- Слайды изображений -->
                <div class="slide">
                    <img src="img/slider1.jpg" alt="Слайд 1">
                </div>
                <div class="slide">
                    <img src="img/slider2.jpg" alt="Слайд 2">
                </div>
                <div class="slide">
                    <img src="img/slider3.jpg" alt="Слайд 3">
                </div>
             </div>
    <!-- Кнопки навигации -->
        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>
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
    <script>
       let slideIndex = 0;
        showSlides();

        setInterval(function() {
            plusSlides(1);
        }, 6000);

        function plusSlides(n) {
            slideIndex += n;
            showSlides();
        }

        function showSlides() {
            let slides = document.getElementsByClassName("slide");
            if (slideIndex >= slides.length) { slideIndex = 0; }
            if (slideIndex < 0) { slideIndex = slides.length - 1; }
            for (let i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            slides[slideIndex].style.display = "block";
        }

    </script>
</body>
</html>