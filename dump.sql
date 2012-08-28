-- phpMyAdmin SQL Dump
-- version 3.5.2.1
-- http://www.phpmyadmin.net
--
-- Хост: 192.168.1.100:3306
-- Время создания: Авг 28 2012 г., 21:04
-- Версия сервера: 5.5.27-log
-- Версия PHP: 5.3.15

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- База данных: `trix-core`
--

-- --------------------------------------------------------

--
-- Структура таблицы `modules`
--

CREATE TABLE IF NOT EXISTS `modules` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `version` varchar(10) NOT NULL,
  `slug` varchar(25) NOT NULL,
  `is_frontend` tinyint(1) NOT NULL,
  `is_backend` tinyint(1) unsigned NOT NULL,
  `is_core` tinyint(1) NOT NULL,
  `is_utility` tinyint(1) NOT NULL,
  `is_helper` tinyint(1) unsigned NOT NULL,
  `enable` tinyint(1) NOT NULL,
  `author` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `modules`
--

INSERT INTO `modules` (`id`, `name`, `description`, `version`, `slug`, `is_frontend`, `is_backend`, `is_core`, `is_utility`, `is_helper`, `enable`, `author`) VALUES
(4, 'Модули', 'Модуль операций с модулями.', '1.0', 'modules', 0, 1, 1, 0, 0, 1, 'Trix'),
(207, 'Вход в панель управления', 'Страница входа в панель управления', '0.1', 'admin', 1, 0, 1, 0, 0, 0, 'Trix'),
(7, 'Настройки', 'Настройки модулей и сайта', '1.0', 'settings', 0, 1, 1, 0, 0, 1, 'Trix'),
(204, 'Пользователи', 'Пользователи с группами и правами', '1.0', 'users', 1, 1, 1, 0, 0, 1, 'Trix'),
(127, 'Категории', 'Модуль позволяет добавлять категории в другие модули', '0.1', 'categories', 0, 1, 1, 0, 0, 0, 'Trix'),
(203, 'jQuery', 'Добавляет ссылку на jQuery', '1.1.1', 'jQuery', 0, 0, 1, 0, 1, 0, 'Trix'),
(208, 'Assets', 'Хелпер для работы с js, css и изображениями', '0.1', 'assets', 0, 0, 1, 0, 1, 0, 'Trix'),
(209, 'Dashboard', 'Первая страница при входе в панель управления или на сайт', '0.1', 'Dashboard', 0, 1, 1, 0, 0, 0, 'Trix'),
(210, 'HTML', 'Хелпер для работы с html', '0.1', 'HTML', 0, 0, 1, 0, 1, 0, 'Trix'),
(211, 'Установщик', 'Начальная установка TrixCMS', '0.1', 'Install', 0, 0, 0, 0, 0, 1, 'Trix'),
(212, 'Миграции', 'Модуль миграций БД', '0.1', 'Migrations', 0, 0, 1, 1, 0, 0, 'Trix'),
(213, 'URL', 'Хелпер для формирования ссылок, редиректа и пр.', '0.1', 'URL', 0, 0, 1, 0, 1, 0, 'Trix'),
(214, 'CURL', 'CURL php by PhilSturgeon', '0.1', 'Trix\\Curl', 0, 0, 1, 0, 1, 0, 'Trix'),
(215, 'File', 'Хелпер для работы с файлами', '0.1', 'Trix\\File', 0, 0, 1, 0, 1, 0, 'Trix'),
(216, 'String', 'Хелпер для работы со строками', '0.1', 'Trix\\String', 0, 0, 1, 0, 1, 0, 'Trix'),
(217, 'WYSIWYG', 'Визуальные редакторы. TinyMCE, CKEditor, Redaktor', '0.1', 'Trix\\WYSIWYG', 0, 0, 1, 0, 1, 0, 'Trix');
