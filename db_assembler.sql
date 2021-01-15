-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Дек 02 2018 г., 20:07
-- Версия сервера: 5.5.25
-- Версия PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `db_assembler`
--

-- --------------------------------------------------------

--
-- Структура таблицы `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `admin`
--

INSERT INTO `admin` (`id`, `login`, `password`) VALUES
(1, 'admin', 'admin123'),
(2, 'admin2', 'admin321');

-- --------------------------------------------------------

--
-- Структура таблицы `cart`
--

CREATE TABLE IF NOT EXISTS `cart` (
  `cart_id` int(11) NOT NULL AUTO_INCREMENT,
  `cart_id_products` int(11) NOT NULL,
  `cart_price` int(11) NOT NULL,
  `cart_count` int(11) NOT NULL DEFAULT '1',
  `cart_datetime` datetime NOT NULL,
  `cart_ip` varchar(100) NOT NULL,
  PRIMARY KEY (`cart_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=37 ;

--
-- Дамп данных таблицы `cart`
--

INSERT INTO `cart` (`cart_id`, `cart_id_products`, `cart_price`, `cart_count`, `cart_datetime`, `cart_ip`) VALUES
(24, 5, 67990, 4, '2018-05-22 17:59:41', '127.0.0.1'),
(25, 4, 55990, 2, '2018-05-22 17:59:44', '127.0.0.1'),
(27, 1, 40000, 3, '2018-05-23 08:29:11', '127.0.0.1'),
(30, 7, 124990, 2, '2018-10-03 09:19:17', '127.0.0.1'),
(32, 6, 25990, 1, '2018-10-22 20:55:44', '127.0.0.1'),
(36, 3, 91990, 1, '2018-11-27 08:59:41', '127.0.0.1');

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(32) NOT NULL,
  `brand` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id`, `type`, `brand`) VALUES
(1, 'CPU', 'Intel'),
(2, 'CPU', 'AMD'),
(3, 'RAM', 'Kingston'),
(4, 'RAM', 'Corsair'),
(5, 'RAM', 'Crucial'),
(6, 'RAM', 'G.Skill'),
(7, 'RAM', 'Samsung'),
(8, 'mother', 'Asus'),
(9, 'mother', 'ASRock'),
(10, 'mother', 'GIGABYTE'),
(11, 'mother', 'MSI'),
(12, 'mother', 'Intel'),
(13, 'power', 'AeroCool'),
(14, 'power', 'Be quiet!'),
(15, 'power', 'Cooler Master'),
(16, 'power', 'Corsair'),
(17, 'power', 'ThermalTake'),
(18, 'power', 'Seasonic'),
(19, 'GPU', 'Asus'),
(20, 'GPU', 'Inno3D'),
(21, 'GPU', 'GYGABYTE'),
(22, 'GPU', 'MSI'),
(23, 'GPU', 'Palit');

-- --------------------------------------------------------

--
-- Структура таблицы `table_products`
--

CREATE TABLE IF NOT EXISTS `table_products` (
  `products_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `brand` varchar(64) NOT NULL,
  `tdp` varchar(32) NOT NULL,
  `price` int(16) NOT NULL,
  `image` varchar(255) NOT NULL,
  `mini_features` text NOT NULL,
  `description` text NOT NULL,
  `visible` int(11) NOT NULL DEFAULT '0',
  `type_tovara` varchar(255) NOT NULL,
  `brand_id` int(64) NOT NULL,
  PRIMARY KEY (`products_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Дамп данных таблицы `table_products`
--

INSERT INTO `table_products` (`products_id`, `title`, `brand`, `tdp`, `price`, `image`, `mini_features`, `description`, `visible`, `type_tovara`, `brand_id`) VALUES
(1, 'Intel Core i3-8100 "Coffee Lake" 4 core (Quad Core) CPU with 3.60 GHz', 'Intel', '65 W', 40000, 'i38100.png', 'for Sockel 1151-v2\n4x 3.60 GHz\nIntel® UHD Graphics 630 интегрированный\n6 MB Кэш-память L3, Boxed', 'Новый процессор Intel Core i3-8100 8-го поколения, с кодовым названием микроархитектуры Coffee Lake-S. Intel Core i3-8100 производится по стандарту 14-нм техпроцесса, имеет 4 ядра, которые работают с штатной тактовой частотой 3.6 ГГц. Объем кэш-памяти 3 уровня равен 6 МБ. Имеет 2-х канальный контроллер памяти DDR4.\n', 1, 'CPU', 1),
(2, 'AMD Ryzen 7 1700X Boxed (Octa Core) CPU with 3.40 GHz', 'AMD', '95 W', 99990, 'RYZ1700X.jpg', 'for Sockel AM4\n8x 3.40 GHz (3.80 GHz Turbo)\n16 MB Кэш-память L3,\nГиперпараллельность\nUnlocked multiplier, Boxed', 'В новой архитектуре AMD Zen используется мощный механизм исполнения, а также поддерживается функция одновременной многопоточности (SMT). Новая трехуровневая кэш-память с низкой задержкой и новые алгоритмы предварительной выборки значительно уменьшают количество кэш-промахов и увеличивают пропускную способность по сравнению с предыдущей микроархитектурой.\n', 1, 'CPU', 2),
(3, 'Intel Core i7-7700K 4 core (Quad Core) CPU with 4.2 GHz', 'Intel', '91 W', 91990, 'I77700.jpg', 'for Sockel 1151\n4x 4.2 GHz (4.50 GHz Turbo)\nHD Graphics 630 интегрированный\n8 MB Кэш-память L3, \nUnlocked multiplier, Boxed ', 'Новый процессор Intel Core i7-7700K 7-го поколения, с кодовым названием микроархитектуры Kaby Lake. Intel Core i7-7700K производится по стандарту 14-нм техпроцесса, имеет 4 ядра, которые работают в 8 потоков со штатной тактовой частотой 4.2 ГГц, 4.5 ГГц в режиме Turbo Boost. Объем кэш-памяти 3 уровня равен 8 МБ. Имеет 2-х канальный контроллер памяти DDR4 и разблокированный множитель.\n', 1, 'CPU', 1),
(4, 'Kingston HyperX Fury Black Kit DDR4 2133 16GB (2x8GB)', 'Kingston', '', 55990, 'kingHXBlack2133.jpg', '-16 GB RAM, 2x 8 GB Kit\n-DDR4, 2133 MHz (PC4-17000)\n-DIMM 288 Pin, CL14', 'Модуль памяти HyperX Fury DDR4 поможет вам одержать победу даже в самых напряженных сражениях. Модуль автоматически распознает платформу и самостоятельно разгоняется до максимальной заявленной частоты, поэтому вы всегда можете быть в нем уверены.\r\n', 1, 'RAM', 3),
(5, 'Corsair Vengeance LPX 16GB DDR4 Kit K2 White 3200 C15 (2x8GB)', 'Corsair', '', 67990, 'CORLPX3200.jpg', '16 GB RAM, 2x 8 GB Kit\nDDR4, 3200 MHz (PC4-25600)\nDIMM 288 Pin, CL16\n', 'Модуль памяти Vengeance LPX разработан для более эффективного разгона процессора. Теплоотвод выполнен из чистого алюминия, что ускоряет рассеяние тепла, а восьмислойная печатная плата значительно эффективнее распределяет тепло и предоставляет обширные возможности для разгона.\r\n', 1, 'RAM', 4),
(8, 'Видеокарта MSI GeForce GTX 1080 Ti GAMING X 11G', 'MSI', '', 400000, 'GPU-8604.png', 'for Sockel AM4\n8x 3.40 GHz (3.80 GHz Turbo)\n16 MB Кэш-память L3,\n', 'НАСТОЯЩЕЕ ГЕЙМЕРСКОЕ РЕШЕНИЕ\r\nГлавный компонент любого игрового ПК.', 1, 'GPU', 11);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `surname` varchar(64) NOT NULL,
  `name` varchar(64) NOT NULL,
  `otec` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `phone` varchar(64) NOT NULL,
  `address` text NOT NULL,
  `datetime` datetime NOT NULL,
  `ip` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `login`, `password`, `surname`, `name`, `otec`, `email`, `phone`, `address`, `datetime`, `ip`) VALUES
(1, 'aweka', '1w3r5y7uba726be88cdd3ae6c59d628e640362660m9b8v', 'Базарбай', 'Алишер', 'Жанатович', 'awekaaaaa@gmail.com', '87778756766', '22mkr', '2018-05-08 11:51:43', '127.0.0.1'),
(2, 'awekonti', '1w3r5y7u5b9b8784dcbd09d043ae9f6421dfe1860m9b8v', 'olisher', 'olisher', 'olisher', 'awekaaaaddda@gmail.com', '87765655434', '22mkr csacas', '2018-05-08 22:35:22', '127.0.0.1'),
(5, 'nursultan', '1w3r5y7u39a7d9937942b54253255931b44f79240m9b8v', 'Nursultan', 'Nur', 'vich', 'nu@mail.ru', '8788713242115', '12eefs', '2018-10-03 09:14:37', '127.0.0.1'),
(14, 'alisher_qer', '1w3r5y7u95739c8b24fc0eb7ad5b2147f029aecf0m9b8v', 'Базарай1', 'Алишер', 'Жанатович1', 'as1der@yahoo.com', '8777777732777', 'Aktobe 1', '2018-11-22 09:21:04', '127.0.0.1'),
(16, 'alisherrr', '1w3r5y7u95739c8b24fc0eb7ad5b2147f029aecf0m9b8v', 'Базарбай', 'Алишер', 'Жанатович', 'asder@yahoo.com', '89065677897', 'Aktobe', '2018-12-01 17:42:17', '127.0.0.1');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
