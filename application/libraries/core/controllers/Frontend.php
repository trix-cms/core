<?php

namespace Core\Controllers;

/**
 * Публичный контроллер
 */
class Frontend extends Base {
    
    function __construct()
    {
        parent::__construct();
        
        // включен ли сайт для пользователей
        if( $this->settings->frontend_enabled != 1 )
        {
            show_error($this->settings->unavailable_message);
        }
    }
}