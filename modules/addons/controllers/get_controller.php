<?php

class Get_Controller extends Trix_Controller
{
    function __construct()
    {
        parent::__construct();
        
        $this->load->database();
        $this->load->library(array(
            'Trix\Template'
        ));
        
        $this->load->model('addons_m');
    }
    
    function action_index()
    {
        $items = $this->addons_m->get_all();
        
        echo serialize($items);
    }
    
    function action_download($id)
    {
        if( !$module = $this->addons_m->by_id($id)->get_one() )
        {
            show_404();   
        }
        
        echo file_get_contents(Addons\Config::UPLOAD_PATH . $module->archive);
    }
    
    function action_info($id)
    {
        if( !$module = $this->addons_m->by_id($id)->get_one() )
        {
            show_404();   
        }
        
        echo serialize($module);
    }
}