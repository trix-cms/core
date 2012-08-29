<?php

namespace Users;

use CI;

class Auth
{
    function __construct()
    {        
        $this->load->model('users/users_m');
        
        CI::$APP->user = $this->users_m->get_by_id($this->session->userdata('user_id'));

        // отмечаем последний визит пользователя
        if( $this->user->logged_in )
        {
            $this->users_m->last_visit_time_update();
        }
    }
        
    /**
     * Разавторизация
     */
    function logout()
    {
        $this->session->sess_destroy();
    }
    
    /**
     * Проверяет существует ли юзер
     */
    function check_user($credentials, $password)
    {
        // берем из базы юзера
        $user = $this->users_m->by_email($credentials)->or_where('login', $credentials)->get_one();

        // проверяем есть ли юзер и совпадает ли пароль
        if( !$user OR $user->password != $this->dohash($password) )
        {
            return FALSE;
        }
        
        $this->user = $user;

        return TRUE;
    }
    
    /**
     * Авторизация
     */
    function login()
    {
        // обновляем данные
        $this->users_m->by_id($this->user->id)->update(array(
            'last_ip'=>$this->session->userdata('ip_address'),
            'user_agent'=>$this->session->userdata('user_agent')
        ));
        
        $this->session->set_userdata('user_id', $this->user->id);
    }
    
    /**
     * Регистрация пользователя
     */
    function register($data = array())
    {        
        $this->data = array_merge(
            $data, 
            array(
                'activation_code'=>\Utility\String::random('unique'),
                'email'=>$data['email'],
                'avatar'=>'',
                'password'=>$this->dohash($data['password']),
                'user_agent'=>$this->session->userdata('user_agent'),
                'group_slug'=>'users',
                'register_date'=>time()
            )
        );
        
        // создаем пользователя
        $user_id = $this->users_m->insert($this->data);
        
        $this->data['id'] = $user_id;
    }
    
    /**
     * Активация аккаунта юзера
     */
    function activate($user_id, $code)
    {
        if( $this->users_m->by_id($user_id)->by_activation_code($code)->count() == 1 )
        {
            $this->users_m
                        ->by_id($user_id)
                        ->set('activation_code', '')
                        ->set('is_active', 1)
                        ->update();
            
            return TRUE;    
        }
        
        return FALSE;
    }
    
    /**
     * Начало процесса сброса пароля
     */
    function start_reset($email)
    {
        // юзер
        $user = $this->users_m->by_email($email)->get_one();
        
        // генерируем токен
        $token = $this->_generate_token();
        
        // обновляем данные пользователя
        $this->users_m
                    ->by_id($user->id)
                    ->set('reset_token', $token)
                    ->update();
        
        // данные
        $this->data = array(
            'token'=>$token,
            'email'=>$email,
            'login'=>$user->login,
            'user_id'=>$user->id
        );  
    }
    
    /**
     * Генерирует рендомный токен для смены пароля
     */
    private function _generate_token()
    {
        return sha1(\Utility\String::random('unique'));
    }
    
    /**
     * Шифрование пароля
     */
    function dohash($string)
    {
        return sha1(($string));
    }
    
    /**
     * Проверяем, что почта существует
     */
    function check_email($email)
    {
        return $this->users_m->by_email($email)->count() > 0;
    }
    
    /**
     * Проверяем, что логин существует
     */
    function check_login($login)
    {
        return $this->users_m->by_login($login)->count() > 0;
    }
    
    /**
     * Проверяет, что пользователь может изменить свой пароль
     */
    function check_reset_token($user, $token)
    {
        return $this->users_m->by_id($user->id)->where('reset_token', $token)->count() == 1;
    }
    
    function __get($key)
    {
        return CI::$APP->$key;
    }
}