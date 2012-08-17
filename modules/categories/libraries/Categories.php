<?php

class Categories extends Library {
    
    function display()
    {
        $module = $this->module;
        
        // модель
        $this->load->model('categories/categories_m');
        
        $this->load->library('form_validation');
        
        if( $this->input->post('submit') )
        {
            $this->form_validation->set_rules('title', 'Название', 'trim|required');
            
            if( $this->form_validation->run() !== FALSE )
            {
                $data['title']          = $this->input->post('title');
                $data['description']    = $this->input->post('description');
                $data['is_active']      = 1;
                $data['module']         = $module;
                
                $parent_id = $this->input->post('parent_id');
                
                $this->categories_m->insert($data, $parent_id);
                
                $this->session->set_flashdata('success', 'Категория добавлена');
                
                URL::referer();
            }
            else
            {
                $this->template->set_message('error', validation_errors());
            }
        }

        $categories = $module 
                            ? $this->categories_m->by_module($module)->order_by('lft', 'ASC')->get_all() 
                            : FALSE;
        
        $cat_options[0] = '';
        if( $categories )
        {
            foreach($categories as $cat)
            {
                $cat_options[$cat->id] = str_repeat('&nbsp;&nbsp;', $cat->level - 1).$cat->title;
            }
        }
        
        $this->breadcrumbs->add_item('Категории', 'admin/'. $module .'categories');
        
        $this->template->render('categories::admin/module', array(
            'categories'=>$categories,
            'module'=>$module,
            'cat_options'=>$cat_options
        ));
    }
}