<?php

class Module {
    
    function js($src, $module)
    {
        return HTML::js(URL::site_url('modules/'. $module .'/js/'. $src));
    }
    
    function css($href, $module)
    {
        return HTML::css(URL::site_url('modules/'. $module .'/css/'. $href));
    }
    
    function image($src, $module)
    {
        return HTML::image(URL::site_url('modules/'. $module .'/images/'. $src));
    }
}