<?php

class News extends Modules\AbstractModule
{
    /**
     * Имя модуля
     */
    public $name = 'Новости';
    
    /**
     * Имя модуля
     */
    public $description = 'Простой модуль новостей';
    
    /**
     * Имя на англ.
     */
    public $class = 'News';
    
    /**
     * Ссылка
     */
    public $url = 'news';
    
    /**
     * Версия
     */
    public $version = '0.1.2';
    
    /**
     * Является ли модуль утилитой
     */
    public $is_utility = 0;
    
    /**
     * Является ли вспомогательным модулем
     */
    public $is_helper = 0;
    
    /**
     * Относится ли модуль к ядру
     */
    public $is_core = 0;
    
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
        
        $this->dump_sql();
    }
    
    function dump_sql()
    {
        $this->db->query("
            CREATE TABLE IF NOT EXISTS ". $this->db->dbprefix('news') ." (
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
        ");
        
        $this->db->query("
            INSERT INTO ". $this->db->dbprefix('settings') ." (`slug`, `module`, `tabs`, `title`, `description`, `value`, `type`, `options`) VALUES ('per_page', 'news', '', 'Новостей на страницу', '', '10', 'text', '')
        ");
    }
    
    function uninstall()
    {
        parent::uninstall();
        
        $this->db->query("DROP TABLE IF EXISTS ". $this->db->dbprefix('news'));
    }
}