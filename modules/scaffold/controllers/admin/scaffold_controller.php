<?php

class Scaffold_Controller extends Controllers\Backend {
    
    function __construct()
    {
        parent::__construct();
        
        // модель
        $this->load->model('scaffold/scaffold_m');
        
        // хлебные крошки
        $this->breadcrumbs->add_item('Scaffolding', 'admin/scaffold');
        
        // стили
        $this->template->append_metadata(Module::css('scaffold.css', 'scaffold'));

        // layout
        $this->template->set_layout('layout');
    }
    
    /**
     * Список таблиц
     */
    function action_index()
    {
        $tables = $this->scaffold_m->get_tables();
        
        $this->render('index', array(
            'tables'=>$tables
        ));
    }
    
    /**
     * Поля таблицы
     */
    function action_table($table, $page = 1)
    {
        $this->scaffold_m->table = $table;
        
        $fields = $this->scaffold_m->field_data();
        $primary_key = $this->scaffold_m->get_primary_key($fields);
        
        $limit = 15;
        $offset = ($page - 1)*$limit;
        
        $total = $this->scaffold_m->count();
        
        if( $primary_key )
        {
            $this->scaffold_m->order_by($primary_key, 'DESC');
        }
        $rows = $this->scaffold_m->limit($limit)->offset($offset)->get_all();
        
        $pagination = new Pagination;
        $pagination->set_page($page);
        $pagination->set_total($total);
        $pagination->set_url('admin/scaffold/table/'. $table);
        $pagination->set_per_page($limit);
        
        $fields_headings = array('Действия');
        
        foreach($fields as $field)
        {
            $fields_headings[] = $field->name;
        }
        
        $this->breadcrumbs->add_item($table, 'admin/scaffolding/'. $table);
        
        $this->render('table', array(
            'total'=>$total,
            'rows'=>$rows,
            'pagination'=>$pagination,
            'table'=>$table,
            'fields'=>$fields,
            'fields_headings'=>$fields_headings,
            'primary_key'=>$primary_key
        ));
    }
    
    /**
     * Удаление записи
     */
    function action_row_delete($table, $primary_key, $pk)
    {
        $this->scaffold_m->table = $table;
        
        $this->scaffold_m->where($primary_key, $pk)->delete();
        
        if( $this->is_ajax() )
        {
            echo 'ok';
        }
        else
        {
            $this->alert->set(Notification::SUCCESS, 'Запись удалена');
        
            URL::referer();
        }
    }
    
    /**
     * Редактирование записи
     */
    function action_row_edit($table, $pk)
    {
        $this->action_row_create($table, $pk);
    }
    
    /**
     * Создание записи
     */
    function action_row_create($table, $pk = false)
    {
        $this->scaffold_m->table = $table;

        $fields = $this->scaffold_m->field_data();
        $primary_key = $this->scaffold_m->get_primary_key($fields);   
        
        $item = $pk ? $this->scaffold_m->where($primary_key, $pk)->get_one() : FALSE;     
        
        if( $this->input->post('submit') )
        {            
            foreach($fields as $field)
            {
                if( $this->input->post($field->name) != '' )
                {
                    $data[$field->name] = $this->input->post($field->name);
                }
            }
            
            if( $item )
            {
                $this->scaffold_m->where($primary_key, $pk)->update($data);
                
                $this->session->set_flashdata('success', 'Запись изменена');
                
                URL::redirect('admin/scaffold/table/'. $table);
            }
            else
            {
                $this->scaffold_m->insert($data);
                
                $this->session->set_flashdata('success', 'Запись создана');
                
                URL::refresh();
            }
        } 
        
        $this->breadcrumbs->add_item($table, 'admin/scaffold/table/'. $table);
        $this->breadcrumbs->add_item('Создание записи', 'admin/scaffold/row_create/'. $table);
        
        $this->render('row/create', array(
            'table'=>$table,
            'fields'=>$fields,
            'primary_key'=>$primary_key,
            'item'=>$item
        ));
    }
    
    /**
     * SQL запрос
     */
    function action_sql()
    {
        $this->load->library('form_validation');
        
        if( $this->input->post('submit') )
        {
            $this->form_validation->set_rules('query', 'Запрос', 'trim');
            
            $query = $this->input->post('query');
            
            if( $this->form_validation->run() ){}
            
            $result = $this->db->query($query);
            
            $this->template->set_message('success', 'Запрос выполнен. '.print_r($result->result(), TRUE));
        }
        
        $this->breadcrumbs->add_item('SQL', 'admin/scaffold/sql');
        
        $this->render('sql/index');
    }
}