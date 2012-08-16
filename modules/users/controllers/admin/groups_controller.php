<?php

class Groups_Controller extends Admin_Controller {
    
    function __construct()
    {
        parent::__construct();
        
        // модель
        $this->load->model('groups_m');
        
        // вложенный шаблон
        $this->template->set_layout('admin/groups/layout');
        
        // хлебные крошки
        $this->breadcrumbs->add_item('Группы', 'users/admin/groups');
    }
    
    /**
     * Список групп
     */
    function action_index()
    {
        // группы
        $groups = $this->groups_m->get_all();
        
        $this->render('groups/index', array(
            'groups'=>$groups
        ));
    }
    
    /**
     * Удаление группы
     */
    function action_delete($slug)
    {
        $group = $this->groups_m->by_slug($slug)->get_one();
        
        // удаляем если не дефолтная
        if( $group->default == 0 )
        {
            $this->groups_m->by_slug($slug)->delete();
            
            // удаляем запись прав
            $this->permissions_m->by_group_slug($slug)->delete();
        }
        
        
        
        if( $this->is_ajax() )
        {
            echo 'ok';   
        }
        else
        {
            // уведомление
            $this->set_message(Notification::SUCCESS, 'Группа удалена');
            
            // редирект
            URL::redirect('users/admin/groups');
        }
    }
    
    /**
     * Редактирование группы
     */
    function action_edit($slug)
    {
        $this->action_add($slug);
    }
    
    /**
     * Добавление и редактирование группы
     */
    function action_add($slug = false)
    {
        // класс валидации
        $this->load->library('form_validation');
        
        // группа
        $group = $this->groups_m->by_slug($slug)->get_one();
        
        // дефолтную нельзя редактировать
        if( $group AND $group->default == 1 )
        {
            URL::redirect('admin/groups');
        }
        
        // обрабатываем форму
        if( $this->input->post('submit') )
        {
            // правила валидации
            $this->form_validation->set_rules('name', 'Название', 'trim|required');
            $this->form_validation->set_rules('slug', 'Slug', 'trim|required|callback_check_slug');
            
            // валидация
            if( $this->form_validation->run($this) )
            {
                if( $group )
                {
                    // добавляем запись
                    $this->groups_m
                                ->by_slug($group->slug)
                                ->update(array(
                        'name'=>$this->input->post('name'),
                        'slug'=>$this->input->post('slug')
                    ));
                    
                    // уведомление
                    $this->set_message(Notification::SUCCESS, 'Изменения сохранены');
                }
                else
                {
                    // добавляем запись
                    $this->groups_m->insert(array(
                        'name'=>$this->input->post('name'),
                        'slug'=>$this->input->post('slug'),
                        'default'=>0
                    ));
                    
                    // добавляем запись прав
                    $this->permissions_m->insert(array(
                        'group_slug'=>$this->input->post('slug')
                    ));
                    
                    // уведомление
                    $this->set_message(Notification::SUCCESS, 'Группа добавлена');
                }
                
                // редирект
                URL::redirect('users/admin/groups');
            }
            else
            {
                $this->set_message(Notification::ERROR, validation_errors());
            }
        }
        
        $this->render('groups/add', array(
            'group'=>$group
        ));
    }
    
    function check_slug($string)
    {
        if( $this->groups_m->by_slug($string)->get_one() === FALSE )
        {
            return TRUE;
        }
        else
        {
            $this->form_validation->set_message('check_slug', 'Такой slug уже используется');
            return FALSE;
        }
    }
}