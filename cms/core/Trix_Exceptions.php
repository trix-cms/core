<?php

class Trix_Exceptions extends CI_Exceptions {
    
    function show_404()
    {
        echo Modules::run(CI::$APP->router->routes['404_override']);
    }
}