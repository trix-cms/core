<?php

namespace Trix;

class Form_validation extends \CI_Form_validation {

    function __construct()
    {
        parent::__construct();
        
        $this->set_error_delimiters('&nbsp;', '<br />');
    }

    function run($module = '', $group = '')
    {
        (is_object($module)) AND $this->CI =& $module;

            return parent::run($group);
    }
}