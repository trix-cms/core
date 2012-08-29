<?php

namespace News;

class Entity extends \Trix\Model\Entity {
    
    function url($title, $attrs = array())
    {
        return \URL::anchor('news/view/'. $this->url, $title, $attrs);
    }
    
    function get_image()
    {
        $local_image = HTML\Tag::image(URL::site_url(Config::$upload_folder. $this->picture), array('width'=>125));
        $dummy_image = HTML\Tag::image('http://lorempixel.com/120/100');
        
        return $this->picture ? $local_image : $dummy_image;
    }
    
    function get_image_url()
    {
        $local_image_url = URL::site_url(Config::$upload_folder. $this->picture);
        $dummy_image_url = 'http://lorempixel.com/120/100';
        
        return $this->picture ? $local_image_url : $dummy_image_url;
    }
    
    function get_short_intro()
    {
        return \Utility\Text::word_limiter(strip_tags($this->intro), 20, '...');
    }
    
    function get_date()
    {
        return \Trix\Date::nice($this->created_on);
    }
    
    function get_update_date()
    {
        return $this->created_on != $this->updated_on ? \Date::format($this->updated_on) : FALSE;
    }
    
    function get_author()
    {
        return $this->login;
    }
}