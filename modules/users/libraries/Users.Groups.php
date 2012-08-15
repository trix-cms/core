<?php

class Users_Groups {
    
    static function label($group)
    {
        CI::$APP->load->model('users/groups_m');
        
        $groups = CI::$APP->groups_m->get_all();
        
        $groups = CArray::map($groups, 'slug', 'name');
        
        return $groups[$group];
    }
}