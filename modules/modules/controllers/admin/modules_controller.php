<?php

class Modules_Controller extends Core\Controllers\Backend {
    
    function __construct()
    {
        parent::__construct();
        
        $this->load->model('modules/modules_m');
        
        $this->breadcrumbs->add_item('Модули', 'admin/modules');
    }
    
    function action_index()
    {
        $modules = $this->modules_m->where('is_core', 0)->get_all();
        $core_modules = $this->modules_m->where('is_core', 1)->get_all();

        $this->template->set_title('Модули');
        
        $this->render('index', array(
            'modules'=>$modules,
            'core_modules'=>$core_modules
        ));
    }
    
    function action_order()
    {
        $modules = $this->modules_m->where('is_menu', 1)->order_by('order', 'ASC')->get_all();
        
        $this->render('order', array(
            'modules'=>$modules
        ));
    }
    
    function action_reorder()
    {
        $ids = $this->input->post('ids');
        
        $i=1;
        foreach($ids as $id)
        {
            $this->modules_m->where('id', $id)->update(array('order'=>$i));
            $i++;
        }
    }
}