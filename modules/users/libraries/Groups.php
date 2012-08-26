<?php

namespace Users;

use CI;

class Groups {
    
    static function label($group)
    {
        CI::$APP->load->model('users/groups_m');
        
        $groups = CI::$APP->groups_m->get_all();
        
        $groups = \Trix\CArray::map($groups, 'slug', 'name');
        
        return $groups[$group];
    }
}