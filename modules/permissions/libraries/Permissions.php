<?php

namespace Permissions;

use CI;

class Permissions {

    private $CI;
    private $permissions = array();
    private $has_backend_access;
    private $group_slug;

    function __construct()
    {
        $this->CI =& get_instance();
        
        $this->CI->load->model('permissions/permissions_m');
        
        if( $this->CI->user->logged_in )
        {
            $row = $this->CI->permissions_m->where('group_slug', CI::$APP->user->group_slug)->get_one('permissions');

            $this->permissions = isset($row->permissions) ? unserialize($row->permissions) : array();
            $this->has_backend_access = (isset($row->permissions) AND $row->has_backend_access == 1) ? TRUE : FALSE;
        }
        else
        {
            $this->has_backend_access = FALSE;
        }
    }

    /**
     * Проверяет права на доступ к модулю для административных нужд
     * 
     */
    function has_module_access( $module = false )
    {
        // если админ, то можно все
        if( CI::$APP->user->group_slug == 'admins' )
        {
            return TRUE;
        }
        
        // если не указан модуль, то проверяем текущий
        if( !$module )
        {
            $module = $this->CI->module;
        }

        // проверяем доступ в админку
        if( !$this->has_backend_access )
        {
            return FALSE;
        }

        // проверяем доступ к модулю
        if( isset($this->permissions[$module]) AND $this->permissions[$module] != 1 )
        {
            return FALSE;
        }

        return TRUE;
    }

    /**
     * Проверяет права на доступ в админку
     * 
     */
    function has_backend_access()
    {
        return $this->has_backend_access;
    }
}