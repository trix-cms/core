<?php

class Page_Controller extends Controllers\Frontend {

    function __construct()
    {
        parent::__construct();

        // модель
        $this->load->model('page/page_m');
    }

    function action_index()
    {
        // хлебные крошки
        $this->breadcrumbs->add_item('Модуль страницы', 'page');
        
        $this->render('index');
    }

    /**
     * Просмотр страницы
     */
    function action_view($url)
    {
        if( !$page = $this->page_m->by_url($url)->or_where('id', $url)->get_one() )
        {
            show_404();
        }

        // хлебные крошки
        $this->breadcrumbs->add_item($page->title, $page->full_url);

        $this->render('view', array(
            'page'=>$page
        ));
    }
}