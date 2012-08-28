<?php

class Categories_Controller extends Trix\Controllers\Backend {
    
    function __construct()
    {
        parent::__construct();
        
        // модель
        $this->load->model('categories/categories_m');
        
        // стили
        $this->template->append_metadata(Assets::module_css('admin.css', 'categories'));
    }
    
    function action_edit($id)
    {
        if( !$category = $this->categories_m->get_by_id($id) )
        {
            show_404();
        } 
        
        if( $this->input->post('submit') )
        {
            $this->load->library('Trix\Form_validation');
            
            $this->form_validation->set_rules('title', 'Название', 'trim|required');
            
            if( $this->form_validation->run() !== FALSE )
            {
                $data['title']          = $this->input->post('title');
                $data['description']    = $this->input->post('description');
                $data['is_active']      = 1;
                
                $this->categories_m->by_id($id)->update($data);
                
                $this->session->set_flashdata('success', 'Изменения сохранены');
                
                URL::redirect('admin/'. $category->module .'/categories');
            }
            else
            {
                $this->template->set_message('error', validation_errors());
            }
        }  
        
        $this->template->set_title('Редактирование категории '.$category->title);
        
        $this->breadcrumbs->add_item('Редактирование категории', 'admin/categories/edit/'. $category->id);
        
        $this->render('edit', array(
            'category'=>$category
        ));
    }
    
    function action_activate($category_id, $status)
    {
        $this->categories_m->update(array('id' => $category_id), array('is_active' => $status));
        
        $this->session->set_flashdata('success', 'Статус изменен');
        
        URL::referer();
    }
    
    /**
     * Удаление категории
     */
    function action_delete($category_id)
    {
        $this->categories_m->delete($category_id);
        
        if( $this->is_ajax() )
        {
            echo 'ok';   
        }
        else
        {
            $this->session->set_flashdata('success', 'Категория удалена');
        
            URL::referer();
        }
    }
}
