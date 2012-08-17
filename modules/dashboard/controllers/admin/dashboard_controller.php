<?php

class Dashboard_Controller extends Core\Controllers\Backend {

    function action_index()
    {
        $this->render('index');
    }
}