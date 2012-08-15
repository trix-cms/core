<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Публичный контроллер
 */
class Public_Controller extends MY_Controller {
    
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