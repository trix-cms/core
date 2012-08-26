<?php

namespace Trix;

use URL;

class Breadcrumbs {

    private $index_item = array('Home', '');
    private $items = array();
    private $delimiter = '';
    private $item_before = '';
    private $item_after = '';
    private $show_on_index = TRUE;
    private $start_tag;
    private $end_tag;
    
    function add_item($title, $url)
    {
        if( is_array($title) )
        {
            foreach($title as $key => $value)
            {
                $this->add_item($key, $value);
            }
            
            return;
        }
        
        $this->items[] = array('title' => $title, 'url' => $url);
    }

    function set_delimiter($char)
    {
        $this->delimiter = $char;
    }

    function inactive_item_decoration($before = '', $after = '')
    {
        $this->item_before = $before;
        $this->item_after = $after;
    }

    function remove_last_item()
    {
        array_pop($this->items);
    }

    function display($config = array())
    {
        $this->configure($config);
        
        $temp = array();
        $total = count($this->items);

        if( $this->show_on_index == FALSE AND $total < 2 )
        {
            return;
        }

        $result = $this->start_tag;
        for($i=0; $i<$total; $i++)
        {
            if($i+1 == $total)
            {
                $temp[] = $this->item_before.$this->items[$i]['title'].$this->item_after;
            }
            else
            {
                $temp[] = $this->item_before.URL::anchor($this->items[$i]['url'], $this->items[$i]['title']).$this->item_after;
            }
        }
        
        $result .= implode($this->delimiter, $temp);
        $result .= $this->end_tag;

        return $result;
    }
    
    function configure($config)
    {        
        if( isset($config['item_before']) )
        {
            $this->item_before = $config['item_before'];
        }
        
        if( isset($config['item_after']) )
        {
            $this->item_after = $config['item_after'];
        }
        
        if( isset($config['start_tag']) )
        {
            $this->start_tag = $config['start_tag'];
        }
        
        if( isset($config['end_tag']) )
        {
            $this->end_tag = $config['end_tag'];
        }
        
        if( isset($config['delimiter']) )
        {
            $this->delimiter = $config['delimiter'];
        }
        
        if( isset($config['index_item']) )
        {
            array_unshift($this->items, array('title'=>$config['index_item'][0], 'url'=>$config['index_item'][1]));
        }
        
        $this->show_on_index = isset($config['show_on_index']) ? $config['show_on_index'] : $this->show_on_index;
    }
}