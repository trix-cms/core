<?php

namespace Trix;

class WYSIWYG extends \Modules\AbstractModule
{
    public $name = 'WYSIWYG';
    public $description = 'Визивиг';
    public $slug = 'Trix\WYSIWYG';
    public $version = '1.0';
    public $is_helper = 1;
    public $author = 'Trix';
    
    function files()
    {
        return array(
            'wysiwyg.php',
            'js/wysiwyg',
            'libraries/wysiwyg.php'
        );
    }
}