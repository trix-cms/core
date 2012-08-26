<?php

namespace URL;

class Query {
    
    private $params = array();
    private $query;
    
    /**
     * mixed params массив или строка
     */
    function __construct($params = false)
    {
        if( $params )
        {
            $this->set($params);
        }
    }
    
    function set($params)
    {
        if( is_array($params) )
        {
            $this->params = array_merge($this->params, array_fill_keys($params, ''));
        }
        else
        {
            $this->params[$params] = '';
        }
        
        $this->_parseUrlQuery();
        
        return $this;
    }
    
    function _parseUrlQuery()
    {
        $uri = $_SERVER['REQUEST_URI'];
        
        // получаем параметры из ?p=1&q=2
        $this->query = parse_url($uri, PHP_URL_QUERY);
        
        // params =  array('p' => 1, 'q' => 2)
        parse_str($this->query, $params);

        // соединяем заданные параметры и полученные через строку
        $this->params = array_merge($this->params, $params);
    }
    
    function get($key)
    {
        return isset($this->params[$key]) ? $this->params[$key] : false;
    }
    
    /**
     * Генерит строку параметров
     * 
     * @param string имя параметра
     * @param string текущее значение
     */
    function generateUriQuery($paramKey, $paramValue)
    {
        $query = array();
        foreach($this->params as $key => $value)
        {
            if( $value OR $key == $paramKey )
            {
                if( $paramKey != $key OR ($paramKey == $key AND $paramValue) )
                {
                    $query[] = $key == $paramKey ? $paramKey.'='.$paramValue : $key.'='.$value;
                }
            }
        }
        
        return count($query) ? implode('&', array_filter($query)) : '';
    }
}