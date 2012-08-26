<?php

class Pagination {

    private $template = 'pagination';           // øàáëîí
    private $total;                             // âñåãî ýëåìåíòîâ
    private $per_page;                          // ýëåìåíòîâ íà ñòðàíèöó
    private $url;                               // ññûëêà
    private $query;                             // ?param=value ÷àñòü â óðëå
    private $page;                              // òåêóùàÿ ñòðàíèöà
    
    function display()
    {        
        if( $this->total > $this->per_page )
        {
            $data['pages_total']       = ceil($this->total/$this->per_page);
            $data['current_page']      = $this->page;
            $data['link']              = $this->url;
            $data['query']             = $this->query;

            CI::$APP->load->view($this->template, $data);
        }
    }

    function set_template($template)
    {
        $this->template = $template;
        return $this;
    }

    function set_per_page($per_page)
    {
        $this->per_page = $per_page;
        return $this;
    }

    function set_total($total)
    {
        $this->total = $total;
        return $this;
    }

    function set_url($url, $query = false)
    {
        $this->url = $url;
        $this->query = $query ? '?'. $query : '';
        return $this;
    }

    function set_page($page)
    {
        $this->page = $page;
        return $this;
    }
}