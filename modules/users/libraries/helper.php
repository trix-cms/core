<?php

class Users_Helper {
    
    function gravatar($email, $default = FALSE)
    {
        $hash = md5( strtolower( trim( $email ) ) );
        $default = $default ? 'd='. urlencode($default) : '';
        
        return 'http://www.gravatar.com/avatar/'. $hash .'?'.$default;
    }
}