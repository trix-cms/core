<?php

use Users\Config;

class Users_Controller extends Users\Controllers\Module {
    
    function __construct()
    {
        parent::__construct();
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
        $this->load->library('Trix\Form_validation');
        
        $this->alert->set(\Trix\Alert::ATTENTION, 'Для восстановления пароля введите свой регистрационный e-mail. На него придет письмо с дальнейшими действиями.');

        // обрабатываем форму
        if($this->input->post('submit'))
        {
            // правила валидации
            $this->form_validation->set_rules('email', 'E-mail', 'trim|required|valid_email|callback_email_exists');

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
                        'users/reset_password/'. $this->auth->data['user_id'] .'/'. $this->auth->data['token']
                    ),
                    'login'=>$this->auth->data['login'],
                    'email'=>$this->auth->data['email']
                ));
                    
                // обновляем страницу
                URL::redirect('users/reset_send');
            }
            else
            {
                $this->alert->set(Trix\Alert::ERROR, validation_errors());
            }
        }
        
        $this->render('reset');
    }
    
    /**
     * Страница, оповещающая, что отправлено письмо для восстановления пароля
     */
    function action_reset_send()
    {
        $this->render('reset_send');
    }
    
    /**
     * Форма смены пароля
     */
    function action_reset_password($user_id = '', $token = '')
    {    
        // если юзер авторизован
        if( $this->user->logged_in )
        {
            show_404();
        }
        
        // если нет пользователя с такой почтой
        if( !$user = $this->users_m->by_id($user_id)->get_one() )
        {
            show_404();
        }
        
        // если не совпадает токен
        if( !$this->auth->check_reset_token($user, $token)  )
        {
            show_404();
        }
        
        $this->alert->set(Trix\Alert::INFO, 'Введите новый пароль');
    
        // обрабатываем форму
        if( $this->input->post('submit') )
        {
            // класс валидации
            $this->load->library('Trix\Form_validation');

            // правила валидации
            $this->form_validation->set_rules(
                'password', 'Пароль', 'trim|required|matches[password_2]'
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
                
                $this->alert->set_flash(Trix\Alert::SUCCESS, 'Пароль успешно изменен');
                
                // редирект
                URL::redirect('users/login');
            }
            else
            {
                $this->alert->set(Trix\Alert::ERROR, validation_errors());
            }
        }
        
        $this->render('reset_password');    
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
        $this->load->library('Trix\Form_validation');

        // обрабатываем форму
        if( $this->input->post('submit') )
        {            
            // правида валидации
            $this->form_validation->set_rules('credentials', 'Почта или логин', 'trim|required');
            $this->form_validation->set_rules('password', 'Пароль', 'trim|required');

            // валидация
            if( $this->form_validation->run() )
            {
                $credentials = $this->input->post('credentials');
                $password = $this->input->post('password');

                if( $this->auth->check_user($credentials, $password) )
                {                    
                    if( $this->auth->user->is_active )
                    {
                        // Авторизуем юзера
                        $this->auth->login();
                        
                        // редиректим обратно на страницу
                        URL::referer();
                    }
                    else
                    {
                        $this->alert->set(Trix\Alert::ATTENTION, 'Вы не подтвердили свой email');
                    }
                }
                else
                {
                    $this->alert->set(Trix\Alert::ERROR, 'Пользователь с указанными данными не найден');
                }
            }
            else
            {
                $this->alert->set(Trix\Alert::ERROR, validation_errors());
            }
        }
        
        $this->render('login');
    }

    /**
     * Регистрация пользователя
     */
    function action_register()
    {
        // если юзер уже авторизован
        if( $this->user->logged_in )
        {
            URL::redirect();
        }
        
        // если отключена регистрация
        if( !$this->settings->users->registration )
        {
            $this->alert->set(Trix\Alert::ATTENTION, 'Регистрация закрыта');
            
            echo Modules::run('trix/error/action_general');
            return;
        }
        
        // загружаем библиотеку валидации формы
        $this->load->library('Trix\Form_validation');
        
        // обрабатываем форму
        if( $this->input->post('submit') )
        {
            // правила валидации
            $this->form_validation->set_rules(Config::$register_rules);
            
            // валидация формы
            if($this->form_validation->run($this))
            {
                // данные
                $data = array(
                    'login'=>$this->input->post('login', TRUE),
                    'email'=>$this->input->post('email'),
                    'password'=>$this->input->post('password'),
                );
                
                // регистрируем юзера
                $this->auth->register($data);
                
                // отправляем уведомление пользователю на почту
                $this->send_registration_email(array(
                    'link'=>URL::site_url('users/activate/'. $this->auth->data['id'] .'/' .$this->auth->data['activation_code']),
                    'email'=>$this->auth->data['email'],
                    'password'=>$this->auth->data['password'],
                    'site_url'=>URL::base_url()
                ));
                
                // редиректим
                URL::redirect('users/register_success');
            }
            else
            {
                $this->alert->set(Trix\Alert::ERROR, validation_errors());
            }
        }

        $this->render('register');
    }
    
    /**
     * Активация аккаунта
     */
    function action_activate($user_id, $code)
    {
        if( !$this->auth->activate($user_id, $code) )
        {
            show_404();
        }

        $this->alert->set_flash(Trix\Alert::SUCCESS, 'Ваш аккаунт успешно активирован. Теперь вы можете войти.');

        $this->seo->add_title('Активация аккаунта');

        URL::redirect('users/login');
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
        $this->load->library('Trix\Email');
        
        // шаблон
        $this->email->template('Спасибо за регистрацию. {link}');
        
        // данные 
        $this->email->data($data);
        
        $this->email->from($this->settings->server_email, $this->settings->site_name);
        $this->email->to($data['email']);
        $this->email->subject('Регистрация на сайте.');
        $this->email->send();
    }
    
    /**
     * Отправка письма для восстановления пароля
     */
    function send_reset_start_email($data)
    {        
        // загружаем класс
        $this->load->library('Trix\Email');
        
        // шаблон
        $this->email->template('Восстановление пароля. {reset_link}');
        
        // данные 
        $this->email->data($data);
        
        $this->email->from($this->settings->server_email, $this->settings->site_name);
        $this->email->to($data['email']);
        $this->email->subject('Сброс пароля');
        $this->email->send();
    }
}