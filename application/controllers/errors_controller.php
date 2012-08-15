<?php

/**
 * Контроллер ошибок
 */
class Errors_Controller extends Public_Controller {
    
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Вывод 404 страницы
     */
    function show_404()
    {
        header("HTTP/1.0 404 Not Found");

        /* когда грузит картинку/флеш, а ее нет, попадает сюда */
        $uri  = substr($this->uri->uri_string(), -3);
        $type = substr($_SERVER['HTTP_ACCEPT'], 0, 5);
        if ($type == 'image' || in_array($uri, array('swf', 'SWF', 'flv', 'FLV', 'css', '.js', 'CSS', '.JS')))
        {
            die();
        }
        /* --------------------------------------------------- */
        
        $this->template->set_theme($this->config->item('theme'));
        $this->template->layout = array();
        $this->template->layout[] = $this->config->item('layout');
        
        $this->render('errors/404');
    }
}