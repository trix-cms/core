<?php

class Trix_Exceptions extends CI_Exceptions {
    
    function show_404()
    {
        echo Modules::run('errors/show_404');
    }
}