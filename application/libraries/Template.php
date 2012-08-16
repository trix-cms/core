<?php

class Template {

    public $theme = '';
    public $layout = array();
    private $layout_number = 0;

    private $data = array();
    
    private $meta = array();

    function __construct()
    {
        // загружаем конфиг
        CI::$APP->load->config('template');
        
        // устанавливаем тему
        $this->set_theme(CI::$APP->config->item('theme'));
        
        // устанавливаем лейаут
        $this->set_layout(CI::$APP->config->item('layout'));
    }
    
    /**
     * Добавляем метаданные
     */
    function append_metadata($data)
    {
        $this->meta[] = $data;
        return $this;
    }

    /**
     * Вывод метаданных
     */
    function metadata()
    {
        return implode("\n", $this->meta);
    }
    
    /**
     * Присвоение значений переменной для использования в шаблоне
     */
    function set($name, $data)
    {
        $this->data[$name] = $data;
        return $this;
    }
    
    /**
     * Вывод шаблона
     */
    function render($view, $data = array())
    {        
        // файл вида
        $this->view = $view;
        
        // данные
        $this->data = array_merge($this->data, $data);
        
        // загружаем контент
        $this->data['content'] = CI::$APP->load->view($this->view, $this->data, TRUE);
        
        // загружаем весь шаблон
        CI::$APP->load->view($this->layout[0], $this->data);
    }

    /**
     * Установка шаблона
     */
    function set_layout($layout)
    {
        array_unshift($this->layout, $layout);
        return $this;
    }

    /**
     * Установка темы
     */
    function set_theme($theme)
    {
        $this->theme = $theme;
        return $this;
    }
    
    /**
     * Начало вложенного шаблона
     */
    function begin_content()
    {
        ob_start();
        $this->layout_number++;
    }
    
    /**
     * Завершение вложенного шаблона
     */
    function end_content()
    {
        $this->data['content'] = ob_get_contents();
        ob_clean();
        
        CI::$APP->load->view($this->layout[$this->layout_number], $this->data);
    }
}