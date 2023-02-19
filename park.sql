-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Фев 19 2023 г., 23:56
-- Версия сервера: 8.0.30
-- Версия PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `park`
--

-- --------------------------------------------------------

--
-- Структура таблицы `activities`
--

CREATE TABLE `activities` (
  `activity_id` int NOT NULL,
  `activity_title` varchar(50) NOT NULL,
  `price` int NOT NULL,
  `age_restrictions` int NOT NULL,
  `max_count_people` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `activities`
--

INSERT INTO `activities` (`activity_id`, `activity_title`, `price`, `age_restrictions`, `max_count_people`) VALUES
(9, 'Скалодром', 16, 12, 20);

-- --------------------------------------------------------

--
-- Структура таблицы `clients`
--

CREATE TABLE `clients` (
  `client_id` int NOT NULL,
  `fullname` varchar(150) NOT NULL,
  `age` int NOT NULL,
  `can_swim` enum('Да','Нет') DEFAULT NULL,
  `is_regular_customer` enum('Да','Нет') DEFAULT NULL,
  `favorite_activity` int NOT NULL,
  `available_discount` int NOT NULL,
  `is_banned` enum('Да','Нет') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `discounts`
--

CREATE TABLE `discounts` (
  `discount_id` int NOT NULL,
  `discount_value` int NOT NULL,
  `receive_conditions` varchar(50) NOT NULL,
  `is_cumulative` enum('Да','Нет') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `discounts`
--

INSERT INTO `discounts` (`discount_id`, `discount_value`, `receive_conditions`, `is_cumulative`) VALUES
(4, 12, 'Для именинника', 'Нет');

-- --------------------------------------------------------

--
-- Структура таблицы `employees`
--

CREATE TABLE `employees` (
  `employee_id` int NOT NULL,
  `fullname` varchar(150) NOT NULL,
  `age` int NOT NULL,
  `position` int NOT NULL,
  `phone` int NOT NULL,
  `email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `jobs`
--

CREATE TABLE `jobs` (
  `job_id` int NOT NULL,
  `job_title` varchar(50) NOT NULL,
  `responsibilities` varchar(150) NOT NULL,
  `work_experience` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `jobs`
--

INSERT INTO `jobs` (`job_id`, `job_title`, `responsibilities`, `work_experience`) VALUES
(1, 'Администратор', 'Администрирование', 5);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`activity_id`);

--
-- Индексы таблицы `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`client_id`),
  ADD KEY `favorite_activity` (`favorite_activity`),
  ADD KEY `available_discount` (`available_discount`);

--
-- Индексы таблицы `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`discount_id`);

--
-- Индексы таблицы `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`employee_id`),
  ADD KEY `position` (`position`);

--
-- Индексы таблицы `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`job_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `activities`
--
ALTER TABLE `activities`
  MODIFY `activity_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `clients`
--
ALTER TABLE `clients`
  MODIFY `client_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `discounts`
--
ALTER TABLE `discounts`
  MODIFY `discount_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `employees`
--
ALTER TABLE `employees`
  MODIFY `employee_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `jobs`
--
ALTER TABLE `jobs`
  MODIFY `job_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `clients_ibfk_1` FOREIGN KEY (`favorite_activity`) REFERENCES `activities` (`activity_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `clients_ibfk_2` FOREIGN KEY (`available_discount`) REFERENCES `discounts` (`discount_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_ibfk_1` FOREIGN KEY (`position`) REFERENCES `jobs` (`job_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
