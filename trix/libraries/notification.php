<?php

class Notification {
    
    const INFO = 1;
    const SUCCESS = 2;
    const ERROR = 3;
    const ATTENTION = 4;
    
    private $type;
    private $message;
    private $has_message = FALSE;
    
    function __construct()
    {
        $notification = CI::$APP->session->flashdata('notification');

        if($notification)
        {
            $this->message = $notification['message'];
            $this->type = $notification['type'];
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
        CI::$APP->session->set_flashdata('notification', array(
            'type'=>$type,
            'message'=>$message
        ));
    }
    
    function display()
    {
        if( $this->has_message )
        {
            $view = '::notification/' . $this->type_name($this->type);
            
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