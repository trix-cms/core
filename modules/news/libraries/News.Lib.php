<?php

class News_Lib {
    
    static function widget()
    {
        CI::$APP->load->model(array(
            'categories/categories_m',
            'news/news_m'
        ));
        
        // категории
        $categories = CI::$APP->categories_m->by_module('news')->get_all();
        
        // новости
        $items = CI::$APP->news_m->get_from_every_category($categories, 1);
        
        CI::$APP->template->load('news/_widget', array(
            'items'=>$items,
            'categories'=>$categories
        ));
    }
}