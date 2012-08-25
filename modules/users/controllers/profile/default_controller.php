<?php

/**
 * Профиль пользователя
 */
class Default_Controller extends Users\Controllers\Profile {
    
    /**
     * Первая страница профиля пользователя
     */
    function action_index($data = false)
    {
        $this->render('profile/index', array(
            'tab'=>'general'
        ));
    }
    
    /**
     * Редактирование пароля
     */
    function action_password()
    {
        if( $this->input->post('submit') )
        {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('old_password', 'Старый пароль', 'trim|required');
            $this->form_validation->set_rules('password', 'Новый пароль', 'trim|required|min_width[6]|matches[password2]');
            $this->form_validation->set_rules('password2', 'Новый пароль(еще раз)', 'trim|required');

            if( $this->form_validation->run() )
            {
                $old_password = $this->auth->dohash($this->input->post('old_password'));
                
                if( $this->user->password == $old_password )
                {
                    $data['password'] = $this->auth->dohash($this->input->post('password'));
                
                    $this->users_m->by_id($this->user->id)->update($data);
                    
                    $this->auth->clear_cache();
    
                    $this->alert->set(Notification::SUCCESS, 'Пароль был успешно изменен');
                }
                else
                {
                    $this->alert->set(Notification::ERROR, 'Неверно введен старый пароль');
                }
            }
            else
            {
                $this->alert->set(Notification::ERROR, validation_errors());
            }
        }
        
        URL::referer();
    }
    
    /**
     * Редактирование профиля
     */
    function action_edit()
    {
        // если гость редиректим на авторизацию
        if( $this->user->is_guest )
        {
            URL::redirect('users/login');
        }

        if( $this->input->post('submit') )
        {
            $this->load->library('form_validation');

            // правила валидации
            //$this->form_validation->set_rules('email', 'Ваш E-Mail', 'trim|required|valid_email|callback__check_email');
            //$this->form_validation->set_rules('name', 'Name', 'trim|required');

            if( $this->form_validation->run($this) )
            {
                // собираем данные формы
                
                // обновляем данные пользователя
                //$this->users_m->where('id', $this->user->id)->update($data);
                
                // сбрасываем сессию
                $this->session->unset_userdata('user');

                // информационные сообщение
                $this->alert->set(Notification::SUCCESS, 'Изменения сохранены');

                // редиректим
                URL::referer();
            }
            else
            {
                $this->alert->set(Notification::ERROR, validation_errors());
            }
    }

        // хлебные крошки
        $this->breadcrumbs->add_item('Редактирование', 'users/profile/edit');

        $this->render('profile/edit');
    }
    
    /**
     * Загрузка аватара
     */
    function action_avatar()
    {
        if( $this->user->is_guest )
        {
            URL::redirect('users/login');
        }

        if( $this->input->post('avatar_upload') )
        {
            $config['upload_path'] = Users_Config::AVATAR_PATH;
            $config['allowed_types'] = 'gif|jpg|png';
            $config['encrypt_name'] = TRUE;
            
            $image_max_width = 60;

            $this->load->library('upload', $config);

            if( $this->upload->do_upload() )
            {
                $data = $this->upload->data();

                $sizes = getimagesize($data['full_path']);
                $width = $sizes[0];
                $height = $sizes[1];

                // если больше ширина или высота, то уменьшаем фотку
                if( $width > $image_max_width OR $height > $image_max_width )
                {
                    $this->load->library('image_lib');

                    $config['image_library']    = 'gd2';
                    $config['source_image']	    = $data['full_path'];
                    $config['new_image']        = $data['full_path'];
                    $config['maintain_ratio']   = TRUE;
                    $config['width']	        = $image_max_width;
                    $config['height']	        = $image_max_width;
                    if( $width != $height )
                    {
                        $ratio = $width/$height;
                        $config['width'] = $width > $height ? $image_max_width*$ratio : $image_max_width;
                        $config['height'] = $width > $height ? $image_max_width : $image_max_width/$ratio;
                    }

                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                    
                    $this->image_lib->clear();
                    $config = array();
                }
                
                // ресайзим превью
                $config['image_library'] = 'gd2';
                $config['source_image']	= $data['full_path'];
                $config['new_image'] = $data['full_path'];
                $config['maintain_ratio'] = FALSE;
                $config['x_axis'] = 0;
                $config['y_axis'] = 0;
                $config['width'] = $image_max_width;
                $config['height'] = $image_max_width;
                $this->image_lib->initialize($config);
                $this->image_lib->crop();

                // удаляем предыдущий аватар
                if( $this->user->avatar AND file_exists(Users_Config::AVATAR_PATH . $this->user->avatar) )
                {
                    unlink(Users_Config::AVATAR_PATH . $this->user->avatar);
                }

                $this->users_m->where('id', $this->user->id)->update(array('avatar' => $data['file_name']));

                $this->alert->set(Notification::SUCCESS, 'Аватар успешно загружен');
                
                $this->auth->clear_cache();
            }
            else
            {
                $this->alert->set(Notification::ERROR, $this->upload->display_errors());
            }
        }
        
        URL::referer();
        
        $this->breadcrumbs->add_item('Загрузка аватара', 'users/profile/avatar');

        $this->render('profile/change_avatar');
    }
}