<?php

namespace Trix\WYSIWYG\Providers;

use Assets;

class Tinymce 
{
    function run()
    {
        echo Assets::module_js('wysiwyg/tiny_mce/tiny_mce.js', 'trix');
        echo Assets::module_js('wysiwyg/tiny_mce/admin-setup.js', 'trix');
    }
}