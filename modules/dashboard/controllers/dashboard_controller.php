<?php

class Dashboard_Controller extends Public_Controller
{
    public function action_index()
    {
        $this->render('index');
    }
    
    public function action_module()
    {
        echo Modules::run('news/index');
    }
}