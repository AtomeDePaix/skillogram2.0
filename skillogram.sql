-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Ноя 28 2017 г., 14:40
-- Версия сервера: 10.1.28-MariaDB
-- Версия PHP: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `skillogram`
--

-- --------------------------------------------------------

--
-- Структура таблицы `authentication`
--

CREATE TABLE `authentication` (
  `user_id` int(11) NOT NULL,
  `login` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `added_at` datetime NOT NULL,
  `photo` varchar(256) NOT NULL,
  `comment` text NOT NULL,
  `like_sum` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `post`
--

INSERT INTO `post` (`id`, `user_id`, `added_at`, `photo`, `comment`, `like_sum`) VALUES
(1, 39, '2017-11-28 10:54:17', 'images/photos/photo2017-11-2810:54:17936.jpg', 'Устал', 972),
(5, 49, '2017-11-28 13:43:13', 'images/photos/photo2017-11-2813:43:13271.jpg', 'Чаепитие', 928),
(6, 50, '2017-11-28 13:43:52', 'images/photos/photo2017-11-2813:43:5250.jpg', 'Всем привет!', 294),
(7, 51, '2017-11-28 13:45:33', 'images/photos/photo2017-11-2813:45:33253.jpg', 'Люблю книжечки почитать', 206),
(8, 51, '2017-11-28 13:46:29', 'images/photos/photo2017-11-2813:46:29664.jpg', 'Наше семейство', 417);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `login` varchar(128) NOT NULL,
  `password` varchar(16) NOT NULL,
  `username` varchar(128) NOT NULL,
  `avatar` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `user_id`, `login`, `password`, `username`, `avatar`) VALUES
(21, 39, '', '', 'Енот Федот', 'images/avatars/avatar39.jpg'),
(28, 49, '', '', 'Медведь Степан', 'images/avatars/avatar49.jpg'),
(29, 50, '', '', 'Жираф Геннадий', 'images/avatars/avatar50.jpg'),
(30, 51, '', '', 'Капибара Кузьма', 'images/avatars/avatar51.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `user_auth`
--

CREATE TABLE `user_auth` (
  `id` int(11) NOT NULL,
  `login` varchar(64) NOT NULL,
  `password` varchar(32) NOT NULL,
  `salt` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user_auth`
--

INSERT INTO `user_auth` (`id`, `login`, `password`, `salt`) VALUES
(39, 'enot', '3e92afcb004b4702c8936e0558fa3d93', '87'),
(49, 'medved', 'cc7822d54eadb2800a59911c7953a406', '80'),
(50, 'jiraffe', '879d6edae54bf9deba68cfa54db2c9da', '71'),
(51, 'kapibara', '93897cc117a734be93733779051c9926', '58');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `authentication`
--
ALTER TABLE `authentication`
  ADD PRIMARY KEY (`user_id`);

--
-- Индексы таблицы `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user_auth`
--
ALTER TABLE `user_auth`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login_2` (`login`),
  ADD KEY `login` (`login`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `authentication`
--
ALTER TABLE `authentication`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT для таблицы `user_auth`
--
ALTER TABLE `user_auth`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
