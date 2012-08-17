<?php

class Users_Controller extends Users\Controllers\Module {
    
    function __construct()
    {
        parent::__construct();
        
        // вложенный шаблон
        $this->template->set_layout('layouts/auth');
    }
    
    /**
     * Страница ввода почты для восстановления пароля
     */
    function action_reset()
    {
        if( $this->user->logged_in )
        {
            URL::redirect();
        }
        
        // класс валидации форм
        $this->load->library('form_validation');

        // обрабатываем форму
        if($this->input->post('submit'))
        {
            // правила валидации
            $this->form_validation->set_rules('email', 'E-mail', 'trim|valid_email|callback_email_exists');

            // валидация формы
            if( $this->form_validation->run() )
            {
                // данные
                $email = $this->input->post('email');

                // начинаем процесс смены пароля
                $code = $this->auth->start_reset($email);
                
                // отправляем письмо
                $this->send_reset_start_email(array(
                    'reset_link'=>URL::site_url(
                        'users/reset_password/'. urlencode($email) .'/'. $this->auth->data['token']
                    ),
                    'login'=>$this->auth->data['login'],
                    'email'=>$this->auth->data['email']
                ));

                // флаг, что письмо отправлено
                $this->session->set_userdata('reset_start', TRUE);
                    
                // обновляем страницу
                URL::refresh();
            }
            else
            {
                $this->notification->set(Notification::ERROR, validation_errors());
            }
        }

        if( $this->session->userdata('reset_start') )
        {
            $this->render('reset_start');
            $this->session->unset_userdata('reset_start');
        }
        else
        {
            $this->render('reset');
        }
    }
    
    /**
     * Форма смены пароля
     */
    function action_reset_password($email = '', $token = '')
    {    
        // если юзер авторизован
        if( $this->user->logged_in )
        {
            show_404();
        }
        
        $email = urldecode($email);
        
        // если нет пользователя с такой почтой
        if( !$user = $this->users_m->by_email($email)->get_one() )
        {
            show_404();
        }
        
        // если не совпадает токен
        if( !$this->auth->check_reset_token($email, $token)  )
        {
            show_404();
        }
    
        // обрабатываем форму
        if( $this->input->post('submit') )
        {
            // класс валидации
            $this->load->library('form_validation');

            // правила валидации
            $this->form_validation->set_rules(
                'password', 'Пароль', 'trim|required|min_length[6]|max_length[20]|matches[password_2]'
            );
            $this->form_validation->set_rules('password_2', 'Пароль(повтор)', 'trim|required');

            // валидация формы
            if( $this->form_validation->run() )
            {
                // новый пароль
                $password = $this->input->post('password');

                // обновляем данные юзера
                $this->users_m->by_id($user->id)->update(array(
                    'password'=>$this->auth->dohash($password),
                    'reset_token'=>''
                ));
                
                // редирект
                URL::redirect('users/reset_password_success');
            }
            else
            {
                $this->notification->set(Notification::ERROR, validation_errors());
            }
        }
        
        $this->render('reset_password');    
    }
    
    /**
     * Установка имени пользователя
     */
    function action_set_name()
    {
        // если гость
        if( $this->user->is_guest )
        {
            show_404();
        }
        
        // если уже указаны необходимые данные
        if( $this->user->login )
        {
            show_404();
        }
        
        // класс валидации
        $this->load->library('form_validation');
        
        // обработка формы
        if( $this->input->post('submit') )
        {
            // правила валидации
            $this->form_validation->set_rules('login', 'Имя', 'trim|required|callback_check_login');
            
            // валидация формы
            if( $this->form_validation->run($this) )
            {
                // обновляем данные
                $this->users_m->where('id', $this->user->id)->update(array(
                    'login'=>$this->input->post('login', TRUE)
                ));
                
                // очищаем сессию
                $this->session->unset_userdata('user');
                
                // уведомительное сообщение
                $this->notification->set(Notification::SUCCESS, 'Спасибо за регистрацию на нашем сайте.');
                
                // редиректим на главную
                URL::redirect();
            }
            else
            {
                $this->notification->set(Notification::ERROR, validation_errors());
            }
        }
        
        $this->render('set_name');
    }
    
    /**
     * Успешная смена пароля
     */
    function action_reset_password_success()
    {
        $this->render('reset_password_success');
    }

    /**
     * Разгогинивание юзера
     */
    function action_logout()
    {
        if( $this->user->logged_in )
        {
            $this->auth->logout();
        }

        URL::redirect();
    }

