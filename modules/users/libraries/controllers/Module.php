<?php

namespace Users\Controllers;

class Module extends \Trix\Controllers\Frontend {
    
    /**
     * Существует ли почта
     */
    function email_exists($str)
    {
        if( $this->auth->check_email($str) )
		{
			return TRUE;
		}
		else
		{
            $this->form_validation->set_message('email_exists', 'Такой адрес почты не найден');
			return FALSE;
		}
    }
    
    /**
     * Проверка логина
     */
    function check_login($str)
    {
        if( !$this->auth->check_login($str) )
		{
			return TRUE;
		}
		else
		{
            $this->form_validation->set_message('check_login', 'Такой логин уже используется');
			return FALSE;
		}
    }

    /**
     * Проверка почты
     */
    function check_email($str)
    {        
        if( !$this->auth->check_email($str) )
		{
			return TRUE;
		}
		else
		{
            $this->form_validation->set_message('check_email', 'Такой адрес почты уже используется');
			return FALSE;
		}
    }
}