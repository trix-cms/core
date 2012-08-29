<?php

class My_Controller extends Trix\Controllers\Frontend
{
    function __construct()
    {
        parent::__construct();
        
        if( $this->user->is_guest )
        {
            $this->alert->set(
                Trix\Alert::ATTENTION, 
                'Для доступа к этому разделу вы должны авторизоваться. '. URL::anchor('users/login', 'Войти')
            );
            
            echo Modules::run('trix/error/general');
        }
        
        $this->load->model('addons/addons_m');
        
        $this->template->set_layout('my/layout');
    }
    
    /**
     * Список дополнений
     */
    function action_index($page = 1)
    {
        $items = $this->addons_m->by_user_id($this->user->id)->get_all();
        
        $this->render('my/index', array(
            'items'=>$items
        ));
    }
    
    function action_edit($id)
    {
        $this->action_add($id);
    }
    
    /**
     * Добавление дополнения
     */
    function action_add($id = false)
    {
        $item = $id ? $this->addons_m->by_id($id)->get_one() : FALSE;
        
        $this->load->library('Trix\Form_validation');
        
        // лбработка формы
        if( $this->input->post('submit') OR $this->input->post('apply') )
        {
            // устанавливаем правила валидации
            $this->form_validation->set_rules(Addons\Config::$validation_rules);

            // валидация формы
            if( $this->form_validation->run() )
            {                
                // загрузка файла
                if( $this->upload_file($item) )
                {
                    $data = array(
                        'slug'=>$this->input->post('slug', TRUE),
                        'name'=>$this->input->post('name', TRUE),
                        'desc'=>$this->input->post('description', TRUE),
                        'version'=>$this->input->post('version', TRUE),
                        
                        'author'=>$this->user->login,
                        'user_id'=>$this->user->id,
                    );
                    
                    // если был загружен файл
                    if( $this->upload_data )
                    {                        
                        $data['archive'] = $this->upload_data['file_name'];
                    }
                    
                    if( $item )
                    {
                        $data['updated_on'] = time();
                        
                        $this->addons_m->by_id($id)->update($data);
                        
                        $this->alert->set_flash(Trix\Alert::SUCCESS, 'Изменения сохранены');
                        
                        if ($this->input->post('apply')) 
                        {
                            URL::refresh();
                        } 
                        else 
                        {
                            URL::redirect('addons/my');
                        }
                    }
                    else
                    {
                        $data['created_on'] = time();
                        
                        $this->addons_m->insert($data);
                        
                        $this->alert->set_flash(Trix\Alert::SUCCESS, 'Дополнение добавлено успешно');
                        
                        URL::redirect('addons/my');
                    }
                }
                // ошибки при загрузке файла
                else
                {
                    $this->alert->set(Trix\Alert::ERROR, $this->upload->display_errors());
                }  
            }
            // ошибки при валидаци формы
            else
            {
                $this->alert->set(Trix\Alert::ERROR, validation_errors());
            }   
        }
        
        $this->render('my/add', array(
            'item'=>$item
        ));
    }
    
    /**
     * Удаление дополнения
     */
    function action_delete($id)
    {
        if( ! $item = $this->addons_m->by_id($id)->get_one() )
        {
            show_404();
        }
        
        // удаляем запись
        $this->addons_m->by_id($id)->delete();
        
        // удаляем файл
        $path = Addons\Config::UPLOAD_PATH . $item->archive;
                    
        if( file_exists($path) )
        {
            unlink($path);
        }
        
        if( $this->is_ajax() )
        {
            echo json_encode(array(
                'success'=>TRUE
            ));
        }
        else
        {
            $this->alert->set_flash(Trix\Alert::SUCCESS, 'Дополнение удалено');
            
            URL::referer();
        }
    }
    
    function upload_file($item)
    {        
        $this->load->library('upload', Addons\Config::$upload_config );
        
        // если редактируем, то можно не загружать файл
        if( !$item OR ($item AND $_FILES['userfile']['error'] != UPLOAD_ERR_NO_FILE) )
        {
            if( $this->upload->do_upload() )
            {
                $this->upload_data = $this->upload->data();
                
                // если загрузили новый файл, то удаляем старый
                if( $item AND $item->archive )
                {
                    $path = Addons\Config::UPLOAD_PATH . $item->archive;
                    
                    if( file_exists($path) )
                    {
                        unlink($path);
                    }
                }
                
                return TRUE;
            }
            else
            {
                return FALSE;
            }
        }
        else
        {
            $this->upload_data = FALSE;
            
            return TRUE;
        }
    }
}