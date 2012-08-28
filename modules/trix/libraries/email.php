<?php

namespace Trix;

use CI;

class Email extends \CI_Email {
    
    private $template = false;  // шаблон письма
    private $data = array();    // данные для шаблона письма

    /**
     *  Функция нужна, чтобы текст оставался в оригинальном
     *  виде, а изначальная функция добавляет разные служебные символы
     */
    function subject($subject)
	{
	    $this->_set_header('RawSubject', $subject);

		$subject = $this->_prep_q_encoding($subject);
		$this->_set_header('Subject', $subject);
        return $this;
	}
    
    /**
     * Устанавливает тему для шаблона
     */
    function template($template)
    {
         $this->template = $template;
         return $this;
    }
    
    /**
     * Данные для шаблона
     */
    function data($data)
    {
        $this->data = $data;
        return $this;
    }
    
    /**
     * Формирует сообщение из шаблона
     */
    function _message_from_template()
    {
        // загружаем парсер
        CI::$APP->load->library('parser');
        
        // парсим сообщение
        $message = CI::$APP->parser->parse_string($this->template, $this->data, TRUE);
        
        // устанавливаем сообщение
        $this->message($message);
    }
    
    /**
     * Отправка письма
     */
    function send()
    {
        if( $this->template )
        {
            $this->_message_from_template();
        }
        
        return parent::send();
    }
}