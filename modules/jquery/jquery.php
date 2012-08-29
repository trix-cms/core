<?php

class jQuery extends Modules\AbstractModule
{
    /**
     * Имя модуля
     */
    public $name = 'jQuery';
    
    /**
     * Имя модуля
     */
    public $description = 'Добавляет ссылку на jQuery';
    
    /**
     * Имя на англ.
     */
    public $slug = 'jQuery';
    
    /**
     * Версия
     */
    public $version = '1.1.1';
    
    /**
     * Является ли вспомогательным модулем
     */
    public $is_helper = 1;
    
    public $is_core = 1;
    
    /**
     * Автор
     */
    public $author = 'Trix';
    
    function update()
    {
        $this->load->model('modules/modules_m');
        
        $this->modules_m->by_slug($this->slug)->delete();
        
        parent::install();
    }
}