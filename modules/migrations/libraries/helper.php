<?php

namespace Migrations;

class Helper {
    
    function get_migrations()
    {
        return glob($this->config->item('migration_path') .'*_*.php');
    }
    
    /**
     * Преобрзует название файла миграций в номер версии
     */
    function version($file)
    {        
        return preg_match('/\d+/', $file, $number) ? (int)$number[0] : FALSE;
    }
}