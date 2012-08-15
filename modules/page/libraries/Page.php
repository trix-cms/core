<?php

class Page {

    function getPageContentByUrl($url)
    {
        $ci = get_instance();

        $ci->load->model('page/page_m');

        $page = $ci->page_m->where('url', $url)->getOne();

        return $page->body;
    }
}