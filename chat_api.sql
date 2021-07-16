-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июл 14 2021 г., 17:25
-- Версия сервера: 8.0.19
-- Версия PHP: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `chat.api`
--

-- --------------------------------------------------------

--
-- Структура таблицы `messages`
--

CREATE TABLE `messages` (
  `id` int NOT NULL,
  `userId` varchar(255) NOT NULL,
  `isAdmin` tinyint(1) NOT NULL,
  `content` text NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `messages`
--

INSERT INTO `messages` (`id`, `userId`, `isAdmin`, `content`, `timestamp`) VALUES
(2, '4b5be094f17f0daadefc169f438cffc63ff4db404137cdcbef8a982c413c98a874bc6756e3b3e5366e7d733f7a9bc377a6813a29bc271d840f965668d584a110', 0, 'n5jvJPqJg7uwa4xnlfsWWg==', '2021-07-12 23:22:18'),
(3, '4b5be094f17f0daadefc169f438cffc63ff4db404137cdcbef8a982c413c98a874bc6756e3b3e5366e7d733f7a9bc377a6813a29bc271d840f965668d584a110', 0, 'N6jnScfLPrM7d5P8y+CUTA==', '2021-07-12 23:25:05'),
(4, '4b5be094f17f0daadefc169f438cffc63ff4db404137cdcbef8a982c413c98a874bc6756e3b3e5366e7d733f7a9bc377a6813a29bc271d840f965668d584a110', 0, 'F47Hk0WV5C23IMAsiFfrr2stDVEkIwLB1IrQT3Tg2hnxOhGPG12mwo/JMqLEUlBR', '2021-07-12 23:25:35'),
(5, '4b5be094f17f0daadefc169f438cffc63ff4db404137cdcbef8a982c413c98a874bc6756e3b3e5366e7d733f7a9bc377a6813a29bc271d840f965668d584a110', 0, 'x2EwEDF5JuCvVqbY0yHThQ==', '2021-07-12 23:29:31'),
(6, '4b5be094f17f0daadefc169f438cffc63ff4db404137cdcbef8a982c413c98a874bc6756e3b3e5366e7d733f7a9bc377a6813a29bc271d840f965668d584a110', 0, 'ENwLW1kthTSeJvZ6booICU+ufsYZ58wAM5o+neHztHyF7XMuQrwZJ+A+wJpUo+yLtE2rr85Ze+bn47ehSigioCu4SdUBoqoxDVS7+xgXJXM=', '2021-07-12 23:33:28'),
(7, '114a3fd9b886b3cb679e49c83f511a323bec4b5eb1f210d768c25649aeb1ba465b41d2baa6b32d6342fabb07449a22836080dafd39f41f0bdc146572c6f4bfd1', 0, 'tV8kRodCQJHbEjdkGh4cE4meewK99JJj++NM49a1rnU=', '2021-07-12 23:36:46'),
(8, '114a3fd9b886b3cb679e49c83f511a323bec4b5eb1f210d768c25649aeb1ba465b41d2baa6b32d6342fabb07449a22836080dafd39f41f0bdc146572c6f4bfd1', 0, 'GNOQKKMldgqL66mxEqDoFo+E3ewuAwvSCYHGivE2VgE=', '2021-07-13 17:38:59'),
(9, '114a3fd9b886b3cb679e49c83f511a323bec4b5eb1f210d768c25649aeb1ba465b41d2baa6b32d6342fabb07449a22836080dafd39f41f0bdc146572c6f4bfd1', 0, 'SvMxC4c6dBLiZyAWrQ63U/c6P8wGHBf0kCaQwk/Jxr+4Jet6Yd97VNPZZvK8yxhX', '2021-07-13 17:41:56'),
(10, '114a3fd9b886b3cb679e49c83f511a323bec4b5eb1f210d768c25649aeb1ba465b41d2baa6b32d6342fabb07449a22836080dafd39f41f0bdc146572c6f4bfd1', 0, 'tfY8mrSr12Vq1QIYt+VD2Q==', '2021-07-13 17:49:29');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `isAdmin` tinyint(1) NOT NULL,
  `secret` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `iv` binary(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `isAdmin`, `secret`, `iv`) VALUES
('1', 1, '', 0x00000000000000000000000000000000),
('114a3fd9b886b3cb679e49c83f511a323bec4b5eb1f210d768c25649aeb1ba465b41d2baa6b32d6342fabb07449a22836080dafd39f41f0bdc146572c6f4bfd1', 0, 'pLj9Ba7nMhnG3iQd4TTEVoWHbTRndqXfRhf3/5sDsmH2VU7fY/S+z6uzn6gGv3mCe7smwkqhdW23uXFeGBW9KA3gzr/w3wMMhJ9y1OuePHjOhGZK1wTY4y4A3HoE6ofM0GLLGZYt5XNFF2P1Gz8uFtR2RzEsXVO7BfCwqS2gLbGvdqmfyWt2vKGmG08w7rdK', 0x7d405352745d4af10bc9719cdbea9d1f),
('4b5be094f17f0daadefc169f438cffc63ff4db404137cdcbef8a982c413c98a874bc6756e3b3e5366e7d733f7a9bc377a6813a29bc271d840f965668d584a110', 0, 'djM/0FQSW5YPQE7He6y5Q3Ztp8c/XY5u5/96/FDxZFEiyeST8f7YGSwT46eRqdUoGcvy4OQK1joQpqBQiI0aItna6/fbWmsRm17Sl+LqHXQjcz6g7LsTfWQIXVO7/sFUiuFd43wmE8Pl/HN7kM4fz/1mk6DXe5cfvMyCiufnnuftFAritXsvXRydN3Iu4apO', 0x9fb90109dec4706fcbc3e8dadcc7045a);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `messages`
--
ALTER TABLE `messages`
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

DELIMITER $$
--
-- События
--
CREATE DEFINER=`root`@`127.0.0.1` EVENT `2447eca30297f65b94c3b65aba5dc234-event` ON SCHEDULE AT '2021-08-11 23:36:30' ON COMPLETION NOT PRESERVE ENABLE DO DELETE FROM `users` WHERE `id` = '114a3fd9b886b3cb679e49c83f511a323bec4b5eb1f210d768c25649aeb1ba465b41d2baa6b32d6342fabb07449a22836080dafd39f41f0bdc146572c6f4bfd1'$$

CREATE DEFINER=`root`@`127.0.0.1` EVENT `780c007f2737c1f4b0013f6bf1e3f737-event` ON SCHEDULE AT '2021-08-11 22:44:02' ON COMPLETION NOT PRESERVE ENABLE DO DELETE FROM `users` WHERE `id` = '4b5be094f17f0daadefc169f438cffc63ff4db404137cdcbef8a982c413c98a874bc6756e3b3e5366e7d733f7a9bc377a6813a29bc271d840f965668d584a110'$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
