-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Мар 25 2018 г., 10:03
-- Версия сервера: 5.7.21-0ubuntu0.16.04.1
-- Версия PHP: 7.0.28-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `hypertube`
--

-- --------------------------------------------------------

--
-- Структура таблицы `activates`
--

CREATE TABLE `activates` (
  `id` int(10) UNSIGNED NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_at` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `activates`
--

INSERT INTO `activates` (`id`, `token`, `user_email`, `updated_at`, `created_at`) VALUES
(1, 'eiCEqYZwqKDu7pcjHyyXFMc0AWJcNoroUkJykfOe', 'konovalenko@gmail.com', '2018-03-17 20:20:56', '2018-03-17 20:20:56'),
(2, '9AIHgF5u0txI0an2upULjS9qwJKCkNEZ3wr9QmmU', 'qwe@fv.com', '2018-03-21 12:23:32', '2018-03-21 12:23:32'),
(3, '9AIHgF5u0txI0an2upULjS9qwJKCkNEZ3wr9QmmU', 'konovaslan@gmail.com', '2018-03-21 12:45:39', '2018-03-21 12:45:39');

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2018_01_28_115932_create_user_table', 1),
(2, '2018_03_17_200902_create_activate_table', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` int(11) NOT NULL,
  `created_at` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_at` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `image`, `email`, `password`, `token`, `active`, `created_at`, `updated_at`) VALUES
(10, 'Руслан', 'Коноваленко', '', 'ruslan@gmail.com', '2f9959b230a44678dd2dc29f037ba1159f233aa9ab183ce3a0678eaae002e5aa6f27f47144a1a4365116d3db1b58ec47896623b92d85cb2f191705daf11858b8', 'eiCEqYZwqKDu7pcjHyyXFMc0AWJcNoroUkJykfOe', 0, '2018-03-17 17:19:21', '2018-03-17 17:19:21'),
(11, 'Руслан', 'Коноваленко', '/public/uploads/user_11/topSecret.jpg', 'konovalenkoruslan@gmail.com', '', 'EAAChpayGfpgBABDeb0XToMXjUO9h0uvsMuEQspVE8hUK6A1YYS2ZAHs1JuxpPkJqXGlxBD7vPfttvILNImeO9ZBHL9HaZAnRZBelqrFLjT5rkrvkrogD9qsgOUVHv3cxS3XFpXkpzuFIpsmCdccZAs8K6ygOBTW6gMyi9sxLYWAZDZD', 0, '2018-03-17 17:22:58', '2018-03-17 17:22:58'),
(12, 'Ruslan', 'Konovalenko', '/public/uploads/user_12/WALb1JWj6OE.jpg', 'rkonoval@student.unit.ua', '', '176b86ac0c62547e661e8cc658bc09c99568f4f0b393544b69a12108d99a938a', 0, '2018-03-17 17:23:16', '2018-03-17 17:23:16'),
(14, 'Руслан Коноваленко', 'Коноваленко', '', 'konovalenko@gmail.com', '2f9959b230a44678dd2dc29f037ba1159f233aa9ab183ce3a0678eaae002e5aa6f27f47144a1a4365116d3db1b58ec47896623b92d85cb2f191705daf11858b8', 'eiCEqYZwqKDu7pcjHyyXFMc0AWJcNoroUkJykfOe', 0, '2018-03-17 20:20:56', '2018-03-17 20:20:56'),
(15, 'qwe', 'qwe', '', 'qwe@fv.com', 'ac5bbf8b24d2db584f0dcc26e738ec41f2fabb971851fb17aa3475587df5836346ea422378bdd654dafca3fe62033135dbec46b63b27fb4d13da78ee0e6bbe8d', '9AIHgF5u0txI0an2upULjS9qwJKCkNEZ3wr9QmmU', 1, '2018-03-21 12:23:32', '2018-03-21 12:23:32'),
(16, 'Руслан Коноваленко', 'Коноваленко', '', 'konovaslan@gmail.com', 'ac5bbf8b24d2db584f0dcc26e738ec41f2fabb971851fb17aa3475587df5836346ea422378bdd654dafca3fe62033135dbec46b63b27fb4d13da78ee0e6bbe8d', '9AIHgF5u0txI0an2upULjS9qwJKCkNEZ3wr9QmmU', 0, '2018-03-21 12:45:39', '2018-03-21 12:45:39');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `activates`
--
ALTER TABLE `activates`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `id_2` (`id`),
  ADD KEY `id_3` (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `activates`
--
ALTER TABLE `activates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
