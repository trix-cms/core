<?php

namespace WYSIWYG\Providers;

class Tinymce 
{
    function run()
    {
        echo \Assets::js('wysiwyg/tiny_mce/tiny_mce.js');
        echo \Assets::js('wysiwyg/tiny_mce/admin-setup.js');
    }
}