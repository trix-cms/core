<?php

namespace Users;

class Config {

    const AVATAR_PATH = 'uploads/users/avatars/';
    const DEFAULT_AVATAR = 'modules/users/images/default-avatar.png';
    
    static public $register_rules = array(
        array(
            'field'=>'login',
            'label'=>'Логин',
            'rules'=>'trim|required|callback_check_login'
        ),
        array(
            'field'=>'email',
            'label'=>'Email',
            'rules'=>'trim|required|valid_email|callback_check_email'
        ),
        array(
            'field'=>'password',
            'label'=>'Пароль',
            'rules'=>'trim|required',
        ),
        array(
            'field'=>'password_retype',
            'label'=>'Повтор пароля',
            'rules'=>'trim|required|matches[password]',
        )
    );
}