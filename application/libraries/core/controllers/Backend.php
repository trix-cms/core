<?php

namespace Core\Controllers;

use CI;

class Backend extends Base {

    function __construct()
    {
        parent::__construct();
        
        $this->is_backend = CI::$APP->is_backend = TRUE;

        // есть ли доступ у юзера в админку
        if( !$this->user->backend_access()  )
        {
            URL::redirect('admin/login?url='. $this->uri->uri_string());
        }
        
        // есть ли доступ к модулю
        if( !$this->user->module_access() )
        {
            show_error('У вас нет доступа к этому модулю', 500);
        }
        
        // устанавливаем тему
        $this->template->set_theme('admin');
    }
    
    /**
     * Сокращение для Template::render()
     */
    function render($view, $data = array())
    {
        if( strstr($view, '::') === FALSE )
        {
            $view = 'admin/'. $view;
        }
        
        parent::render($view, $data);
    }
    
    function action_settings()
    {
        $this->settings->display();
    }
}