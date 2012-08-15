<?php

class News_Entity extends Entity {
    
    function url($title, $attrs = array())
    {
        return URL::anchor('news/view/'. $this->url, $title, $attrs);
    }
    
    function get_image()
    {
        $local_image = HTML::image(URL::site_url(News_Config::$upload_folder. $this->picture), array('width'=>125));
        $dummy_image = HTML::image('http://lorempixel.com/120/100');
        
        return $this->picture ? $local_image : $dummy_image;
    }
    
    function get_image_url()
    {
        $local_image_url = URL::site_url(News_Config::$upload_folder. $this->picture);
        $dummy_image_url = 'http://lorempixel.com/120/100';
        
        return $this->picture ? $local_image_url : $dummy_image_url;
    }
    
    function get_short_intro()
    {
        return Text::word_limiter(strip_tags($this->intro), 20, '...');
    }
    
    function get_date()
    {
        return Date::nice($this->created_on);
    }
    
    function get_update_date()
    {
        return $this->created_on != $this->updated_on ? Date::format($this->updated_on) : FALSE;
    }
    
    function get_author()
    {
        return $this->login;
    }
}