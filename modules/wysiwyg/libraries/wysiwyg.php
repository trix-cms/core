<?php

class WYSIWYG {
    
    const TINYMCE = 'Tinymce';
    const REDAKTOR = 'Redactor';
    const CKEDITOR = 'Ckeditor';
    
    private static $instance = null;
    
    private function __construct(){}
    
    static function init($wysiwyg = self::TINYMCE)
    {
        if( self::$instance != null )
        {
            show_error('WYSIWYG error');
        }
        
        self::$instance = new self;
        
        if( self::$instance->is_show() )
        {
            call_user_func('WYSIWYG\Providers\\' . $wysiwyg .'::run');
        }
    }
    
    function is_show()
    {
        $config = CI::$APP->config->item('wysiwyg');
        $actions = $config[CI::$APP->is_backend ? 'admin' : 'public'];
        
        if( empty($actions) )
        {
            return FALSE;
        }
        
        // use wysiwyg in all actions
        if( $actions == '*' )
        {
            return TRUE;
        }
        
        
        
        // check specific action
        if( key_exists(CI::$APP->module, $actions) AND in_array(CI::$APP->action, $actions[CI::$APP->module]) )
        {            
            return TRUE;
        }
        
        return FALSE;
    }
}