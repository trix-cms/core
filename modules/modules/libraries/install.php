<?php

namespace Modules;

class Install
{
    private $module;
    private $class;
    
    public function __construct($module)
    {
        $this->class = str_replace('-', '\\', $module);
        $this->module = strtolower($module);
    }
    
    /**
     * Запуска установки
     */
    public function run()
    {
        // загружаем файлы
        $this->download();
        
        // распаковываем
        $this->unzip();
    
        // устанавливаем
        $this->install();
    }
    
    /**
     * Скачивание модуля
     */
    function download()
    {        
        $archive = file_get_contents(Config::ADDONS_URL . 'download/' . $this->module);
        
        file_put_contents('modules/' . $this->module .'.zip', $archive);
    }
    
    /**
     * Распаковка модуля
     */    
    function unzip()
    {
        $zip = new \ZipArchive;
        
        $file = 'modules/' . $this->module .'.zip';
        
        $res = $zip->open($file);
        
        if ($res === TRUE)
        {
            $folder = '';
            if( strstr($this->module, '-') !== FALSE )
            {
                list($folder) = explode('-', $this->module);
                $folder = '/'. $folder;
            } 
            
            $zip->extractTo('modules' . $folder);
            $zip->close();
            
            unlink($file);
            
            return TRUE;
        } 
        else 
        {
            return FALSE;
        }
    }
    
    /**
     * Установка модуля
     */
    function install()
    {
        if( strstr($this->module, '-') )
        {
            include('modules/'. str_replace('-', DIRECTORY_SEPARATOR, $this->module) . EXT);
        }
        else
        {
            include('modules/'. $this->module .'/'. $this->module . EXT);
        }
        
        $class = '\\'. $this->class;
        $class = new $class;
        
        $class->install();
    }
}