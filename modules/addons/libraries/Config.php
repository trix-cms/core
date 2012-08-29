<?php

namespace Addons;

class Config 
{
    const UPLOAD_PATH = 'uploads/addons/';
    
    static $upload_config = array(
        'upload_path'=>self::UPLOAD_PATH,
		'allowed_types'=>'zip',
        'encrypt_name'=>TRUE,
		//'max_size'=>'100000'
    );
    
    static $validation_rules = array(
        array(
            'field'=>'slug',
            'label'=>'Slug',
            'rules'=>'trim|required'
        ),
        array(
            'field'=>'version',
            'label'=>'Версия',
            'rules'=>'trim|required'
        ),
        array(
            'field'=>'name',
            'label'=>'Имя',
            'rules'=>'trim|required'
        ),
        array(
            'field'=>'description',
            'label'=>'Описание',
            'rules'=>'trim|required'
        ),
        array(
            'field'=>'type',
            'label'=>'Тип',
            'rules'=>'trim|required'
        ),
    );
}