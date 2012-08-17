<?php

class Migrations_m extends MY_Model {
    
    public $table = 'migrations';
    
    function __construct()
    {
        parent::__construct();
        
        // загружаем конфиг
        $this->load->config('migration');
    }
    
    function count_new()
    {
        $this->load->library('migration');

        // последняя версия
        $latest = $this->get_latest();
        
        // текущая версия
        $version = $this->get_version();
        
        return $latest > $version ? $latest - $version : 0;
    }
    
    function get_version()
    {
        return $this->get_one()->version;
    }
    
    function get_latest()
    {
        $migrations = Migrations\Helper::get_migrations();
        
        return (int)substr(basename(end($migrations)), 0, 3);
    }
}