<?php

namespace Users\Controllers\Admin;

class Base extends \Trix\Controllers\Backend
{
    function __construct()
    {
        parent::__construct();
        
        // хлебные крошки
        $this->breadcrumbs->add_item('Пользователи', 'admin/users');
        
        // вложенный шаблон
        $this->template->set_layout('layout');
        $this->template->set_layout('nav-layout');
    }
}