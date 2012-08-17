<?php

namespace Scaffold;

class Helper {
    
    static function field_style($field)
    {
        switch($field->type)
        {
            case 'varchar':
            case 'text':
                $style = 'style="text-align: left;"';
                break;
            
            case 'int':
            case 'tinyint':
                $style = 'style="text-align: right;"';
                break;
                
            default:
                $style = '';                
        }
        
        return $style;
    }
    
    static function generate_inputs($fields, $item)
    {
        $inputs = array();
        
        foreach($fields as $field)
        {
            $attr = $field->type == 'text' ? array('class'=>'medium', 'style'=>'height: 100px;') : '';
            
            $inputs[] = array(
                'type'=> $field->type == 'text' ? 'textarea' : 'text',
                'label'=>$field->name,
                'name'=>$field->name,
                'value'=>$item ? $item->{$field->name} : '',
                'attr'=>$attr
            );
        }
        
        $inputs[] = array(
            'type'=>'submit',
            'name'=>'submit',
            'value'=>$item ? 'Сохранить' : 'Создать',
            'extra'=> ' '
        );
        
        return $inputs;
    }
}