    /**
     * Страница авторизации пользователя
     */
    function action_login()
    {
        if( $this->user->logged_in )
        {
            URL::redirect();
        }

        // загружаем класс валидации
        $this->load->library('form_validation');

        // обрабатываем форму
        if( $this->input->post('submit') )
        {            
            // правида валидации
            $this->form_validation->set_rules('email', 'E-mail', 'trim|required|valid_email');
            $this->form_validation->set_rules('password', 'Пароль', 'trim|required');

            // валидация
            if( $this->form_validation->run() )
            {
                $email = $this->input->post('email');
                $password = $this->input->post('password');

                if( $this->auth->check_user($email, $password) )
                {                    
                    // Авторизуем юзера
                    $this->auth->login();
                    
                    // редиректим обратно на страницу
                    URL::referer();
                }
                else
                {
                    $this->notification->set(Notification::ERROR, 'Пользователь с указанными данными не найден');
                }
            }
            else
            {
                $this->notification->set(Notification::ERROR, validation_errors());
            }
        }
        
        $this->render('login');
    }

    /**
     * Регистрация пользователя
     */
    function action_register($referer = false)
    {
        // если юзер уже авторизован
        if( $this->user->logged_in )
        {
            URL::redirect();
        }
        
        // если отключена регистрация
        if( !$this->settings->users->registration )
        {
            $this->set_message(Notification::ATTENTION, 'Регистрация закрыта');
            
            URL::redirect();
        }
        
        // ID реферера
        if( $this->input->post('referer') )
        {
            $referer = (int)$this->input->post('referer');
        }
        else
        {
            $referer = $this->session->userdata('referer') 
                ? (int)$this->session->userdata('referer') 
                : (int)$referer;
        }
        
        $this->session->set_userdata('referer', $referer);
        
        // загружаем библиотеку валидации формы
        $this->load->library('form_validation');
        
        // обрабатываем форму
        if( $this->input->post('submit') )
        {
            // правила валидации
            $this->form_validation->set_rules(
                'email',
                'Email',
                'trim|required|valid_email|callback_check_email'
            );
            
            // валидация формы
            if($this->form_validation->run($this))
            {
                // данные
                $data = array(
                    'email'=>$this->input->post('email')
                );
                
                // регистрируем юзера
                $this->auth->register($data);
                
                // данные букса по юзеру
                $this->load->model('bux/users_data_m');
                $this->users_data_m->insert(array(
                    'user_id'=>$this->auth->data['id']
                ));
                
                // добавляем реферала если есть
                if( $referer )
                {
                    $this->load->model('bux/referals_m');
                    
                    // добавляем запись
                    $this->referals_m->insert($referer, $this->auth->data['id']);
                    
                    // увеличиваем отметку о количестве рефералов
                    $this->users_data_m
                                    ->by_user_id($referer)
                                    ->set('referals_count', 'referals_count + 1', FALSE)
                                    ->update();
                }
                
                // отправляем уведомление пользователю на почту
                $this->send_registration_email(array(
                    'email'=>$this->auth->data['email'],
                    'password'=>$this->auth->data['password'],
                    'site_url'=>URL::base_url()
                ));
                
                // редиректим
                URL::redirect('users/register_success');
            }
            else
            {
                $this->notification->set(Notification::ERROR, validation_errors());
            }
        }

        $this->render('register', array(
            'referer'=>$referer
        ));
    }
    
    /**
     * Страница об успешной регистрации
     */
    function action_register_success()
    {
        $this->render('register_success');
    }
    
    /**
     * Отправка письма после регистрации
     *
     */
    function send_registration_email($data)
    {
        // загружаем класс
        $this->load->library('email');
        
        // шаблон
        $this->email->template('registration_successful');
        
        // данные 
        $this->email->data($data);
        
        $this->email->from($this->settings->server_email, $this->settings->site_name);
        $this->email->to($data['email']);
        $this->email->subject('Регистрация на сайте');
        $this->email->send();
    }
    
    /**
     * Отправка письма для восстановления пароля
     */
    function send_reset_start_email($data)
    {        
        // загружаем класс
        $this->load->library('email');
        
        // шаблон
        $this->email->template('reset_start');
        
        // данные 
        $this->email->data($data);
        
        $this->email->from($this->settings->server_email, $this->settings->site_name);
        $this->email->to($data['email']);
        $this->email->subject('Сброс пароля');
        $this->email->send();
    }
}