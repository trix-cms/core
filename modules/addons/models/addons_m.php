<?php

class Addons_m extends Trix_Model{
    
    const TYPE_MODULE = 1;
    const TYPE_UTILITY = 2;
    const TYPE_HELPER = 3;
    
    static function get_types()
    {
        return array(
            self::TYPE_MODULE=>'модуль',
            self::TYPE_UTILITY=>'утилита',
            self::TYPE_HELPER=>'хелпер'
        );
    }
}