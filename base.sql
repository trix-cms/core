-- phpMyAdmin SQL Dump
-- version 3.4.9
-- http://www.phpmyadmin.net
--
-- Хост: openserver:3306
-- Время создания: Июн 05 2012 г., 11:45
-- Версия сервера: 5.1.61
-- Версия PHP: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- База данных: `base`
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
(1);

-- --------------------------------------------------------

--
-- Структура таблицы `modules`
--

CREATE TABLE IF NOT EXISTS `modules` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `title` varchar(25) NOT NULL,
  `description` varchar(255) NOT NULL,
  `url` varchar(25) NOT NULL,
  `is_frontend` tinyint(1) NOT NULL,
  `is_core` tinyint(1) NOT NULL,
  `is_menu` tinyint(1) unsigned NOT NULL,
  `enable` tinyint(1) NOT NULL,
  `order` tinyint(3) unsigned NOT NULL,
  `has_submenu` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `modules`
--

INSERT INTO `modules` (`id`, `name`, `title`, `description`, `url`, `is_frontend`, `is_core`, `is_menu`, `enable`, `order`, `has_submenu`) VALUES
(1, 'modules', 'Модули', '', 'modules', 0, 1, 1, 1, 10, 0),
(2, 'page', 'Страницы', '', 'page', 1, 1, 1, 1, 8, 1),
(3, 'settings', 'Настройки', '', 'settings', 0, 1, 1, 1, 6, 0),
(4, 'users', 'Пользователи', '', 'users', 1, 1, 1, 1, 1, 1),
(5, 'news', 'Новости', '', 'news', 1, 0, 1, 1, 7, 1),
(6, 'categories', 'Категории', '', 'categories', 0, 1, 0, 1, 4, 0),
(7, 'pemissions', 'Права', '', 'permissions', 0, 1, 1, 1, 5, 0),
(8, 'scaffold', 'Scaffolding', '', 'scaffold', 0, 1, 0, 0, 10, 0),
(9, 'migrations', 'Миграции', '', 'migrations', 0, 1, 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(50) NOT NULL,
  `title` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `created_on` int(10) unsigned NOT NULL,
  `updated_on` int(10) unsigned NOT NULL,
  `comments` int(10) unsigned NOT NULL,
  `views` int(10) unsigned NOT NULL,
  `active_comments` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `page`
--

CREATE TABLE IF NOT EXISTS `page` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` mediumtext NOT NULL,
  `is_home` tinyint(1) unsigned NOT NULL,
  `status` enum('live','draft') NOT NULL,
  `description` varchar(255) NOT NULL,
  `keywords` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


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
(1, 'admins', 1, 'a:14:{s:7:"modules";i:1;s:4:"page";i:1;s:8:"settings";i:1;s:5:"users";i:1;s:10:"navigation";i:1;s:4:"news";i:1;s:10:"categories";i:1;s:4:"tags";i:1;s:11:"permissions";i:1;s:8:"comments";i:1;s:8:"scaffold";i:1;s:8:"contacts";i:1;s:10:"migrations";i:1;s:5:"forum";i:1;}'),
(2, 'users', 0, '');

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
('frontend_enabled', 'settings', '', 'Состояние сайта', 'Делает сайт доступным для просмтра или нет', '1', 'select', '0=Закрыт|1=Открыт'),
('site_name', 'settings', '', 'Название сайта', 'Название сайта, которое будет выводиться в заголовке страницы', 'BASE', 'text', ''),
('unavailable_message', 'settings', '', 'Сообщение при закрытом сайте', 'Сообщение, которое будет выводиться если сайт закрыт', 'Сайт закрыт', 'textarea', ''),
('server_email', 'settings', '', 'Серверная почта', 'На эту почту будут отправляться все тех сообщения', 'timurbakarov@mail.ru', 'text', ''),
('site_description', 'settings', '', 'Описание сайта', 'Текст, который будет добавлен в тег description', '', 'textarea', ''),
('site_keywords', 'settings', '', 'Ключевые слова', 'Слова будут добавлены в тег keywords', '', 'text', ''),
('registration', 'users', '', 'Регистрация', 'Определяет открыта ли регистрация или нет', '1', 'select', '1=Открыта|0=Закрыта'),
('user_activation', 'users', '', 'Активация', 'Определяет способ активации аккаунта пользователя', '2', 'select', '1=Не требуется|2=Письмом|3=Ручная'),
('per_page', 'news', '', 'Новостей на страницу', '', '10', 'text', ''),
('wm_purse', 'bux', 'Общие', 'Кошелек WM', '', 'R859836300780', 'text', '');

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

INSERT INTO `users` (`id`, `group_slug`, `login`, `password`, `signature`, `email`, `reset_token`, `register_date`, `lastvisit_date`, `last_ip`, `avatar`, `user_agent`) VALUES
(1, 'admins', 'admin', 'a52688416ce94dc940f53c514c216adc75492e85', '', 'tbakarov@gmail.com', '', 0, 1338882262, '127.0.0.1', '43604caa5427310004ee38f658b96051.jpg', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/536.5 (KHTML, like Gecko) Chrome/19.0.1084.52 Safari/536.5'),
(0, 'guests', 'guest', '', '', '', '', 0, 0, '127.0.0.1', 'default.gif', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/536.5 (KHTML, like Gecko) Chrome/19.0.1084.52 Safari/536.5');

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
('admins', 'Администратор', 1),
('users', 'Пользователь', 1),
('guests', 'Гости', 1);
