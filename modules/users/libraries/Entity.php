<?php

namespace Users;

use CI;

class Entity extends \Entity {
    
    static $guest_name = 'Гость';
    
    /**
     * Авторизован ли юзер
     */
    function get_logged_in()
    {
        return $this->id > 0;
    }
    
    /**
     * Гость ли юзер
     */
    function get_is_guest()
    {
        return $this->id == 0;
    }
    
    /**
     * Проверяет есть ли доступ к модулю
     */
    function module_access($module = false)
    {
        return CI::$APP->permissions->has_module_access($module);
    }
    
    /**
     * Проверяет есть ли доступ к админке
     */
    function backend_access()
    {
        return CI::$APP->permissions->has_backend_access();
    }
    
    function get_avatar_url()
    {
        // если загружен аватар
        if( $this->avatar )
        {
            $avatar = Config::AVATAR_PATH . $this->avatar;
        }
        // пробуем использовать граватар или изображение по умолчанию
        else
        {
            $avatar = Config::DEFAULT_AVATAR;
        }
        
        return \URL::site_url($avatar);
    }
    
    function get_profile_url()
    {
        return 'users/profile/'. $this->id;
    }
    
    function get_is_current()
    {
        return $this->id == CI::$APP->user->id;
    }
    
    function get_group_label()
    {
        return Users_Groups::label($this->group_slug);
    }
    
    function is_in_group($groups)
    {
        if( is_array($groups) )
        {
            return in_array($this->group_slug, $groups);
        }
        else
        {
            return $this->group_slug == $groups;
        }
    }
}