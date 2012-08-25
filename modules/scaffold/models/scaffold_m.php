<?php

class Scaffold_m extends Trix_Model {
    
    public $table = false;
    
    function get_tables()
    {
        return $this->db->list_tables();
    }
    
    function list_fields()
    {
        return $this->db->list_fields($this->table);
    }
    
    function field_data()
    {
        return $this->db->field_data($this->table);
    }
    
    function get_primary_key($fields)
    {
        $primary_key = FALSE;
        
        foreach($fields as $field)
        {
            if( $field->primary_key )
            {
                return $field->name;
            }
        }
        
        return FALSE;
    }
}