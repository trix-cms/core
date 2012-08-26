<?php

class Error_Controller extends Trix\Controllers\Base
{
    /**
     * Вывод 404 страницы
     */
    function action_404()
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
        
        $this->render('error/404');
    }
}