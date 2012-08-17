<?php

class Dashboard_Controller extends Core\Controllers\Frontend
{
    public function action_index()
    {        
        $this->render('index');
    }
}