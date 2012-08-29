-- phpMyAdmin SQL Dump
-- version 3.5.2.1
-- http://www.phpmyadmin.net
--
-- Хост: 192.168.1.100:3306
-- Время создания: Авг 30 2012 г., 01:32
-- Версия сервера: 5.5.27-log
-- Версия PHP: 5.3.15

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- База данных: `trix-core`
--

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `module` varchar(50) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(648) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `is_active` tinyint(1) unsigned NOT NULL,
  `lft` int(10) unsigned NOT NULL,
  `rgt` int(10) unsigned NOT NULL,
  `level` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `module`, `title`, `description`, `icon`, `is_active`, `lft`, `rgt`, `level`) VALUES
(1, '', 'Корень', '', '', 0, 1, 2, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `version` int(3) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`version`) VALUES
(2);

-- --------------------------------------------------------

--
-- Структура таблицы `modules`
--

CREATE TABLE IF NOT EXISTS `modules` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `version` varchar(10) NOT NULL,
  `class` varchar(25) NOT NULL,
  `is_frontend` tinyint(1) NOT NULL,
  `is_backend` tinyint(1) unsigned NOT NULL,
  `is_core` tinyint(1) NOT NULL,
  `is_utility` tinyint(1) NOT NULL,
  `is_helper` tinyint(1) unsigned NOT NULL,
  `enable` tinyint(1) NOT NULL,
  `author` varchar(50) NOT NULL,
  `created_on` int(10) unsigned NOT NULL,
  `update_on` int(10) unsigned NOT NULL,
  `url` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `modules`
--

INSERT INTO `modules` (`id`, `name`, `description`, `version`, `class`, `is_frontend`, `is_backend`, `is_core`, `is_utility`, `is_helper`, `enable`, `author`, `created_on`, `update_on`, `url`) VALUES
(207, 'Вход в панель управления', 'Страница входа в панель управления', '0.1', 'Admin', 1, 0, 1, 0, 0, 0, 'Trix', 0, 0, 'admin'),
(7, 'Настройки', 'Настройки модулей и сайта', '0.1', 'Settings', 0, 1, 1, 0, 0, 1, 'Trix', 0, 0, 'settings'),
(204, 'Пользователи', 'Пользователи с группами и правами', '0.1', 'Users', 1, 1, 1, 0, 0, 1, 'Trix', 0, 0, 'users'),
(127, 'Категории', 'Модуль позволяет добавлять категории в другие модули', '0.1', 'Categories', 0, 1, 1, 0, 0, 0, 'Trix', 0, 0, ''),
(203, 'jQuery', 'Добавляет ссылку на jQuery', '1.1.1', 'jQuery', 0, 0, 1, 0, 1, 0, 'Trix', 0, 0, ''),
(208, 'Assets', 'Хелпер для работы с js, css и изображениями', '0.1', 'Assets', 0, 0, 1, 0, 1, 0, 'Trix', 0, 0, ''),
(209, 'Dashboard', 'Первая страница при входе в панель управления или на сайт', '0.1', 'Dashboard', 0, 1, 1, 0, 0, 0, 'Trix', 0, 0, 'dashboard'),
(210, 'HTML', 'Хелпер для работы с html', '0.1', 'HTML', 0, 0, 1, 0, 1, 0, 'Trix', 0, 0, ''),
(211, 'Установщик', 'Начальная установка TrixCMS', '0.1', 'Install', 0, 0, 0, 0, 0, 1, 'Trix', 0, 0, ''),
(212, 'Миграции', 'Модуль миграций БД', '0.1', 'Migrations', 0, 1, 1, 1, 0, 0, 'Trix', 0, 0, 'migrations'),
(213, 'URL', 'Хелпер для формирования ссылок, редиректа и пр.', '0.1', 'URL', 0, 0, 1, 0, 1, 0, 'Trix', 0, 0, ''),
(214, 'CURL', 'CURL php by PhilSturgeon', '0.1', 'Trix\\Curl', 0, 0, 1, 0, 1, 0, 'Trix', 0, 0, ''),
(215, 'File', 'Хелпер для работы с файлами', '0.1', 'Trix\\File', 0, 0, 1, 0, 1, 0, 'Trix', 0, 0, ''),
(216, 'String', 'Хелпер для работы со строками', '0.1', 'Trix\\String', 0, 0, 1, 0, 1, 0, 'Trix', 0, 0, ''),
(217, 'WYSIWYG', 'Визуальные редакторы. TinyMCE, CKEditor, Redaktor', '0.1', 'Trix\\WYSIWYG', 0, 0, 1, 0, 1, 0, 'Trix', 0, 0, ''),
(245, 'Модули', 'Модуль для добавления, удаления и других операций с модулями.', '0.1.1', 'Modules\\Base', 0, 1, 1, 0, 0, 0, 'Trix', 0, 0, 'modules');

-- --------------------------------------------------------

--
-- Структура таблицы `permissions`
--

CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `group_slug` varchar(50) NOT NULL,
  `has_backend_access` tinyint(1) unsigned NOT NULL,
  `permissions` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `permissions`
--

INSERT INTO `permissions` (`id`, `group_slug`, `has_backend_access`, `permissions`) VALUES
(1, 'admins', 1, 'a:4:{s:7:"modules";i:1;s:8:"settings";i:1;s:5:"users";i:1;s:10:"categories";i:1;}'),
(4, 'users', 0, 'a:0:{}');

-- --------------------------------------------------------

--
-- Структура таблицы `sessions`
--

CREATE TABLE IF NOT EXISTS `sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `user_agent` varchar(255) NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `request_uri` varchar(255) NOT NULL DEFAULT 'index.html',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `sessions`
--

INSERT INTO `sessions` (`session_id`, `ip_address`, `user_agent`, `user_id`, `last_activity`, `request_uri`, `user_data`) VALUES
('vf30cspstealr7i1qpg7u1pa00', '192.168.1.100', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.1 (KHTML, like Gecko) Chrome/21.0.1180.83 Safari/537.1', 1, 1346275417, '', 'regenerated|i:1346275248;ip_address|s:13:"192.168.1.100";user_id|s:1:"1";');

-- --------------------------------------------------------

--
-- Структура таблицы `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `slug` varchar(30) NOT NULL,
  `module` varchar(20) NOT NULL,
  `tabs` varchar(30) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `type` enum('text','textarea','password','select','select-multiple','radio','checkbox') NOT NULL,
  `options` varchar(255) NOT NULL,
  PRIMARY KEY (`slug`,`module`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `settings`
--

INSERT INTO `settings` (`slug`, `module`, `tabs`, `title`, `description`, `value`, `type`, `options`) VALUES
('frontend_enabled', 'settings', 'Общие', 'Состояние сайта', 'Делает сайт доступным для просмтра или нет', '1', 'select', '0=Закрыт|1=Открыт'),
('site_name', 'settings', 'SEO', 'Название сайта', 'Название сайта, которое будет выводиться в заголовке страницы', 'TRIX', 'text', ''),
('unavailable_message', 'settings', 'Общие', 'Сообщение при закрытом сайте', 'Сообщение, которое будет выводиться если сайт закрыт', 'Сайт закрыт', 'textarea', ''),
('server_email', 'settings', 'Общие', 'Серверная почта', 'На эту почту будут отправляться все тех сообщения', 'timurbakarov@mail.ru', 'text', ''),
('site_description', 'settings', 'SEO', 'Описание сайта', 'Текст, который будет добавлен в тег description', '', 'textarea', ''),
('site_keywords', 'settings', 'SEO', 'Ключевые слова', 'Слова будут добавлены в тег keywords', '', 'text', ''),
('registration', 'users', '', 'Регистрация', 'Определяет открыта ли регистрация или нет', '1', 'select', '1=Открыта|0=Закрыта'),
('user_activation', 'users', '', 'Активация', 'Определяет способ активации аккаунта пользователя', '2', 'select', '1=Не требуется|2=Письмом|3=Ручная');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `group_slug` varchar(25) NOT NULL,
  `login` varchar(25) NOT NULL,
  `password` char(40) NOT NULL,
  `signature` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `activation_code` varchar(40) NOT NULL,
  `reset_token` varchar(40) NOT NULL,
  `register_date` int(11) unsigned NOT NULL,
  `lastvisit_date` int(11) unsigned NOT NULL,
  `last_ip` varchar(15) NOT NULL,
  `avatar` varchar(40) NOT NULL DEFAULT 'default.gif',
  `user_agent` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `group_slug`, `login`, `password`, `signature`, `email`, `is_active`, `activation_code`, `reset_token`, `register_date`, `lastvisit_date`, `last_ip`, `avatar`, `user_agent`) VALUES
(1, 'admins', 'admin', 'a52688416ce94dc940f53c514c216adc75492e85', '', 'tbakarov@gmail.com', 1, '', '', 0, 1346275417, '192.168.1.100', '43604caa5427310004ee38f658b96051.jpg', '0'),
(0, 'guests', 'guest', '', '', '', 0, '', 'ea7dcbdc40ac8bb74ff8723018b6fd44f1bd3718', 0, 0, '127.0.0.1', 'default.gif', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/536.5 (KHTML, like Gecko) Chrome/19.0.1084.52 Safari/536.5');

-- --------------------------------------------------------

--
-- Структура таблицы `users_groups`
--

CREATE TABLE IF NOT EXISTS `users_groups` (
  `slug` varchar(25) NOT NULL,
  `name` varchar(50) NOT NULL,
  `default` tinyint(1) NOT NULL,
  PRIMARY KEY (`slug`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users_groups`
--

INSERT INTO `users_groups` (`slug`, `name`, `default`) VALUES
('admins', 'Администраторы', 1),
('users', 'Пользователи', 1),
('guests', 'Гости', 1);
