<?php

class Admin_Controller extends Trix\Controllers\Base {

    function __construct()
    {
        parent::__construct();        
    }

    /**
     * Страница авторизации
     */
    function action_index()
    {
        // страница для редиректа при успешной авторизации        
        $redirect_url = 'admin/dashboard';
        
        // устанавливаем тему
        $this->template->set_theme('admin');
        
        // устанавливаем layout
        $this->template->set_layout('layout');
        
        // если уже авторизован
        if( $this->user->backend_access() )
        {
            URL::redirect($redirect_url);
        }

        // обрабатываем форму
        if( $this->input->post('submit') )
        {
            $email = $this->input->post('login');
            $password = $this->input->post('password');

            // авторизация
            if( $this->auth->check_user($email, $password) )
            {              
                // Авторизуем юзера
                $this->auth->login();
                
                URL::refresh();
            }
            else
            {
                $this->set_message(Trix\Alert::ERROR, 'Введены неверные данные');
            }
        }

        $this->render('index');
    }

    /**
     * Разавторизация пользователя
     */
    function action_logout()
    {
        if( $this->user->logged_in )
        {
            $this->auth->logout();
        }

        URL::redirect('');
    }
}