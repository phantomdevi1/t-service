window.onscroll = function() {
    let scrollToTopBtn = document.getElementById("scrollToTopBtn");
    if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
        scrollToTopBtn.style.display = "block";
    } else {
        scrollToTopBtn.style.display = "none";
    }
};

// Функция для прокрутки страницы вверх
function scrollToTop() {
    window.scrollTo({
        top: 0,
        behavior: "smooth"
    });
}