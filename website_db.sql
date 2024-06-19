-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Май 23 2024 г., 11:39
-- Версия сервера: 10.4.32-MariaDB
-- Версия PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `website_db`
--

-- --------------------------------------------------------

--
-- Структура таблицы `photos`
--

CREATE TABLE `photos` (
  `id` int(11) NOT NULL,
  `restaurant_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `photo_url` varchar(255) NOT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `photos_restaurants`
--

CREATE TABLE `photos_restaurants` (
  `id` int(11) NOT NULL,
  `restaurant_id` int(11) DEFAULT NULL,
  `photo_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `photos_restaurants`
--

INSERT INTO `photos_restaurants` (`id`, `restaurant_id`, `photo_url`) VALUES
(1, 1, 'https://restolife.kz/upload/information_system_6/2/4/6/item_24688/information_items_property_31348.jpg'),
(2, 2, 'https://avatars.mds.yandex.net/get-altay/13072111/2a0000018f149d6c3bf1c48f7ffc981b2819/L_height'),
(3, 3, 'https://media-cdn.tripadvisor.com/media/photo-s/0e/0d/49/c4/getlstd-property-photo.jpg'),
(4, 4, 'https://media-cdn.tripadvisor.com/media/photo-s/0e/0d/49/c4/getlstd-property-photo.jpg'),
(5, 5, 'https://avatars.mds.yandex.net/get-altay/927916/2a00000186f5ae66c96b28f91688c1e8f9cf/orig'),
(6, 6, 'https://avatars.mds.yandex.net/get-altay/6928818/2a0000018415cc2661d22ba4e6496b171096/orig'),
(7, 7, 'https://cachizer3.2gis.com/reviews-photos/06c5e919-ee34-4c25-bc0a-356978a9619e.jpg'),
(8, 8, 'https://krisha-photos.kcdn.online/webp/de/deb5bf9e-e939-4889-8e1a-074bb2794bb8/2-750x470.jpg'),
(9, 9, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR_qMKmSOSgpcqTOzeNIv5tW8MKqYGEbcGGV2LKcTAZkw&s'),
(10, 10, 'https://restolife.kz/upload/information_system_6/2/4/6/item_24688/information_items_property_31348.jpg'),
(11, 11, 'https://avatars.mds.yandex.net/get-altay/813485/2a00000187a77949e8ca241834b65e4ecffd/L_height'),
(12, 12, 'https://avatars.mds.yandex.net/get-altay/11411122/2a0000018e1d363beca6849d4f8f5366b73f/L_height'),
(13, 13, 'https://i7.photo.2gis.com/images/branch/168/23643898088222092_2dc2_328x170.jpg'),
(14, 14, 'https://avatars.mds.yandex.net/get-altay/10147638/2a0000018aa083a82e39834453e89978332a/XL'),
(15, 15, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSVC5YwKHZv2DXQZ4_RVOKZnCVvX4X2TtgOiStq5iodRQ&s'),
(16, 16, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQC_s_YFayVG3S2M1n01jAPeX9X9UzVvEedg4StLn7Qhw&s'),
(17, 17, 'https://etalonatyrau.kz/d/vyveska_izyum.jpg'),
(18, 18, 'https://realkz.com/images_resize/main/65724.jpg'),
(19, 19, 'https://i5.photo.2gis.com/images/branch/0/30258560163246619_0963_328x170.jpg'),
(20, 20, 'https://i4.photo.2gis.com/main/branch/168/70000001043892951/common'),
(21, 21, 'https://avatars.mds.yandex.net/get-altay/7810332/2a00000187ea38b4c34aef10c68567709800/XL'),
(22, 22, 'https://media-cdn.tripadvisor.com/media/photo-s/08/02/00/b6/caption.jpg'),
(23, 23, 'https://media-cdn.tripadvisor.com/media/photo-s/09/b5/e1/a5/pizza-la-roma.jpg'),
(24, 24, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQEGbsZH0esfq4VXfO-AKbXYj3NrqBx5MxEFLi3MX_skg&s'),
(25, 25, 'https://static-pano.maps.yandex.ru/v1/?panoid=1383175602_755961293_23_1704963286&size=500%2C240&azimuth=-1.4&tilt=10&api_key=maps&signature=nlr-alRf47H73osHKja5H8QkZ0NFXoX5XTT4jSslNVE='),
(26, 26, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSH2Gv7xcD06NmzBGozv6p9IzrCl1uLA71YBIJEOVvLQg&s'),
(27, 27, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS1Ft0QNsPn89T4AAyr3RxiUNh6ti4sHzfWZZgSj7j_xg&s'),
(28, 28, 'https://media-cdn.tripadvisor.com/media/photo-s/1d/4c/f5/0d/caption.jpg'),
(29, 29, 'https://avatars.mds.yandex.net/get-altay/11022524/2a0000018e0a5dc7641f429402a7bfe5b54f/orig'),
(30, 30, 'https://media-cdn.tripadvisor.com/media/photo-s/0c/25/df/24/photo0jpg.jpg'),
(31, 31, 'https://avatars.mds.yandex.net/get-altay/5298780/2a00000188a73d952318eb62b899fb831bd9/XL'),
(32, 32, 'https://avatars.mds.yandex.net/get-altay/6065996/2a000001818c40219c73bbc57256abc6733f/L'),
(33, 33, 'https://avatars.mds.yandex.net/get-altay/11022524/2a0000018e0fc9860142fc1522c0008f3392/L_height'),
(34, 34, 'https://avatars.mds.yandex.net/get-altay/933207/2a000001877ca1bf920304d82e4d401d3962/L_height'),
(35, 35, 'https://avatars.mds.yandex.net/get-altay/933207/2a000001860f8d4e1658e437886238510375/L_height'),
(36, 36, 'https://avatars.mds.yandex.net/get-altay/10648814/2a0000018b92e552a23165c377c8c91cacec/orig'),
(37, 37, 'https://avatars.mds.yandex.net/get-altay/10648814/2a0000018b92e552a23165c377c8c91cacec/orig'),
(38, 38, 'https://avatars.mds.yandex.net/get-altay/1453927/2a00000185c83df6f9c4bc35abcdf797b2ec/L_height'),
(39, 39, 'https://avatars.mds.yandex.net/get-altay/1453927/2a00000185c83df6f9c4bc35abcdf797b2ec/L_height'),
(40, 40, 'https://avatars.mds.yandex.net/get-altay/4544819/2a000001775e11e8e499e33e6c0565d387f0/orig'),
(41, 41, 'https://avatars.mds.yandex.net/get-altay/4544819/2a000001775e11e8e499e33e6c0565d387f0/orig'),
(42, 42, 'https://avatars.mds.yandex.net/get-altay/4544819/2a000001775e11e8e499e33e6c0565d387f0/orig'),
(43, 43, 'https://avatars.mds.yandex.net/get-altay/3518606/2a000001794b1169bd8196e95a2c098a6aee/L_height'),
(44, 44, 'https://avatars.mds.yandex.net/get-altay/3518606/2a000001794b1169bd8196e95a2c098a6aee/L_height'),
(45, 45, 'https://static-pano.maps.yandex.ru/v1/?panoid=1383209533_756130775_23_1705146463&size=500%2C240&azimuth=65.6&tilt=10&api_key=maps&signature=HNs2hFRDKnAfDjGT-Et16YS9i1x6m15E3jVDALNbzlc='),
(46, 47, 'https://avatars.mds.yandex.net/get-altay/6928818/2a0000018415cc2661d22ba4e6496b171096/orig'),
(47, 48, 'https://cachizer3.2gis.com/reviews-photos/06c5e919-ee34-4c25-bc0a-356978a9619e.jpg'),
(48, 49, 'https://avatars.mds.yandex.net/get-altay/10147638/2a0000018aa083a82e39834453e89978332a/XL'),
(49, 50, 'https://avatars.mds.yandex.net/get-altay/10147638/2a0000018aa083a82e39834453e89978332a/XL'),
(50, 51, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS1Ft0QNsPn89T4AAyr3RxiUNh6ti4sHzfWZZgSj7j_xg&s'),
(51, 52, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSVC5YwKHZv2DXQZ4_RVOKZnCVvX4X2TtgOiStq5iodRQ&s'),
(52, 53, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSVC5YwKHZv2DXQZ4_RVOKZnCVvX4X2TtgOiStq5iodRQ&s'),
(53, 54, 'https://avatars.mds.yandex.net/get-altay/941278/2a00000187d214c67ac56634819be7bc6385/orig'),
(54, 55, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRajd3sj8cH3Yotxcjo03BpRjlGosRy7gkkTl-LzrYa0w&s'),
(55, 56, 'https://avatars.mds.yandex.net/get-altay/10768923/2a0000018a95be8812a26d9a649c5e7461a7/orig'),
(56, 57, 'https://avatars.mds.yandex.net/get-altay/10768923/2a0000018a95be8812a26d9a649c5e7461a7/orig'),
(57, 58, 'https://avatars.mds.yandex.net/get-altay/10768923/2a0000018a95be8812a26d9a649c5e7461a7/orig'),
(58, 59, 'https://avatars.mds.yandex.net/get-altay/11411122/2a0000018e1d363beca6849d4f8f5366b73f/L_height'),
(59, 60, 'https://avatars.mds.yandex.net/get-altay/11411122/2a0000018e1d363beca6849d4f8f5366b73f/L_height'),
(60, 61, 'https://avatars.mds.yandex.net/get-altay/2039785/2a0000017608652ec6cacbf9091dff869051/orig'),
(61, 62, 'https://avatars.mds.yandex.net/get-altay/6237886/2a000001808df1f25d8f04646d1086306701/L_height'),
(62, 63, 'https://avatars.mds.yandex.net/get-altay/760153/2a000001875780c9ed544fe6e29eb9dfaa40/orig');

-- --------------------------------------------------------

--
-- Структура таблицы `pricerange`
--

CREATE TABLE `pricerange` (
  `id` int(11) NOT NULL,
  `restaurant_id` int(11) DEFAULT NULL,
  `average_price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `pricerange`
--

INSERT INTO `pricerange` (`id`, `restaurant_id`, `average_price`) VALUES
(1, 1, 5000.00),
(2, 2, 6000.00),
(3, 3, 6000.00),
(4, 4, 6000.00),
(5, 5, 5000.00),
(6, 6, 6000.00),
(7, 7, 10000.00),
(8, 8, 8000.00),
(9, 9, 8000.00),
(10, 10, 5000.00),
(11, 11, 2000.00),
(12, 12, 6000.00),
(13, 13, 4000.00),
(14, 14, 4500.00),
(15, 15, 5000.00),
(16, 16, 5000.00),
(17, 17, 2500.00),
(18, 18, 3000.00),
(19, 19, 2000.00),
(20, 20, 6500.00),
(21, 21, 2700.00),
(22, 22, 2000.00),
(23, 23, 5000.00),
(24, 24, 4000.00),
(25, 25, 4000.00),
(26, 26, 5000.00),
(27, 27, 4000.00),
(28, 28, 1800.00),
(29, 29, 5000.00),
(30, 30, 5000.00),
(31, 31, 5000.00),
(32, 32, 10000.00),
(33, 33, 3000.00),
(34, 34, 5000.00),
(35, 35, 2500.00),
(36, 36, 4000.00),
(37, 37, 4000.00),
(38, 38, 5000.00),
(39, 39, 5000.00),
(40, 40, 4500.00),
(41, 41, 4500.00),
(42, 42, 4500.00),
(43, 43, 2500.00),
(44, 44, 2500.00),
(45, 45, 5000.00),
(46, 47, 6000.00),
(47, 48, 10000.00),
(48, 49, 4500.00),
(49, 50, 4500.00),
(50, 51, 4000.00),
(51, 52, 5000.00),
(52, 53, 5000.00),
(53, 54, 5000.00),
(54, 55, 2500.00),
(55, 56, 5000.00),
(56, 57, 5000.00),
(57, 58, 5000.00),
(58, 59, 6000.00),
(59, 60, 6000.00),
(60, 61, 10000.00),
(61, 62, 6000.00),
(62, 63, 10000.00);

-- --------------------------------------------------------

--
-- Структура таблицы `restaurants`
--

CREATE TABLE `restaurants` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `cuisine_type` varchar(100) DEFAULT NULL,
  `price_range` varchar(50) DEFAULT NULL,
  `average_rating` decimal(3,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `restaurants`
--

INSERT INTO `restaurants` (`id`, `name`, `location`, `cuisine_type`, `price_range`, `average_rating`) VALUES
(1, 'CoffeeBoom', 'Abulkhair Khan Avenue, 63 block 3', 'Asian', '$$', 4.70),
(2, 'Del Papa', 'Baktygerey Kulmanova street, 35', 'Italian', '$$$', 3.90),
(3, 'Jida', 'Azattyk Avenue, 6', 'Italian', '$$$', 4.70),
(4, 'Jida', 'Azattyk Avenue, 6', 'European', '$$$', 4.70),
(5, 'Barbaris', 'Microdistrict Almagul, 21a', 'Uzbek', '$$', 2.70),
(6, 'YAMATO', 'Kanysha Satpayev Avenue, 37', 'Japan', '$$$', 3.00),
(7, 'Be cloud', 'Abulkhair Khan Avenue, 63 block 6', 'European', '$$$', 4.60),
(8, 'Le Roi', 'Shukyr Erkinov Street, 47', 'Japan', '$$$', 4.90),
(9, 'Manzara', 'Baktygerey Kulmanova street, 117', 'European', '$$$', 2.90),
(10, 'CoffeBoom', 'Abulkhair Khan Avenue, 63 block 3', 'European', '$$', 4.70),
(11, 'Morocco', 'Admiral Lev Vladimirsky Street, 2v', 'European', '$', 4.00),
(12, 'Bungalow', 'Kurmangazy street, 9a/1', 'Eastern', '$$$', 4.50),
(13, 'Shafran', 'Kanysha Satpayev Avenue, 19B', 'Eastern', '$$', 4.50),
(14, 'Hayat', 'Yuri Gagarin Street, 65', 'Italian', '$$', 3.90),
(15, 'Iris', 'Isatay Taimanov Avenue, 48 block J', 'Italian', '$$', 4.10),
(16, 'The Tower', 'Azattyk Avenue, 48', 'Uzbek', '$$', 4.70),
(17, 'Izium', 'Sary Arka microdistrict, 40', 'Eastern', '$', 4.00),
(18, 'Safari', 'Kurmangazy street, 3g', 'Kazakh', '$$', 3.10),
(19, 'Sharbaq', 'Kanysha Satpayev Avenue, 48a', 'Eastern', '$', 2.70),
(20, 'Suiinshi', 'Syrym Datov street, 13a', 'European', '$$$', 3.90),
(21, 'Djama Halal Fusion & Family', '260 Sultan Beybarys Avenue', 'Uzbek', '$$', 4.60),
(22, 'Dastarkhan', 'Abulkhair Khan Avenue, 51a block B', 'European', '$', 4.70),
(23, 'Pizza La Roma', 'Kurmangazy Street, 5', 'European', '$$', 4.20),
(24, 'Family Park', 'Kurmangazy Street, 1', 'Eastern', '$$', 4.00),
(25, 'Qurma', 'Sultan Beybarys Avenue, 434', 'Eastern', '$$', 3.60),
(26, 'Vobla', '51a Rysbai Gabdiev Street', 'Russian', '$$', 4.80),
(27, 'Asahi food', 'Karshymbai Akhmediyarov street, 15b', 'Chinese', '$$', 2.50),
(28, 'Coffe Matters', 'Baktygereya Kulmanova street, 154a', 'European', '$$', 4.10),
(29, 'Miata', 'Admiral Lev Vladimirsky Street, 16', 'Japan', '$$', 2.80),
(30, 'Tocco', 'Улица Кенжебай Маденов, 7а', 'Italian', '$$', 4.00),
(31, 'Yummy Korean Food', 'Baktygereya Kulmanova street, 133', 'Korean', '$$', 3.20),
(32, 'BARSUK RestoBar', '29B Zhuban Moldagaliev Street', 'European', '$$$', 3.50),
(33, 'Arizona Coffee', 'Kurmangazy Street, 12', 'European', '$$', 2.70),
(34, 'Georgia', 'Sapar Karymsakov Street, 5', 'Georgian', '$$$', 4.60),
(35, 'Lanzhou', 'Shokan Ualikhanov Street, 2b', 'Eastern', '$$', 4.40),
(36, 'Go Halal', 'Улица Сырым Датов, 50', 'Eastern', '$$', 2.80),
(37, 'Go Halal', 'Улица Сырым Датов, 50', 'European', '$$', 2.80),
(38, 'Tomiris', '9B Azattyk Avenue', 'Eastern', '$$', 3.60),
(39, 'Tomiris', '9B Azattyk Avenue', 'European', '$$', 3.60),
(40, 'Bon Appetit', 'Musa Baymukhanova street, 17B', 'Uzbek', '$$', 3.90),
(41, 'Bon Appetit', 'Musa Baymukhanova street, 17B', 'Eastern', '$$', 3.90),
(42, 'Bon Appetit', 'Musa Baymukhanova street, 17B', 'Kazakh', '$$', 3.90),
(43, 'ASSORTI', '4a Syrym Datov Street', 'Italian', '$$', 1.80),
(44, 'ASSORTI', '4a Syrym Datov Street', 'Eastern', '$$', 1.80),
(45, 'Afiyet', 'Almagul microdistrict, 24a', 'European', '$$', 2.50),
(47, 'YAMATO', 'Kanysha Satpayev Avenue, 37', 'European', '$$', 3.00),
(48, 'Be cloud', 'Abulkhair Khan Avenue, 63 block 6', 'Italian', '$$$', 4.60),
(49, 'Hayat', 'Yuri Gagarin Street, 65', 'Kazakh', '$$', 3.90),
(50, 'Hayat', 'Yuri Gagarin Street, 65', 'Russian', '$$', 3.90),
(51, 'Asahi food', 'Karshymbai Akhmediyarov street, 15b', 'Japan', '$$', 2.50),
(52, 'Iris', 'Isatay Taimanov Avenue, 48 block J', 'Eastern', '$$', 4.10),
(53, 'Iris', 'Isatay Taimanov Avenue, 48 block J', 'European', '$$', 4.10),
(54, 'Taqiya', 'Kanysh Satpayev Avenue, 8', 'Eastern', '$$', 3.30),
(55, 'FRIENDS', 'Baktygereya Kulmanova street, 131', 'European', '$$', 3.30),
(56, 'Alize', '83b Akademika Zharbosynova Street', 'Italian', '$$', 3.50),
(57, 'Alize', '83b Akademika Zharbosynova Street', 'Japan', '$$', 3.50),
(58, 'Alize', '83b Akademika Zharbosynova Street', 'European', '$$', 3.50),
(59, 'Bungalow', 'Avangard microdistrict-4, 12a', 'European', '$$$', 4.50),
(60, 'Bungalow', 'Avangard microdistrict-4, 12a', 'Caucasian', '$$$', 4.50),
(61, 'Beer House Bavarius', '83b Akademika Zharbosynova Street', 'European', '$$$', 3.80),
(62, 'Renovatio', 'Avangard-2, 22a microdistrict', 'European', '$$$', 4.20),
(63, 'Lavanda with love', '52b Kayyrgali Smagulov Street', 'European', '$$$', 3.00);

-- --------------------------------------------------------

--
-- Структура таблицы `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `restaurant_id` int(11) DEFAULT NULL,
  `rating` decimal(2,1) NOT NULL,
  `review_text` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `restaurant_id` (`restaurant_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `photos_restaurants`
--
ALTER TABLE `photos_restaurants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `restaurant_id` (`restaurant_id`);

--
-- Индексы таблицы `pricerange`
--
ALTER TABLE `pricerange`
  ADD PRIMARY KEY (`id`),
  ADD KEY `restaurant_id` (`restaurant_id`);

--
-- Индексы таблицы `restaurants`
--
ALTER TABLE `restaurants`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `restaurant_id` (`restaurant_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `photos`
--
ALTER TABLE `photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `photos_restaurants`
--
ALTER TABLE `photos_restaurants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT для таблицы `pricerange`
--
ALTER TABLE `pricerange`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT для таблицы `restaurants`
--
ALTER TABLE `restaurants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT для таблицы `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `photos`
--
ALTER TABLE `photos`
  ADD CONSTRAINT `photos_ibfk_1` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`),
  ADD CONSTRAINT `photos_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ограничения внешнего ключа таблицы `photos_restaurants`
--
ALTER TABLE `photos_restaurants`
  ADD CONSTRAINT `photos_restaurants_ibfk_1` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`);

--
-- Ограничения внешнего ключа таблицы `pricerange`
--
ALTER TABLE `pricerange`
  ADD CONSTRAINT `pricerange_ibfk_1` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`);

--
-- Ограничения внешнего ключа таблицы `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
