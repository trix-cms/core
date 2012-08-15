<?php

class Seo {
    
    private $title = array();
    private $delimiter = ' » ';
    private $add_method;
    
    function __construct($config = array())
    {
        $this->add_method = 'append';
        
        $this->_set_config($config);
    }
    
    private function _set_config($config)
    {
        foreach($config as $key => $value)
        {
            $this->$key = $value;
        }
    }
    
    function set_delimiter($delimiter)
    {
        $this->delimiter = $delimiter;
    }
    
    function set_title($str)
    {
        $this->title = array();
        $this->title[] = $str;
    }
    
    function add_title($str)
    {
        $this->{$this->add_method . '_title'}($str);
    }
    
    function append_title($str)
    {
        array_push($this->title, $str);
    }
    
    function prepend_title($str)
    {
        array_unshift($this->title, $str);
    }
    
    function site_title()
    {
        return implode($this->delimiter, $this->title);
    }
}