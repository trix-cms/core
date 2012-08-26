<?php

namespace HTML;

class TList 
{
    /**
     * Простой список
     * 
     * items
     * template
     */
    static function display($config)
    {
        $i=0;
        $data['first'] = 0;
        $data['last'] = count($config['items']) - 1;
        if( $config['items'] )
        {
            foreach($config['items'] as $item)
            {
                $data['item'] = $item;
                $data['i'] = $i;
                \CI::$APP->load->view($config['view'], $data);
                $i++;
            }
        }
        else
        {
            echo $config['no_items'];
        }
    }
}