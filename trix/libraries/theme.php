<?php

class Theme {
    
    static public $images_folder = 'images/';
    static public $css_folder = 'css/';
    static public $js_folder = 'js/';
    
    /**
     * Generate link tag to css file in current theme
     */
    public static function css($href)
    {
        $href = URL::site_url(
            CI::$APP->config->item('theme_location') 
            . CI::$APP->template->theme . '/'
            . self::$css_folder 
            . $href
        );
        
        return HTML::css($href);
    }
    
    /**
     * Generate link tag to js file in current theme
     */
    public static function js($src)
    {
        $src = URL::site_url(
            CI::$APP->config->item('theme_location') 
            . CI::$APP->template->theme . '/'
            . self::$js_folder 
            . $src
        );
        
        return HTML::js($src);
    }

    /**
     * Generate link tag to image file in current theme
     */
    public static function image($src, $attributes = '')
    {
        $src = URL::site_url(
            CI::$APP->config->item('theme_location') 
            . CI::$APP->template->theme . '/' 
            . self::$images_folder 
            . $src
        );
        
        return HTML::image($src, $attributes);
    }
}