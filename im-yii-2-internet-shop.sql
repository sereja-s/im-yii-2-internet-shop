-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 13 2023 г., 23:34
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
-- База данных: `im-yii-2-internet-shop`
--

-- --------------------------------------------------------

--
-- Структура таблицы `cart`
--

CREATE TABLE `cart` (
  `id` int NOT NULL,
  `id_user` int DEFAULT NULL,
  `mass_prod` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `status` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `name`, `img`, `description`) VALUES
(1, 'Снаряжение', 'prod1.jpg', 'Не ссорьтесь с родными, не ссорьтесь с любимыми.\r\nЗапомните вот что — любовь выше доводов.\r\nМы все не железные, все — уязвимые,\r\nНас злые слова жалят хуже чем оводы'),
(2, 'Обувь', 'prod2.jpg', 'Есть фразы грубей, чем любые пощёчины,\r\nТакие, увы, не забудутся к ужину.\r\nКогда ваше небо закрашено дочерна,\r\nТо, я умоляю, сложите оружие.\r\n\r\nПод властью обид, из-за чистой нелепицы,\r\nВ случайно затмившем сознание зареве,\r\nНе перечеркните те долгие месяцы,\r\nКоторые нитью заветной связали вас'),
(3, 'Амуниция', '2-tm_home_default.jpg', 'Опять в стенах замка царят разногласия,\r\nКороль раздражён, королева разгневана,\r\nШипящие слышатся чаще чем гласные.\r\nНу, что тут поделаешь?\r\nВсё уже сделано...\r\n\r\nКогда покричите, когда повоюете,\r\nКогда все потери свои подытожите,\r\nПопробуйте вспомнить о том, что вы любите.\r\nО том, что ни дня друг без друга не можете.\r\n\r\nПрощайте любимых — хоть вы не обязаны,\r\nПусть в сердце окрепнут ростки терпеливости,\r\nВсё это с глубокими чувствами связано,\r\nДля этого нужно сознанием вырасти'),
(4, 'Одежда', 'prod4.jpg', 'В любом королевстве, что вами основано,\r\nПусть будет первейшим из законодательств:\r\nЛюбовь — выше всех существующих доводов,\r\nЛюбовь —\r\nвыше всех на земле доказательств');

-- --------------------------------------------------------

--
-- Структура таблицы `characteristics`
--

CREATE TABLE `characteristics` (
  `id` int NOT NULL,
  `id_prod` int DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `text` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1678530056);

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `category_id` int DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `code` varchar(10) DEFAULT NULL,
  `price` varchar(10) DEFAULT NULL,
  `price_old` varchar(10) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `description` text,
  `count` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `code`, `price`, `price_old`, `img`, `description`, `count`) VALUES
(1, 1, 'коврик', '123', '1200', '1500', '6-tm_home_default.jpg', 'мягкий, удобный коврик', 1),
(2, 1, 'рюкзак', '465', '2310', NULL, '21-tm_home_default.jpg', 'практичный, удобный рюкзак', 3),
(3, 2, 'кроссовки', '798', '5000', '5005', '36-tm_home_default.jpg', 'не жмут и хорошо смотрятся', 5),
(4, 1, 'рюкзак жёлтый', '147', '1255', '1345', '66-tm_home_default.jpg', 'вместительный, удобный', 0),
(5, 2, 'туфли', '258', '7500', '8000', 'prod2.jpg', 'крутые, модные', 10),
(6, 3, 'зацепы разные', '369', '500', '550', '91-tm_home_default.jpg', 'крепкие, удобные в использовании', 1),
(7, 3, 'страховочные приспособления', '753', '10000', '', '46-tm_home_default.jpg', 'фиксация на теле в трёх точках', 5),
(8, 4, 'спортивный комплект', '357', '12345', '17000', '4-home-default.jpg', 'утеплённая куртка и штаны Сноуборд в подарок :)', 7),
(9, 1, 'рюкзак красный', '3258', '1470', NULL, 'prod1.jpg', 'такой симпатичный и вместительный', 8),
(10, 1, 'шапочка для скалолазания', '9541', '1785', '1852', 'prod3.jpg', 'крепкая как сталь, утеплённая', 15);

-- --------------------------------------------------------

--
-- Структура таблицы `reviews`
--

CREATE TABLE `reviews` (
  `id` int NOT NULL,
  `id_prod` int DEFAULT NULL,
  `id_user` int DEFAULT NULL,
  `text` text,
  `rating` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `user_surname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `region` varchar(100) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `wish_list`
--

CREATE TABLE `wish_list` (
  `id` int NOT NULL,
  `id_user` int DEFAULT NULL,
  `mass_prod` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `characteristics`
--
ALTER TABLE `characteristics`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `wish_list`
--
ALTER TABLE `wish_list`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `characteristics`
--
ALTER TABLE `characteristics`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `wish_list`
--
ALTER TABLE `wish_list`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
