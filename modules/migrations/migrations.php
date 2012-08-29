<?php

class Migrations extends Modules\AbstractModule
{
    /**
     * Имя модуля
     */
    public $name = 'Миграции';
    
    /**
     * Имя модуля
     */
    public $description = 'Модуль для добавления, удаления и других операций с модулями.';
    
    /**
     * Имя на англ.
     */
    public $class = 'Migrations';   
    
    /**
     * Ссылка
     */
    public $class = 'migrations';  
    
    /**
     * Версия
     */
    public $version = '0.1.1';
    
    /**
     * Является ли модуль утилитой
     */
    public $is_utility = 0;
    
    /**
     * Является ли вспомогательным модулем
     */
    public $is_helper = 0;
    
    /**
     * Относится ли модуль к ядру
     */
    public $is_core = 1;
    
    /**
     * Работает ли в публичной части сайта
     */
    public $is_frontend = 0;
    
    /**
     * Работает ли в административной части сайта
     */
    public $is_backend = 1;
    
    /**
     * Автор
     */
    public $author = 'Trix';
}