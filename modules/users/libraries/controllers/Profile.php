<?php

namespace Users\Controllers;

class Profile extends Module {
    
    protected $profile;
    
    function __construct()
    {
        parent::__construct();
        
        // устанавливаем вложенный layout
        //$this->template->set_layout('profile/layout');
        
        // user id
        $user_id = $this->uri->segment(3);
        
        // выясняем, показать личный профиль или профиль какого-то юзера
        $this->whois($user_id);
        
        // присваиваем переменной
        $this->template->set('user', $this->profile);
        
        // стили
        $this->template->append_metadata(Assets::module_css('profile.css', 'users'));
        
        // хлебные крошки
        if( $this->profile->is_current )
        {
            $this->breadcrumbs->add_item('Личный профиль', 'users/profile');
        }
        else
        {
            $this->breadcrumbs->add_item('Профиль пользователя', 'users/profile/'. $this->profile->id);
        }
    }
    
    /**
     * Выясняем чей профиль загружать, личный или какого-то юзера
     */
    function whois($user_id)
    {
        // если номер id пользователя
        if( is_numeric($user_id) )
        {
            if( $user_id == 0 )
            {
                show_404();
            }
            
            $this->db->select($this->users_m->table. '.*, d.*');
            $this->db->join('bux_users_data AS d', 'd.user_id = '. $this->users_m->table.'.id');
            $user = $this->users_m->by_id($user_id)->get_one();
            
            if( !$user )
            {
                show_404();
            }
        }
        // если личный профиль
        else
        {
            // проверяем, что авторизован
            if( $this->user->is_guest )
            {
                $this->session->set_flashdata('attention', 'Для просмотра своего профиля войдите или зарегистрируйтесь.');
                
                URL::redirect('users/login');
            }
        }
        
        $this->profile = isset($user) ? $user : clone $this->user;
    }
}