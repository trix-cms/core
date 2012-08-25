<?php

class Assets {

    public static function css($href)
    {
        $href = URL::site_url('assets/css/'. $href);
        
        return HTML::css($href);
    }

    public static function js($src)
    {
        $src = URL::site_url('assets/js/'. $src);
        
        return HTML::js($src);
    }

    public static function image($src, $attributes = '')
    {
        $src = URL::site_url('assets/images/'. $src);
        
        return HTML::image($src, $attributes);
    }
}