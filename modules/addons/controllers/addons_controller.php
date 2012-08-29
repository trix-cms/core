<?php

/**
 * Модуль дополнений
 */
class Addons_Controller extends Trix\Controllers\Frontend
{
    public function __construct()
    {
        parent::__construct();
        
        $this->load->model('addons/addons_m');
        
        $this->template->set_layout('layout');
    }
    
    /**
     * Список дополнений
     */
    public function action_index()
    {
        $items = $this->addons_m->get_all();
        
        $this->render('index', array(
            'items'=>$items
        ));   
    }
    
    /**
     * Просмотр дополнения
     */
    public function action_view($id)
    {
        if( !$item = $this->addons_m->by_id($id)->get_one() )
        {
            show_404();
        }
        
        $this->render('view', array(
            'item'=>$item
        ));
    }
}