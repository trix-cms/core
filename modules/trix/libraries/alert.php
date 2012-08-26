<?php

namespace Trix;

use CI;

class Alert {
    
    const INFO = 1;
    const SUCCESS = 2;
    const ERROR = 3;
    const ATTENTION = 4;
    
    private $type;
    private $message;
    private $has_message = FALSE;
    
    function __construct()
    {
        $alert = CI::$APP->session->flashdata('alert');

        if($alert)
        {
            $this->message = $alert['message'];
            $this->type = $alert['type'];
            $this->has_message = TRUE;
        }
    }
    
    function set($type, $message)
    {
        $this->type = $type;
        $this->message = $message;
        $this->has_message = TRUE;
    }
    
    function set_flash($type, $message)
    {
        CI::$APP->session->set_flashdata('alert', array(
            'type'=>$type,
            'message'=>$message
        ));
    }
    
    function display()
    {
        if( $this->has_message )
        {
            $view = 'trix::alert/' . $this->type_name($this->type);
            
            CI::$APP->load->view($view, array(
                'message'=>$this->message
            ));
            $this->has_message = FALSE;
        }        
    }
    
    function message($type, $message)
    {
        $this->set($type, $message);
        $this->display();
    }
    
    function type_name($type)
    {
        $types = array(
            self::INFO=>'info',
            self::SUCCESS=>'success',
            self::ERROR=>'error',
            self::ATTENTION=>'attention'
        );
        
        return $types[$type];
    }
}