<?php

namespace HTML;

use CI;

class Form 
{
    static function display($config)
    {        
        $config['attr']['action'] = isset($config['attr']['action']) ? $config['attr']['action'] : '';
        $config['attr']['method'] = isset($config['attr']['method']) ? $config['attr']['method'] : 'post';
        $template = isset($config['template']) ? $config['template'] .'/' : '';
        
        $html = '<form '. ( isset($config['attr']) ? Tag::parse_attributes($config['attr']) : '') .'>';
        foreach($config['inputs'] as $input)
        {
            $input['visibility'] = isset($input['visibility']) ? $input['visibility'] : TRUE;
            $input['attr'] = isset($input['attr']) ? $input['attr'] : '';
            $input['extra'] = isset($input['extra']) ? $input['extra'] : '';
            $input['help'] = isset($input['help']) ? $input['help'] : '';
            if( $input['visibility'] )
            {
                if( $input['type'] == 'custom' )
                {
                    $html .= CI::$APP->load->view($input['view'], $input, TRUE);
                }
                else
                {
                    $html .= CI::$APP->load->view('html::form/inputs/'. $template . $input['type'], $input, TRUE);
                }
            }
        }
        $html .= '</form>';
        
        echo $html;
    }
}