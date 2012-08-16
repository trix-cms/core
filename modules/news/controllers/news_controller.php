<?php

/**
 * Публичная часть модуля новостей
 */
class News_Controller extends Public_Controller {

    function __construct()
    {
        parent::__construct();

        // модель
        $this->load->model('news/news_m');
        $this->load->model('categories/categories_m');
        
        // конфиг
        $this->load->config('news/config');
        
        // хлебные крошки
        $this->breadcrumbs->add_item('Новости', 'news');
        
        // категории
        $categories = $this->categories_m->by_module($this->module)->get_all();
        $this->template->set('categories', $categories);
        
        // вложенный шаблон
        $this->template->set_layout('news::layout');
    }

    /**
     * Список новостей
     */
    function action_index($page = 1)
    {
        $page = $page > 0 ? (int)$page : 1;
        
        // количество новостей в каждой категории
        $limit = $this->settings->news->per_page;
        $offset = ($page - 1)*$limit;
        
        // всего новостей
        $total = $this->news_m->count();

        // новости
        $items = $this->news_m
                            ->order_by('created_on', 'DESC')
                            ->limit($limit)
                            ->offset($offset)
                            ->get_all();
                            
        // пагинация
        $pager = new Pagination;
        $pager->set_total($total);
        $pager->set_page($page);
        $pager->set_url('news/index');
        $pager->set_per_page($limit);

        $this->render('index', array(
            'items'=>$items,
            'pager'=>$pager
        ));
    }
    
    /**
     * Просмотр новости
     */
    function action_view($id = false)
    {
        if( !$item = $this->news_m->where('news.id', $id)->or_where('news.url', $id)->with_categories()->get_one() )
        {
            show_404();
        }

        $this->breadcrumbs->add_item($item->category_title, 'news/cat/'. $item->category_id);
        $this->breadcrumbs->add_item('Просмотр публикации', 'news/view/'. $item->id);

        $this->template->render('view', array(
            'item'=>$item
        ));
    }
    
    function action_category($category_id, $page = 1)
    {
        // страница
        $page = $page > 0 ? (int)$page : 1;
        
        $limit = 10;
        $offset = ($page - 1)*$limit;

        // категория
        if( !$category = $this->categories_m->by_id($category_id)->get_one() )
        {
            show_404();
        }

        // новости
        $items = $this->news_m
                        ->order_by('created_on', 'DESC')
                        ->limit($limit)
                        ->offset($offset)
                        ->by_cat_id($category_id)
                        ->get_all();

        // всего новостей
        $total = $this->news_m->by_cat_id($category_id)->count();

        // пагинация
        $pagination = new Pagination;
        $pagination->setUrl('news/category/'. $category->id);
        $pagination->setCurrentPage($page);
        $pagination->setTotal($total);
        $pagination->setPerPage($limit);
        
        // заголовок
        $this->template->set_title($category->title);

        $this->render('category', array(
            'items'=>$items,
            'pagination'=>$pagination
        ));                
    }

    function action_rss()
    {
        header("Content-Type: application/xml; charset=UTF-8");

        $data['title']          = 'KaviCom - новости';
        $data['link']           = 'http://kavicom.ru/';
        $data['description']    = 'Новости Старого Оскола - Кавиком.';
        $data['module']         = 'news';

        $data['items'] = $this->news_m
                                    ->moderated()
                                    ->notBlocked()
                                    ->order_by('created_on', 'DESC')
                                    ->limit(100)
                                    ->getAll();

        $this->template->load('rss', $data);
    }
}