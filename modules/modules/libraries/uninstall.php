<?php

namespace Modules;

class Uninstall
{
    private $module;
    private $module_class;
    
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
        $this->module_class = $this->get_module_class();
        
        // удаляем из БД
        $this->module_class->uninstall();
        
        // удаляем файлы
        $this->delete();
    }
    
    /**
     * Удаление файлов
     */
    function delete()
    {        
        $fileHelper = new \Utility\File;
        
        $files = $this->module_class->files();
        
        if( count($files) > 0)
        {
            $folder = $this->module .'/';
            if( strstr($this->module, '-') !== FALSE )
            {
                list($folder) = explode('-', $this->module);
                $folder = $folder . '/';
            }
            
            foreach($files as $file)
            {
                $file = 'modules/'. $folder . str_replace('..', '', $file);
                
                $fileHelper->remove($file);
            }
        }
        else
        {
            $fileHelper->remove('modules/'. $this->module);
        }
    }
    
    function get_module_class()
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
        return new $class;
    }
}