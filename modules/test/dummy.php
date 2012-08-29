<?php

class Dummy extends Modules\AbstractModule
{
    /**
     * Имя модуля
     */
    public $name = 'Dummy';
    
    /**
     * Имя модуля
     */
    public $description = 'Тестовый модуль';
    
    /**
     * Имя на англ.
     */
    public $slug = 'Test\Dummy';    
    
    /**
     * Версия
     */
    public $version= '0.1';
    
    /**
     * Является ли модуль утилитой
     */
    public $is_utility = 0;
    
    /**
     * Является ли вспомогательным модулем
     */
    public $is_helper = 1;
    
    /**
     * Относится ли модуль к ядру
     */
    public $is_core = 0;
    
    /**
     * Работает ли в публичной части сайта
     */
    public $is_frontend = 0;
    
    /**
     * Работает ли в административной части сайта
     */
    public $is_backend = 0;
    
    /**
     * Автор
     */
    public $author = 'Trix';
    
    public function install()
    {
        $this->add_to_modules();
    }
    
    public function uninstall()
    {        
        $this->modules_m->by_slug($this->slug)->delete();
        $this->settings_m->by_module($this->slug)->delete();
    }
    
    public function update()
    {        
        $this->modules_m->by_slug($this->slug)->delete();
        $this->add_to_modules();
    }
    
    protected function add_to_modules()
    {
        $this->modules_m->insert(array(
            'name'=>$this->name,
            'description'=>$this->description,
            'slug'=>$this->slug,
            'version'=>$this->version,
            'is_utility'=>$this->is_utility,
            'is_helper'=>$this->is_helper,
            'is_core'=>$this->is_core,
            'is_frontend'=>$this->is_frontend,
            'is_backend'=>$this->is_backend,
            'author'=>$this->author,
        ));
    }
    
    public function files()
    {
        return array();
    }
}