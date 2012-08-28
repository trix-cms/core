<?php

class Users extends Modules\AbstractModule
{
    /**
     * Имя модуля
     */
    public $name = 'Пользователи';
    
    /**
     * Имя модуля
     */
    public $description = 'Пользователи с группами и правами';
    
    /**
     * Имя на англ.
     */
    public $slug = 'users';    
    
    /**
     * Версия
     */
    public $version = '1.0';
    
    /**
     * Относится ли модуль к ядру
     */
    public $is_core = 1;
    
    /**
     * Работает ли в публичной части сайта
     */
    public $is_frontend = 1;
    
    /**
     * Работает ли в административной части сайта
     */
    public $is_backend = 1;
    
    /**
     * Автор
     */
    public $author = 'Trix';
    
    function install()
    {
        parent::install();
        
        $this->db->dbprefix('permissions');
        
        $this->db->query("CREATE TABLE IF NOT EXISTS ". $this->db->dbprefix('permissions') ." (
              `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
              `group_slug` varchar(50) NOT NULL,
              `has_backend_access` tinyint(1) unsigned NOT NULL,
              `permissions` mediumtext NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=MyISAM  DEFAULT CHARSET=utf8;");
            
        $this->db->query("INSERT INTO ". $this->db->dbprefix('permissions') ." (`id`, `group_slug`, `has_backend_access`, `permissions`) VALUES
(1, 'admins', 1, 'a:14:{s:7:\"modules\";i:1;s:4:\"page\";i:1;s:8:\"settings\";i:1;s:5:\"users\";i:1;s:10:\"navigation\";i:1;s:4:\"news\";i:1;s:10:\"categories\";i:1;s:4:\"tags\";i:1;s:11:\"permissions\";i:1;s:8:\"comments\";i:1;s:8:\"scaffold\";i:1;s:8:\"contacts\";i:1;s:10:\"migrations\";i:1;s:5:\"forum\";i:1;}'),
(4, 'users', 0, '');");
        
        $this->db->query("CREATE TABLE IF NOT EXISTS ". $this->db->dbprefix('users') ." (
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
            ) ENGINE=MyISAM  DEFAULT CHARSET=utf8;");
        
        $this->db->query("INSERT INTO ". $this->db->dbprefix('users') ." (`id`, `group_slug`, `login`, `password`, `signature`, `email`, `reset_token`, `register_date`, `lastvisit_date`, `last_ip`, `avatar`, `user_agent`) VALUES
(1, 'admins', 'admin', 'a52688416ce94dc940f53c514c216adc75492e85', '', 'tbakarov@gmail.com', '', 0, 1346137203, '192.168.1.100', '43604caa5427310004ee38f658b96051.jpg', '0'),
(0, 'guests', 'guest', '', '', '', '', 0, 0, '127.0.0.1', 'default.gif', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/536.5 (KHTML, like Gecko) Chrome/19.0.1084.52 Safari/536.5');");        
        
        $this->db->query("CREATE TABLE IF NOT EXISTS ". $this->db->dbprefix('users_groups') ." (
          `slug` varchar(25) NOT NULL,
          `name` varchar(50) NOT NULL,
          `default` tinyint(1) NOT NULL,
          PRIMARY KEY (`slug`)
        ) ENGINE=MyISAM DEFAULT CHARSET=utf8;");
        
        $this->db->query("INSERT INTO ". $this->db->dbprefix('users_groups') ." (`slug`, `name`, `default`) VALUES
            ('admins', 'Администраторы', 1),
            ('users', 'Пользователи', 1),
            ('guests', 'Гости', 1);");
    }
    
    function update()
    {
        parent::install();
    }
}