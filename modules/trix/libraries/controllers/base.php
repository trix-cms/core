<?php

namespace Trix\Controllers;

class Base extends \Trix_Controller 
{
    function __construct()
    {
        parent::__construct();
        
        $this->load->database();
        
        // загружаем необходимые библиотеки
        $this->load->library(array(
            'Settings\Settings',
            'user_agent', 
            'Trix/Session', 
            'Users/Auth',
            'Permissions/Permissions',
            'Trix/Template',
            'Trix/Alert',
            'Trix/Breadcrumbs'
        ));
        
        $this->load->library('trix/seo', array(
            'add_method'=>'prepend'
        ));
        
        // заголовок
        $this->seo->add_title($this->settings->site_name);
    }
}