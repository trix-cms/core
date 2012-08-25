<?php

class Users_Controller extends Controllers\Backend {

    function __construct()
    {
        parent::__construct();

        // модели
        $this->load->model(array(
            'users/users_m', 
            'users/groups_m'
        ));
        
        // хлебные крошки
        $this->breadcrumbs->add_item('Пользователи', 'admin/users');
        
        // вложенный шаблон
        $this->template->set_layout('layout');
    }

    /**
     * Список пользователей
     */
    function action_index($type = 'all', $page = 1)
    {        
        $limit = 10;
        $offset = ($page - 1)*$limit;
        
        $total = $this->users_m->$type()->count();
        $users = $this->users_m->$type()
                                ->limit($limit)
                                ->offset($offset)
                                ->order_by('register_date', 'DESC')
                                ->get_all();

        // пагинация
        $pagination = new Pagination;
        $pagination->set_page($page);
        $pagination->set_total($total);
        $pagination->set_url('admin/users/index/'. $type);
        $pagination->set_per_page($limit);

        $this->render('index', array(
            'pagination'=>$pagination,
            'users'=>$users,
            'type'=>$type
        ));
    }
    
    /**
     * Отмечаем что пользователь проверен
     */
    function action_moderated($user_id)
    {
       $this->users_m->where('id', $user_id)->set('is_moderated', 1)->update();
       
       $this->session->set_flashdata('success', 'Пользователь отмечен проверянным');
       
       URL::referer(); 
    }

    /**
     * Редактирование
     */
    function action_edit($id)
    {
        $item = $this->users_m->get_by_id($id);
        
        if( $item->id == 0 )
        {
            show_error('Гостевую запись нельзя редактировать');
        }
        
        if( $this->input->post('submit') OR $this->input->post('apply') )
        {
            $data = array(
                'login'=>$this->input->post('login'),
                'email'=>$this->input->post('email')
            );
            
            // пользователь не может изменить свою группу
            if( $item->id != $this->user->id )
            {
                $data['group_slug'] = $this->input->post('group_slug');
            }
            
            $this->users_m->by_id($id)->update($data);

            $this->session->set_flashdata('success', 'Изменения сохранены');

            $this->input->post('apply') ? URL::refresh() : URL::redirect('admin/users');         
        }
        
        // group options
        $groups = $this->groups_m->get_all();
        foreach($groups as $group)
        {
            $groups_options[$group->slug] = $group->name;
        }
        
        $this->breadcrumbs->add_item('Редактирование', 'admin/users/edit/'. $item->id);

        $this->render('edit', array(
            'item'=>$item,
            'groups_options'=>$groups_options
        ));
    }

    function action_actions()
    {
        $action = $this->input->post('actions') ? $this->input->post('actions') : $this->input->post('actions2');

        if( count($this->input->post('users')) > 0 )
        {
            switch( $action )
            {
                case 'delete':
                    $this->db->where_in('id', $this->input->post('users'))
                             ->delete('account_users');
                    $this->session->set_flashdata('success', 'Аккаунты удалены');
                    break;

                case 'approve':
                    $this->db->where_in('id', $this->input->post('users'))
                             ->set('is_active', 1)
                             ->set('activation_code', '')
                             ->update('account_users');
                    $this->session->set_flashdata('success', 'Аккаунты активированы');
                    break;

                default:
                    echo 'default';
            }
        }

        URL::referer();
    }
}