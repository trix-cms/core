<?php

namespace Page;

class Entity extends \Trix\Model\Entity {
    
    function get_full_url()
    {
        return 'page/view/'. $this->url;
    }
}