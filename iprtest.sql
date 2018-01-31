-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Янв 29 2018 г., 08:31
-- Версия сервера: 5.6.37
-- Версия PHP: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `iprtest`
--

-- --------------------------------------------------------

--
-- Структура таблицы `counterparties`
--

CREATE TABLE `counterparties` (
  `id` int(11) NOT NULL,
  `type` int(3) NOT NULL COMMENT 'Тип ( 1 - покупатель или 2 - поставщик)',
  `name` varchar(255) DEFAULT NULL COMMENT 'Наименование',
  `tel` varchar(13) NOT NULL COMMENT 'Контактный номер телефона',
  `email` varchar(255) NOT NULL COMMENT 'Контактный email'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `counterparties`
--

INSERT INTO `counterparties` (`id`, `type`, `name`, `tel`, `email`) VALUES
(1, 1, 'ООО \"Рога и Копыта\"', '+380930000000', 'roga@gmail.com'),
(2, 2, 'ООО \"Ольвия\"', '+380670000000', 'olvia@gmail.com'),
(3, 1, 'АТБмаркет', '+380660000000', 'atb@gmail.com');

-- --------------------------------------------------------

--
-- Структура таблицы `incoming_payment_orders`
--

CREATE TABLE `incoming_payment_orders` (
  `id` int(11) NOT NULL,
  `counterparty_id` int(11) NOT NULL COMMENT 'контрагент',
  `number` varchar(255) NOT NULL COMMENT 'номер накладной',
  `sum` int(11) NOT NULL COMMENT 'сумма накладной',
  `updated_at` date DEFAULT NULL,
  `created_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `outgoing_payment_orders`
--

CREATE TABLE `outgoing_payment_orders` (
  `id` int(11) NOT NULL,
  `counterparty_id` int(11) NOT NULL COMMENT 'контрагент',
  `number` varchar(255) NOT NULL COMMENT 'номер накладной',
  `sum` int(11) NOT NULL COMMENT 'сумма накладной',
  `updated_at` date DEFAULT NULL,
  `created_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT '0',
  `price` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `name`, `quantity`, `price`) VALUES
(21, 'Слива', 1, 20),
(23, 'Груша', 1, 20),
(26, 'Абрикос', 100, 50),
(27, 'Яблоко', 50, 20);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$hdjht6bAAPiH0ZM80d/YRe5PqSNzbcuQiEuEfttuZZAqUetWPx6Xq', 'Ep4AHBHGD5pJgoffPG6H1A9pxi61MI5yNMM6M34tY4obJ5vR4tOU7k1pqM3Q', '2018-01-25 19:20:29', '2018-01-25 19:20:29');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `counterparties`
--
ALTER TABLE `counterparties`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `incoming_payment_orders`
--
ALTER TABLE `incoming_payment_orders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `outgoing_payment_orders`
--
ALTER TABLE `outgoing_payment_orders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `counterparties`
--
ALTER TABLE `counterparties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `incoming_payment_orders`
--
ALTER TABLE `incoming_payment_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `outgoing_payment_orders`
--
ALTER TABLE `outgoing_payment_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
