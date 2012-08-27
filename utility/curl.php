<?php

class Curl extends Modules\AbstractModule
{
    /**
     * Имя модуля
     */
    public $name = 'Curl';
    
    /**
     * Имя модуля
     */
    public $description = 'Curl';
    
    /**
     * Имя на англ.
     */
    public $slug = 'utility/curl';
    
    /**
     * Версия
     */
    public $version = '1.0';
    
    /**
     * Является ли модуль утилитой
     */
    public $is_utility = 1;
    
    /**
     * Относится ли модуль к ядру
     */
    public $is_core = 0;
    
    /**
     * Работает ли в публичной части сайта
     */
    public $is_frontend = 0;
    
    /**
     * Автор
     */
    public $author = 'Phil Sturgeon';
}