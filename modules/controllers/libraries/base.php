<?php

namespace Controllers;

class Base extends \Trix_Controller 
{
    function __construct()
    {
        parent::__construct();
        
        $this->load->database();
        
        // загружаем необходимые библиотеки
        $this->load->library(array(
            'settings/settings',
            'user_agent', 
            'session', 
            'users/auth',
            'template', 
            'permissions/permissions',
            'alert/alert',
            'breadcrumbs/breadcrumbs'
        ));
        
        $this->load->library('seo', array(
            'add_method'=>'prepend'
        ));
        
        // заголовок
        $this->seo->add_title($this->settings->site_name);
    }
}