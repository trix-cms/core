<?php

class Decorator {
    
    /**
     * Простой список
     * 
     * items
     * template
     */
    static function list_view($config)
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
                CI::$APP->load->view($config['view'], $data);
                $i++;
            }
        }
        else
        {
            echo $config['no_items'];
        }
    }
    
    /**
     * По рядам в несколько элементов
     * 
     * star_row_tag
     * end_row_tag
     * items
     * items_in_row
     */
    static function row_view($config)
    {
        $i=0;
        echo $config['start_row_tag'];
        foreach($config['items'] as $item)
        {
            if( $i%$config['items_in_row'] == 0 )
            {
                echo $config['end_row_tag'].$config['start_row_tag'];
            }
            
            CI::$APP->load->view($config['template'], array('item'=>$item, 'i'=>$i));
            $i++;
        }
        echo $config['end_row_tag'];
    }
    
    /**
     * Таблица
     * 
     * <?php Decorator::table_view(array(
                'row_template'=>'_row',
                'items'=>$pages,
                'headings'=>array(
                    '<input type="checkbox" class="check-all" />',
                    '&nbsp;',
                    'Название',
                    'Ссылка',
                    'Статус',
                    'Действия'
                )
            ))?>
     * 
     * 
     */
    static function table_view($config)
    {
        $template = isset($config['template']) ? $config['template'] : 'partials/tables/default';
        $config['no_items'] = isset($config['no_items']) ? $config['no_items'] : '';
        $config['view'] = isset($config['view']) 
                                    ? $config['view'] 
                                    : 'partials/tables/rows/default';
        
        CI::$APP->load->view($template, $config);
    }
    
    /**
     * Форма
     */
    static function form_view($config)
    {
        $config['attr']['action'] = isset($config['attr']['action']) ? $config['attr']['action'] : '';
        $config['attr']['method'] = isset($config['attr']['method']) ? $config['attr']['method'] : 'post';
        $template = isset($config['template']) ? $config['template'] .'/' : '';
        
        $html = '<form '. ( isset($config['attr']) ? HTML::parse_attributes($config['attr']) : '') .'>';
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
                    $html .= CI::$APP->load->view('inputs/'. $template . $input['type'], $input, TRUE);
                }
            }
        }
        $html .= '</form>';
        
        echo $html;
    }
}