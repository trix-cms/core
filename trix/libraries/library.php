<?php

abstract class Library {
    
    function __get($key)
    {
        return CI::$APP->$key;
    }
}