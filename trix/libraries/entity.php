<?php

abstract class Entity {
    
    function __construct($data, $object = false, $prefix = false, $entity = false)
    {
        foreach($data as $key => $value)
        {            
            // если есть вложенный объект
            if( $object AND strstr($key, $prefix) !== FALSE )
            {
                $object_data[str_replace($prefix, '', $key)] = $value;
            }
            else
            {
                $this->$key = $value;
            }
        }
        
        // создаем вложенный объект
        if( $object AND isset($object_data))
        {
            $this->$object = new $entity($object_data);
        }
    }

    /**
     * Методы можно вызывать Entity->method
     * Название метода должно быть Class::get_method()
     */
    function __get($name)
    {
        $method = 'get_'. $name;

        if( method_exists($this, $method) )
        {
            return $this->$method();
        }
        
        return $this->$name;
    }
}