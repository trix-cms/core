<?php

class jQuery 
{
    function render($type = '')
    {
        if( $type = 'cdn' )
        {
            return HTML\Tag::js('//ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js');
        }
        else
        {
            return Assets::module_js('jquery.min.js', 'jquery');
        }
    }
}