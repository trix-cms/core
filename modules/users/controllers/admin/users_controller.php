<?php

class Users_Controller extends Core\Controllers\Backend {

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
        $this->template->set_layout('admin/layout');
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
    
    function action_settings()
    {
        $this->settings->display();
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

    function action_edit($id)
    {
        $item  = $this->users_m->get_by_id($id);
        
        if( $this->input->post('submit') OR $this->input->post('apply') )
        {
            $data = array(
                'group_slug'=>$this->input->post('group_slug'),
                'login'=>$this->input->post('login'),
                'email'=>$this->input->post('email')
            );
            
            if( $this->auth->can_edit($item, $data) )
            {
                if( Uploadify::file() )
                {
                    $data['avatar'] = Uploadify::file();
                    Uploadify::move(Users_Config::AVATAR_PATH);
                    Uploadify::clear();
                }
                
                $this->users_m->update_by_id($id, $data);
    
                $this->session->set_flashdata('success', 'Изменения сохранены');
    
                $this->input->post('apply') ? URL::refresh() : URL::redirect('admin/users');
            }
            else
            {
                $this->template->set_message('error', $this->auth->get_errors());
            }            
        }
        
        // group options
        $groups = $this->groups_m->get_all();
        foreach($groups as $group)
        {
            $groups_options[] = array(
                'value'=>$group->slug,
                'label'=>$group->name,
                'selected'=>$item->group_slug == $group->slug
            );
        }
        
        $this->breadcrumbs->add_item('Редактирование', 'admin/users/edit/'. $item->id);

        $this->template->render('edit', array(
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

    function search()
    {
        $this->template->add_js('jquery.paginate.js');
        $this->template->add_js('dynamic_list.js');
        $this->template->add_css('paginate.style.css');
        $this->template->build('account/search');
    }

    function group_delete()
    {
        $slug = $this->uri->segment(4);

        $this->db->where('slug', $slug);
        $this->db->delete('account_groups');

        $this->db->where('group_slug', $slug);
        $this->db->delete('permissions');

        $this->session->set_flashdata('success', 'Группа удалена');

        URL::redirect('admin/account/groups');
    }

    function action_activate_user($user_id, $activation_code)
    {
        $this->auth->activation($user_id, $activation_code);

        $user = $this->users_m->get(array('id' => $user_id))->row();

        $this->_activation_email($user);

        $this->template->set_message('success', 'Пользователь активирован');

        URL::referer();
    }

    function _activation_email($user)
    {
        $this->load->library('email');

        $message = "Ваш аккунт успешно активирован.";

        $this->email->from('noreply@kavicom.ru', '');
        $this->email->to($user->email);
        $this->email->subject('Ваш аккаунт успешно активирован');
        $this->email->message($message);
        $this->email->send();
    }
}