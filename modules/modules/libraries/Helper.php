<?php

namespace Modules;

use CI;

class Helper {

    static $modulesNames = array();

    public static function slug_Title()
    {
        $result = CI::$APP->modules_m->get_all();

        $modules = array();
        foreach($result as $module)
        {
            $modules[$module->url] = $module->title;
        }

        return $modules;
    }

    function name($slug)
    {
        if( empty(self::$modulesNames) )
        {
            $CI =& get_instance();
            $CI->load->library('cache');

            $modulesNames = $CI->cache->get('modulesNames');

            if( $modulesNames === FALSE )
            {
                $modules = $CI->modules_m->select('title, url')->get_all();

                $modulesNames = array();
                foreach($modules as $module)
                {
                    $modulesNames[$module->url] = $module->title;
                }

                $CI->cache->write($modulesNames, 'modulesNames');
            }

            self::$modulesNames = $modulesNames;
        }

        return self::$modulesNames[$slug];
    }
}