<?php

namespace Modules;

use CI;

class Entity extends \Entity {
    
    function get_full_url()
    {
        return 'admin/'. $this->url;
    }
    
    function is_current()
    {
        return CI::$APP->uri->segment(2) == $this->url;
    }
}