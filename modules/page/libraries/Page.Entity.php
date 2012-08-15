<?php

class Page_Entity extends Entity {
    
    function get_full_url()
    {
        return 'page/view/'. $this->url;
    }
}