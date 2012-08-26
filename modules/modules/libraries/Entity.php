<?php

namespace Modules;

use CI;

class Entity extends \Trix\Model\Entity {
    
    function get_full_url()
    {
        return 'admin/'. $this->url;
    }
    
    function is_current()
    {
        return CI::$APP->uri->segment(2) == $this->url;
    }
}