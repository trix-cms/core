<?php

namespace Utility;

class File
{
    /**
     * Удаляет папку или файл
     * Папку удаляет со всем содержимым
     */
    function remove($path)
    {
        if( file_exists($path) )
        {
            if( is_dir($path) )
            {
                $dir = opendir($path);
        
                while( ($item = readdir($dir)) !== FALSE )
                {
                    if( $item != '.' AND $item != '..' )
                    {
                        $item_path = $path . '/'. $item;
                        
                        if( is_dir($item_path) )
                        {                    
                            $this->remove($item_path);
                        }
                        else
                        {
                            unlink($item_path);
                        }
                    }
                }
                
                rmdir($path);
                closedir($dir);
            }
            else
            {
                unlink($path);
            }
        }
    }
}