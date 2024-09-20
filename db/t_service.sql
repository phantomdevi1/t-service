-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Сен 20 2024 г., 19:13
-- Версия сервера: 8.0.19
-- Версия PHP: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `t_service`
--

-- --------------------------------------------------------

--
-- Структура таблицы `call_requests`
--

CREATE TABLE `call_requests` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=;

--
-- Дамп данных таблицы `call_requests`
--

INSERT INTO `call_requests` (`id`, `name`, `phone`, `email`, `created_at`) VALUES
(1, 'илья', '89', 'ilia@mail.ru', '2024-09-17 16:51:31'),
(2, 'илья', '8943', 'ilia@mail.ru', '2024-09-17 16:52:37');

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

CREATE TABLE `news` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `published_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=;

--
-- Дамп данных таблицы `news`
--

INSERT INTO `news` (`id`, `title`, `content`, `published_at`) VALUES
(1, 'Акция недели в T-Service', 'Только на этой неделе мы предлагаем замену масла со скидкой 20%! Записывайтесь заранее, количество мест ограничено!', '2024-09-12 07:00:00'),
(2, 'Новый TANK на складе', 'Приглашаем вас ознакомиться с новым поступлением внедорожников TANK. Специальные условия для первых покупателей!', '2024-09-10 11:00:00'),
(3, 'График работы на праздники', 'В праздничные дни наш сервис будет работать по измененному графику. Просим уточнять расписание у менеджеров.', '2024-09-08 06:00:00'),
(4, 'Осеннее ТО со скидкой', 'Осень — время подготовки автомобиля к зиме! Мы предлагаем вам пройти техническое обслуживание со скидкой 15%.', '2024-09-05 09:30:00'),
(5, 'Новинка: масло для TANK', 'Мы рады сообщить, что у нас появились новые высококачественные масла для внедорожников TANK. Заказывайте прямо сейчас!', '2024-09-02 08:00:00'),
(6, 'тест', 'тест', '2024-09-18 18:59:58');

-- --------------------------------------------------------

--
-- Структура таблицы `services`
--

CREATE TABLE `services` (
  `id` bigint UNSIGNED NOT NULL,
  `category_id` int DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=;

--
-- Дамп данных таблицы `services`
--

INSERT INTO `services` (`id`, `category_id`, `name`, `description`, `price`) VALUES
(1, 1, 'Замена масла', 'Замена моторного масла с использованием оригинальных масел и фильтров TANK.', '120.00'),
(2, 1, 'Замена тормозной жидкости', 'Полная замена тормозной жидкости для обеспечения безопасного торможения.', '80.00'),
(3, 1, 'Замена антифриза', 'Сервисная замена охлаждающей жидкости для поддержания оптимальной работы двигателя.', '100.00'),
(4, 2, 'Компьютерная диагностика', 'Проведение комплексной диагностики всех электронных систем автомобиля.', '60.00'),
(5, 2, 'Ремонт подвески', 'Ремонт подвески, включая замену амортизаторов, стоек и втулок.', '150.00'),
(6, 2, 'Диагностика тормозной системы', 'Диагностика тормозов, проверка дисков и колодок.', '40.00'),
(7, 3, 'Регламентное ТО', 'Полное техническое обслуживание, включающее замену масла, фильтров и проверку основных систем.', '200.00'),
(8, 3, 'Замена ремня ГРМ', 'Замена ремня газораспределительного механизма для обеспечения синхронизации работы двигателя.', '250.00'),
(9, 3, 'Замена свечей зажигания', 'Заменим свечи зажигания для улучшения запуска и работы двигателя.', '50.00'),
(10, 4, 'Шиномонтаж', 'Замена и монтаж шин с проверкой состояния колёс.', '30.00'),
(11, 4, 'Балансировка колес', 'Балансировка всех четырёх колёс для комфортного и безопасного вождения.', '40.00'),
(12, 4, 'Проверка давления в шинах', 'Проверка и корректировка давления во всех шинах.', '10.00'),
(13, 5, 'Локальная покраска кузова', 'Покраска отдельных частей кузова с устранением мелких дефектов.', '300.00'),
(14, 5, 'Полировка кузова', 'Полная полировка кузова для устранения мелких царапин и защиты лакокрасочного покрытия.', '150.00'),
(15, 5, 'Ремонт вмятин без покраски', 'Удаление вмятин на кузове автомобиля без необходимости перекрашивания.', '200.00'),
(16, 6, 'Ремонт системы электроники', 'Диагностика и ремонт бортовой электроники, включая мультимедийные системы.', '100.00'),
(17, 6, 'Замена аккумулятора', 'Полная замена аккумуляторной батареи с проверкой системы зарядки.', '90.00'),
(18, 6, 'Установка дополнительного оборудования', 'Установка парковочных датчиков, камер заднего вида и другого оборудования.', '150.00');

-- --------------------------------------------------------

--
-- Структура таблицы `service_bookings`
--

CREATE TABLE `service_bookings` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int DEFAULT NULL,
  `service_id` int DEFAULT NULL,
  `appointment_date` timestamp NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=;

--
-- Дамп данных таблицы `service_bookings`
--

INSERT INTO `service_bookings` (`id`, `user_id`, `service_id`, `appointment_date`, `created_at`) VALUES
(1, 3, 8, '2024-09-19 13:15:00', '2024-09-19 13:15:30'),
(2, 3, 8, '2024-09-19 13:15:00', '2024-09-19 13:15:53'),
(3, 3, 8, '2024-09-19 13:15:00', '2024-09-19 13:19:43'),
(4, 3, 1, '2024-09-19 13:24:00', '2024-09-19 13:28:30'),
(5, 3, 1, '2024-09-19 13:28:00', '2024-09-19 13:28:41'),
(6, 3, 4, '2024-09-20 13:57:00', '2024-09-20 14:02:42');

-- --------------------------------------------------------

--
-- Структура таблицы `service_categories`
--

CREATE TABLE `service_categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=;

--
-- Дамп данных таблицы `service_categories`
--

INSERT INTO `service_categories` (`id`, `name`) VALUES
(1, 'Замена жидкостей'),
(2, 'Диагностика и ремонт'),
(3, 'Техническое обслуживание'),
(4, 'Шиномонтаж и балансировка'),
(5, 'Кузовной ремонт'),
(6, 'Электрика и электроника');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','client') DEFAULT 'client'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `password`, `role`) VALUES
(1, 'Admin', 'admin@example.com', '1', '1234', 'admin'),
(3, 'Эдвард', 'client@example.com', '2', '1234', 'client');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `call_requests`
--
ALTER TABLE `call_requests`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `service_bookings`
--
ALTER TABLE `service_bookings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `service_categories`
--
ALTER TABLE `service_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `call_requests`
--
ALTER TABLE `call_requests`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `news`
--
ALTER TABLE `news`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT для таблицы `service_bookings`
--
ALTER TABLE `service_bookings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `service_categories`
--
ALTER TABLE `service_categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
