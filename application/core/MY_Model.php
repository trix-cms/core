<?php

class MY_Model extends CI_Model {

    public $table = null;
    public $primary_key = 'id';
    public $as_array = false;
    public $entity = false;
    public $module = false;
    public $attributes = false;
    
    public $relation_object = false;
    public $relation_prefix = false;
    public $relation_entity = false;

    function __construct($table = false)
    {
        parent::__construct();

        // название модуля
        $this->module = str_replace('_m', '', get_class($this));

        if( $this->table == null AND $this->table !== FALSE )
        {
            $this->table = $table ? $table : strtolower($this->module);
        }
        
        if( !$this->entity )
        {
            $this->entity = $this->module.'_Entity';
        }
        
        /*
        if( $this->table !== FALSE AND !$this->attributes AND $this->table AND $this->table != 'my_model'  )
        {
            $this->_get_attributes();
        }
        */
    }
    
    function _relations()
    {
        return array();
    }
    
    function _attributes()
    {
        return array();
    }
    
    function _get_attributes()
    {
        $this->attributes = $this->db->list_fields($this->table);
    }
    
    public function join($table, $cond, $type = '')
	{
		$this->db->join($table, $cond, $type);
		return $this;
	}

    function rand()
    {
        $this->order_by('RAND()');
        return $this;
    }

    static function factory($module, $model = false)
    {
        $model = $model ? $model : $module.'_m';

        if( !class_exists($model) )
        {
            CI::$APP->load->model($module.'/'.$model);
        }

        return CI::$APP->$model;
    }

    function distinct($val = TRUE)
    {
        $this->db->distinct($val);
        return $this;
    }
    
    function with($relation, $attributes = array())
    {        
        $relations = $this->_relations();
        
        $data = $relations[$relation];
        
        $relation_model = $data[1];
        $relation_table = $this->$relation_model->table;
        $relation_pk = $this->$relation_model->primary_key;
        $relation_fk = $data[2];
        
        $this->relation_object = $data[3];
        $this->relation_prefix = $relation .'_prefix_';
        $this->relation_entity = $this->$relation_model->entity;
        
        $this->$relation_model->_get_attributes();
        
        // определяем нужные аттрибуты
        $attrs = empty($attributes) ? $this->$relation_model->attributes : $attributes;
        $attributes = array();
        if( $attrs )
        {
            foreach($attrs as $attr)
            {
                $attributes[] = $relation_table .'.'. $attr .' AS '. $this->relation_prefix . $attr;
            }
        }
        
        $this->select($this->table.'.*');
        $this->select(implode(', ', $attributes));
        $this->db->join($relation_table, "$relation_table.$relation_pk = $this->table.$relation_fk");

        return $this;
    }
    
    function _create_object($item)
    {
        return new $this->entity($item, $this->relation_object, $this->relation_prefix, $this->relation_entity);
    }

    function get_all()
    {
        $query = $this->db->get($this->table);
        
        if( class_exists($this->entity) )
        {
            if( $query->num_rows() > 0 )
            {
                $items = array();
                
                foreach($query->result() as $item)
                {
                    $items[] = $this->_create_object($item);
                }
                
                return $items;
            }
            else
            {
                return FALSE;
            }
        }
        else
        {
            return $query->num_rows() > 0 ? $query->result() : FALSE;
        }
    }

    function get_all_as_array()
    {
        $query = $this->db->get($this->table);
        return $query->num_rows() > 0 ? $query->result_array() : FALSE;
    }

    function get_one()
    {
        $query = $this->db->get($this->table);
        
        if( $query->num_rows() == 1 )
        {            
            if( class_exists($this->entity) )
            {
                return $this->_create_object($query->row());
            }
            else
            {
                return $query->row();
            }
        }
        else
        {
            return FALSE;
        }
        
        return $query->num_rows() == 1 ? $query->row() : FALSE;
    }

    function get_many_by($field, $value)
    {
        $this->db->where($field, $value);
        return $this->db->get($this->table);
    }

    function get_by_id($id)
    {
        $this->db->where($this->table.'.'.$this->primary_key, $id);
        $query = $this->db->get($this->table);

        if( $query->num_rows() == 1 )
        {
            if( class_exists($this->entity) )
            {
                return $this->_create_object($query->row());
            }
            else
            {
                return $query->row();
            }
        }
        else
        {
            return FALSE;
        }

        return $query->num_rows() == 1 ? $query->row() : FALSE;
    }

    function count()
    {
        return $this->db->count_all_results($this->table);
    }

    function where($key, $value = FALSE, $escape = TRUE)
    {
        if($value !== FALSE)
        {
            $this->db->where($key, $value, $escape);
        }
        else
        {
            $this->db->where($key);
        }

        return $this;
    }

    function or_where($key, $value = NULL, $escape = TRUE)
	{
		$this->db->or_where($key, $value, $escape);
        return $this;
	}

    function where_in($field, $array_values)
    {
        $this->db->where_in($field, $array_values);
        return $this;
    }

    function where_not_in($field, $array_values)
    {
        $this->db->where_not_in($field, $array_values);
        return $this;
    }

    function like($field, $value = false, $mode = 'both')
    {
        if($value !== false)
        {
            $this->db->like($field, $value, $mode);
        }
        else
        {
            $this->db->like($field);
        }

        return $this;
    }

    function group_by($field)
    {
        $this->db->group_by($field);
        
        return $this;
    }

    function order_by($field, $direction = '')
    {
        $this->db->order_by($field, $direction);
        
        return $this;
    }

    function limit($limit, $offset = '')
    {
        $this->db->limit($limit, $offset);
        
        return $this;
    }

    function offset($offset)
    {
        $this->db->offset($offset);
        
        return $this;
    }

    function set($key, $value = '', $escape = true)
    {
        $this->db->set($key, $value, $escape);
        
        return $this;
    }

    function select($select, $protect = true)
    {
        $this->db->select($select, $protect);
        
        return $this;
    }

    function insert($data = false)
    {
        if($data)
        {
            $this->db->insert($this->table, $data);
        }
        else
        {
            $this->db->insert($this->table);
        }

        return $this->db->insert_id();
    }

    function update($data = array())
    {
        return $this->db->update($this->table, $data);
    }

    function update_by_id($id, $data = array())
    {
        $this->where($this->primary_key, $id);
        return $this->update($data);
    }

    function delete()
    {
        return $this->db->delete($this->table);
    }
    
    function set_table($table)
    {
        $this->table = $table;
        return $this;
    }
    
    function get_table()
    {
        return $this->table;
    }
    
    function count_new()
    {
        return false;
    }
    
    /**
     * Проверяем существует ли такой файл модели
     */
    static function file_exists($module, $model = false)
    {
        $model = $model ? $model : $module .'_m';
        
        if( class_exists($model) )
        {
            return TRUE;
        }
        
        if( file_exists(APPPATH.'models/'. $model .EXT) )
        {
            return TRUE;
        }
        
        $modules_location = key(CI::$APP->config->item('modules_locations'));
        if( file_exists( $modules_location . $module .'/models/' . $model . EXT ) )
        {
            return TRUE;
        }
        
        return FALSE;
    }
    
    function __call($method, $args)
    {
        if( strstr($method, 'by_') )
        {
            $key = str_replace('by_', '', $method);
            $this->where($key, $args[0]);
            return $this;
        }
        
        if( strstr($method, 'set_') )
        {
            $key = str_replace('set_', '', $method);
            $this->set($key, $args[0]);
            return $this;
        }
        
        show_error('Function '. $method .'() not exists');
    }
    
    function prefix($table)
    {
        return $this->db->dbprefix($table);
    }
}