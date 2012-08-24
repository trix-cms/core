<?php

/**
 * Админская часть модуля новостей
 */
class News_Controller extends Core\Controllers\Backend {
    
    public $upload_data;

    function __construct()
    {
        parent::__construct();
        
        // модель
        $this->load->model('news/news_m');
        
        // конфиги
        $this->load->config('news/config');
        $this->load->config('news/admin');
        
        // хлебные крошки
        $this->breadcrumbs->add_item('Новости', 'admin/news');
        
        // вложенный шаблон
        $this->template->set_layout('layout');
    }

    /**
     * Список новостей
     */
    function action_index($page = 1)
    {
        $limit = $this->config->item('news_admin_news_per_page');
        $offset = ($page - 1)*$limit;     
        
        // всего новостей
        $total = $this->news_m->count();
        
        // новости
        $news = $this->news_m
                            ->order_by('id', 'DESC')
                            ->limit($limit)
                            ->offset($offset)
                            ->get_all();

        // пагинация
        $pagination = new Pagination;
        $pagination->set_page($page);
        $pagination->set_total($total);
        $pagination->set_url('admin/news/index');
        $pagination->set_per_page($limit);

        $this->render('index', array(
            'pagination'=>$pagination,
            'news'=>$news
        ));    
    }
    
    function action_settings()
    {
        $this->settings->display();
    }
    
    /**
     * Категории
     */
    function action_categories()
    {        
        $categories_lib = new Categories;
        
        $categories_lib->display();
    }

    /**
     * Редактирование новости
     */
    function action_edit($id)
    {
        $this->action_add($id);
    }

    /**
     * Добавление и редактирование новости
     */
    function action_add($id = false)
    {        
        // обработка формы
        $this->load->library('form_validation');
        
        $news = $this->news_m->by_id($id)->get_one();

        if( $this->input->post('submit') OR $this->input->post('apply') )
        {
            $this->form_validation->set_rules('title', 'Заголовок', 'trim|required');
            $this->form_validation->set_rules('content', 'Текст', 'trim|required');
            $this->form_validation->set_rules('url', 'ЧПУ', 'trim|required');

            if( $this->form_validation->run() === TRUE)
            {
                $data['title'] = $this->input->post('title', TRUE);
                $data['content'] = $this->input->post('content', TRUE);
                $data['url'] = $this->input->post('url');

                // редактирование
                if( $news )
                {                    
                    $this->news_m->by_id($news->id)->update($data);
                    
                    $this->notification->set(Notification::SUCCESS, 'Изменения сохранены');
                    
                    if( $this->input->post('apply') )
                    {                        
                        URL::refresh();
                    }
                    else
                    {                        
                        URL::redirect('admin/news');
                    }
                }
                // создание
                else
                {
                    $data['created_on'] = time();
                    
                    $this->notification->set(Notification::SUCCESS, 'Новость добавлена');
                    
                    $news_id = $this->news_m->insert($data);
                    
                    // редиректим
                    URL::redirect('admin/news');
                }
            }
            else
            {
                $this->notification->set(Notification::ERROR, validation_errors());
            }
        }
        
        // хлебные крошки
        if($news)
        {
            $this->breadcrumbs->add_item('Редактирование', 'admin/news/edit');
        }
        else
        {
            $this->breadcrumbs->add_item('Добавление', 'admin/news/add');
        }  
        
        // скрипты
        $this->template->append_metadata(Assets::js('translit.js'));

        $this->render('edit', array(
            'news'=>$news
        ));
    }

    /**
     * Удаление новости
     */
    function action_delete($id)
    {
        $news = $this->news_m->by_id($id)->get_one();
        
        // удаление новости
        $this->news_m->where('id', $id)->delete();

        if( $this->is_ajax() )
        {
            echo 'ok';
        }
        else
        {
            $this->session->set_flashdata('success', 'Новость удалена');

            URL::referer();
        }
    }
}