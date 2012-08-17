<?php

namespace News;

class Helper {
    
    // если мы пришли на страницу с адреса в котором нет нужных слов, то false
    public static function came_from_this_page(array $words)
    {
        if (!isset($_SERVER['HTTP_REFERER']))  return false;        
        $url = $_SERVER['HTTP_REFERER'];    
                        
        foreach ($words as $word)
        {
            $pos = strpos($url, $word);
            
            if ($pos === false)
            {
                return false;
            }   
        }                                     
        
        return true;
    }
}