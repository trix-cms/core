<?php

namespace Utility;

class File
{
    function remove_dir($path)
    {
        if( file_exists($path) )
        {
            $dir = opendir($path);
        
            while( ($item = readdir($dir)) !== FALSE )
            {
                if( $item != '.' AND $item != '..' )
                {
                    $item_path = $path . '/'. $item;
                    
                    if( is_dir($item_path) )
                    {                    
                        $this->remove_dir($item_path);
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
    }
}