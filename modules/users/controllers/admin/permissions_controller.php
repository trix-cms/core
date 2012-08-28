<?php

class Permissions_Controller extends Users\Controllers\Admin\Base {
    
    function __construct()
    {
        parent::__construct();
        
        // класс
        $this->load->library('permissions/permissions');
        
        // модели
        $this->load->model('users/groups_m');
        $this->load->model('modules/modules_m');
        
        // хлебные крошки
        $this->breadcrumbs->add_item('Права доступа', 'admin/permissions');
    }
    
    function action_index()
    {
        if( $this->input->post('submit') )
        {
            $this->save();
        }
        
        // группы
        $groups = $this->groups_m->order_by('default')->get_all();
        $headings = $this->get_table_headings($groups);
        array_unshift($headings, '');
        
        $permissions = $this->permissions_m->get_all();
        $permissions = $this->get_permissions_by_group($permissions);
        
        $modules = $this->modules_m->by_is_backend(1)->get_all();
        array_unshift($modules, '');        
        
        $this->render('permissions/index', array(
            'groups'=>$groups,
            'headings'=>$headings,
            'permissions'=>$permissions,
            'modules'=>$modules
        ));    
    }
    
    /**
     * Сохранение прав
     */
    private function save()
    {
        $permissions = $this->input->post('groups');
        
        $groups = $this->groups_m->by_default(0)->get_all();
        
        foreach($groups as $group)
        {
            $temp = array();
            if( isset($permissions[$group->slug]['modules']) )
            foreach($permissions[$group->slug]['modules'] as $key=>$value)
            {
                $temp[$key] = 1;
            }
            $permissions[$group->slug]['modules'] = $temp;
            
            $this->permissions_m
                            ->by_group_slug($group->slug)
                            ->set('has_backend_access', isset($permissions[$group->slug]['has_backend_access']))
                            ->set('permissions', isset($permissions[$group->slug]['modules']) 
                                                        ? serialize($permissions[$group->slug]['modules']) 
                                                        : ''
                            )
                            ->update();
            
        }
        
        $this->alert->set_flash(Trix\Alert::SUCCESS, 'Изменения сохранены');
        
        URL::refresh();
    }
    
    private function get_permissions_by_group($permissions)
    {
        $result = array();
        if( $permissions )
        {
            foreach($permissions as $item)
            {
                $item->permissions = unserialize($item->permissions);
                $item->permissions['has_backend_access'] = (int)$item->has_backend_access;
                $result[$item->group_slug] = $item;
            }
        }
        
        return $result;
    }
    
    function get_table_headings($groups)
    {
        return Utility\CArray::map($groups, 'slug', 'name');
    }
}