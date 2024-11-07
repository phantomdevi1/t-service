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

-- База данных: `sfchizhmai`

-- --------------------------------------------------------

-- Структура таблицы `service_categories`
CREATE TABLE `service_categories` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB;

-- Дамп данных таблицы `service_categories`
INSERT INTO `service_categories` (`id`, `name`) VALUES
(1, 'Замена жидкостей'),
(2, 'Диагностика и ремонт'),
(3, 'Техническое обслуживание'),
(4, 'Шиномонтаж и балансировка'),
(5, 'Кузовной ремонт'),
(6, 'Электрика и электроника');

-- --------------------------------------------------------

-- Структура таблицы `services`
CREATE TABLE `services` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `category_id` int UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `price` decimal(10,2) NOT NULL,
  FOREIGN KEY (`category_id`) REFERENCES `service_categories` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB;

-- Дамп данных таблицы `services`
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

-- Структура таблицы `users`
CREATE TABLE `users` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','client') DEFAULT 'client',
  UNIQUE KEY `email` (`email`)
);

-- Дамп данных таблицы `users`
INSERT INTO `users` (`id`, `name`, `email`, `phone`, `password`, `role`) VALUES
(1, 'Admin', 'admin@example.com', '1', '1234', 'admin'),
(3, 'Эдвард', 'client@example.com', '2', '1234', 'client');

-- --------------------------------------------------------

-- Структура таблицы `call_requests`
CREATE TABLE `call_requests` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
);

-- Дамп данных таблицы `call_requests`
INSERT INTO `call_requests` (`id`, `name`, `phone`, `email`, `created_at`) VALUES
(1, 'илья', '89', 'ilia@mail.ru', '2024-09-17 16:51:31'),
(2, 'илья', '8943', 'ilia@mail.ru', '2024-09-17 16:52:37');

-- --------------------------------------------------------

-- Структура таблицы `service_bookings`
CREATE TABLE `service_bookings` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `user_id` int UNSIGNED DEFAULT NULL,
  `service_id` int UNSIGNED DEFAULT NULL,
  `appointment_date` timestamp NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB;

-- Дамп данных таблицы `service_bookings`
INSERT INTO `service_bookings` (`id`, `user_id`, `service_id`, `appointment_date`, `created_at`) VALUES
(1, 3, 8, '2024-09-19 13:15:00', '2024-09-19 13:15:30'),
(2, 3, 8, '2024-09-19 13:15:00', '2024-09-19 13:15:53'),
(3, 3, 8, '2024-09-19 13:15:00', '2024-09-19 13:19:43'),
(4, 3, 1, '2024-09-19 13:24:00', '2024-09-19 13:28:30'),
(5, 3, 1, '2024-09-19 13:28:00', '2024-09-19 13:28:41'),
(6, 3, 4, '2024-09-20 13:57:00', '2024-09-20 14:02:42');

COMMIT;
