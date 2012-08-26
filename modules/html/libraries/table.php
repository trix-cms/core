<?php

namespace HTML;

class Table
{
    static function display($config)
    {
        $template = isset($config['template']) ? $config['template'] : 'template';
        $config['no_items'] = isset($config['no_items']) ? $config['no_items'] : '';
        $config['view'] = $config['view'];
        
        \CI::$APP->load->view('html::table/' . $template, $config);
    }
}