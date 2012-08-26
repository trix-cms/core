<?php

class Permissions_Controller extends Trix\Controllers\Backend {
    
    function __construct()
    {
        parent::__construct();
        
        // класс
        $this->load->library('permissions/permissions');
        
        // модели
        $this->load->model('users/groups_m');
        
        // хлебные крошки
        $this->breadcrumbs->add_item('Права доступа', 'admin/permissions');
        
        // вложенный шаблон
        $this->template->set_layout('layout');
    }
    
    function action_index()
    {
        // группы
        $groups = $this->groups_m->get_all();
        
        $this->render('index', array(
            'groups'=>$groups
        ));    
    }
    
    /**
     * Установка прав
     */
    function action_set($group)
    {
        $modules = $this->db->get('modules');
        
        if( $this->input->post('submit') )
        {
            $permissions = $this->input->post('permissions');
            
            $temp = array();
            
            foreach( $modules->result() as $module )
            {
                $temp[$module->url] = isset( $permissions[$module->url] ) ? 1 : 0;
            }
            
            $this->permissions_m
                            ->by_group_slug($group)
                            ->update(array(
                                'permissions'=>serialize($temp),
                                'has_backend_access'=>$this->input->post('has_backend_access') ? 1 : 0
                            ));
            
            $this->set_message(Trix\Alert::SUCCESS, 'Изменения сохранены');
            
            URL::referer();
        }
        
        $group_permissions = $this->permissions_m->where('group_slug', $group)->get_one();
        
        if( $group_permissions )
        {
            $permissions = unserialize($group_permissions->permissions);
            $has_backend_access = $group_permissions->has_backend_access;
        }
        else
        {
            $permissions = array();
            $has_backend_access = 0;
        }
        
        // хлебные крошки
        $this->breadcrumbs->add_item('Установка', 'admin/permissions/set/'. $group);
        
        $this->render('set', array(
            'permissions'=>$permissions,
            'has_backend_access'=>$has_backend_access,
            'modules'=>$modules
        ));                
    }
}