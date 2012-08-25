<?php

class Page_Controller extends Controllers\Backend {
    
    function __construct()
    {
        parent::__construct();
        
        // модель
        $this->load->model('page/page_m');
        
        // хлебные крошки
        $this->breadcrumbs->add_item('Страницы', 'admin/page');
        
        // layout
        $this->template->set_layout('layout');
    }

    /**
     * Список страниц
     */
    function action_index($page = 1)
    {
        $limit = 15;
        $offset = ($page - 1)*$limit;     

        // всего страниц
        $total = $this->page_m->count(); 
        
        // страницы
        $pages = $this->page_m->limit($limit)->offset($offset)->get_all();
        
        // пагинация
        $pagination = new Pagination;
        $pagination->set_total($total);
        $pagination->set_page($page);
        $pagination->set_url('admin/page/index');
        $pagination->set_per_page($limit);

        $this->render('index', array(
            'pages'=>$pages,
            'pagination'=>$pagination
        ));
    }
    
    /**
     * Добавление и редактирование страницы
     */
    function action_add($id = false)
    {
        // загружаем библиотеку
        $this->load->library('form_validation');
        
        // странца при редактировании
        $page = $this->page_m->by_id($id)->get_one();

        // обрабатываем форму
        if($this->input->post('submit') OR $this->input->post('apply'))
        {
            // правила валидации
            $this->form_validation->set_rules('title', 'Название страницы', 'trim|required');
            $this->form_validation->set_rules('url', 'URL страницы', 'trim|required');
            $this->form_validation->set_rules('body', 'Текст', 'trim|required');
            
            // валидация
            if($this->form_validation->run() === true)
            {
                // данные
                $data = array(
                    'url'=>$this->input->post('url'),
                    'title'=>$this->input->post('title'),
                    'body'=>$this->input->post('body'),
                    'status'=>$this->input->post('status'),
                    'keywords'=>$this->input->post('keywords'),
                    'description'=>$this->input->post('description'),
                );
                
                // обновляем запись
                if( $page )
                {
                    // обновляем запись
                    $this->page_m->by_id($id)->update($data);
                    
                    // сообщение юзеру
                    $this->alert->set(Notification::SUCCESS, 'Изменения сохранены');
                    
                    if( $this->input->post('apply') )
                    {
                        URL::refresh();
                    } 
                    else 
                    {
                        URL::redirect('admin/page');
                    }
                }
                // создаем запись
                else
                {
                    // добавляем запись
                    $this->page_m->insert($data);
                    
                    // сообщение юзеру
                    $this->alert->set(Notification::SUCCESS, 'Страница успешно добавлена');
                    
                    // редирект
                    URL::redirect('admin/page');
                }
            }
            else
            {
                $this->alert->set(Notification::ERROR, validation_errors('<b>', '</b><br />'));
            }
        }
        
        // хлебные крошки
        $this->breadcrumbs->add_item($page ? 'Редактирование страницы' : 'Создание страницы', '');
        
        // скрипты
        $this->template->append_metadata(Assets::js('translit.js'));
        
        $this->render('add', array(
            'page'=>$page
        ));
    }
    
    /**
     * Редактирование страницы
     */
    function action_edit($id = false)
    {
        $this->action_add($id);
    }
    
    function action_delete($id)
    {
        // удаляем страницу
        $this->page_m->where('id', $id)->delete();
        
        if( $this->is_ajax() )
        {
            echo 'ok';
        }
        else
        {
            // информационное сообщение
            $this->session->set_flashdata('success', 'Страница удалена');
            
            // редиректим обратно
            URL::referer();
        }
    }
}