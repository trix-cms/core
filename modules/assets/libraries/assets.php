<?php

use HTML\Tag;

class Assets {
    
    static public $img_folder = 'images/';
    static public $css_folder = 'css/';
    static public $js_folder = 'js/';

    public static function css($href)
    {
        $href = URL::site_url('assets/css/'. $href);
        
        return Tag::css($href);
    }

    public static function js($src)
    {
        $src = URL::site_url('assets/js/'. $src);
        
        return Tag::js($src);
    }

    public static function img($src, $attributes = '')
    {
        $src = URL::site_url('assets/img/'. $src);
        
        return Tag::image($src, $attributes);
    }
    
    /**
     * Generate link tag to css file in current theme
     */
    public static function theme_css($href)
    {
        $href = URL::site_url(
            CI::$APP->config->item('theme_location') 
            . CI::$APP->template->theme . '/'
            . self::$css_folder 
            . $href
        );
        
        return Tag::css($href);
    }
    
    /**
     * Generate link tag to js file in current theme
     */
    public static function theme_js($src)
    {
        $src = URL::site_url(
            CI::$APP->config->item('theme_location') 
            . CI::$APP->template->theme . '/'
            . self::$js_folder 
            . $src
        );
        
        return Tag::js($src);
    }

    /**
     * Generate link tag to image file in current theme
     */
    public static function theme_img($src, $attributes = '')
    {
        $src = URL::site_url(
            CI::$APP->config->item('theme_location') 
            . CI::$APP->template->theme . '/' 
            . self::$img_folder 
            . $src
        );
        
        return Tag::image($src, $attributes);
    }
    
    function module_js($src, $module = false)
    {
        $module = $module ? $module : CI::$APP->module;
        
        return Tag::js(URL::site_url('modules/'. $module .'/js/'. $src));
    }
    
    function module_css($href, $module)
    {
        $module = $module ? $module : CI::$APP->module;
        
        return Tag::css(URL::site_url('modules/'. $module .'/css/'. $href));
    }
    
    function module_image($src, $module)
    {
        $module = $module ? $module : CI::$APP->module;
        
        return Tag::image(URL::site_url('modules/'. $module .'/images/'. $src));
    }
}