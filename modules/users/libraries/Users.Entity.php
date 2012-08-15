<?php

class Users_Entity extends Entity {
    
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
            $avatar = Users_Config::AVATAR_PATH . $this->avatar;
        }
        // пробуем использовать граватар или изображение по умолчанию
        else
        {
            $avatar = Users_Config::DEFAULT_AVATAR;
        }
        
        return URL::site_url($avatar);
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
    
    /*
    function get_group()
    {
        return $this->group_slug;
    }
        
    function get_is_online()
    {
        return CI::$APP->auth->is_online($this->id);
    }
    
    function get_profile_url()
    {
        return 'users/profile/'. $this->id;
    }
    
    function get_format_gender()
    {
        return $this->gender == 'm' ? 'мужской' : 'женский';
    }
    
    function get_has_name()
    {
        return $this->name != '';
    }
    
    function moderated()
    {
        return $this->is_moderated == 1;
    }
    
    function get_group_label()
    {
        return Users_Groups::label($this->group_slug);
    }
    
    
    
    function get_identifier()
    {
        return $this->name ? $this->name : 'Имя не указано';
    }
    
    function belongs_to_community($community_id)
    {
        $user_communities_ids = CI::$APP->session->userdata('user_communities');

        return is_array($user_communities_ids) ? in_array($community_id, $user_communities_ids) : FALSE;
    }
    
    function get_age()
    {
        if( !$this->birthday OR $this->birthday == '0000-00-00'  )
        {
            return FALSE;
        }
        
        $birthday_timestamp = strtotime($this->birthday);
        list($year, $month, $day) = explode('-', $this->birthday);
        
        $age = date('Y') - date('Y', $birthday_timestamp);
        $age = time() - mktime(0, 0, 0, $month, $day, date('Y')) < 0 ? $age - 1 : $age;
        
        return $age;
    }
    
    function dob($segment = '')
    {
        if( !$this->birthday )
        {
            return FALSE;
        }
        
        $segments = explode('-', $this->birthday);
        
        switch($segment)
        {
            case 'year':
                return $segments[0] != '0000' ? $segments[0] : '';
                break;
                
            case 'month':
                return $segments[1] != '00' ? $segments[1] : '';
                break;
                
            case 'day':
                return $segments[2] != '00' ? $segments[2] : '';
                break;
            
            default:
                return $this->birthday;
        }
    }
    
    function get_is_current()
    {
        return isset(CI::$APP->user->id) AND $this->id == CI::$APP->user->id;
    }
    */
}