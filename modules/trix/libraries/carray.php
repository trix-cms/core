<?php

namespace Trix;

class CArray {
    
    static function map($haystack, $key, $value)
    {
        $foo = array();
        foreach($haystack as $item)
        {
            $foo[$item->$key] = $item->$value;
        }
        
        return $foo;
    }
}