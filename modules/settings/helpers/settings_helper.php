<?php

function theme_list($path, $current)
{
    $dirs = glob($path.'/*', GLOB_ONLYDIR);
    $ignore_list = array('admin');
    
    $themes = array();
    
    foreach($dirs as $dir)
    {
        $foo = pathinfo($dir, PATHINFO_BASENAME);
        
        if(!in_array($foo, $ignore_list))
        {
            $themes[] = $foo;
        }
    }
    
    return $themes;
}

function forms($setting)
{
    $form_control = '';

    switch($setting->type)
    {
        case 'text':
            $form_control = '<p><label title="'.$setting->slug.'">'.$setting->title.'</label><input type="text" "class="text-input medium-input" value="'. $setting->value .'" name="'. $setting->slug .'" /><br /><small>'.$setting->description.'</small></p>';
            break;
        
        case 'textarea':
            $form_control = '<p><label title="'.$setting->slug.'">'.$setting->title.'</label><textarea cols="79" rows="8" id="textarea" name="'. $setting->slug .'" '. $setting->attr .'>'. $setting->value .'</textarea><br /><small>'.$setting->description.'</small></p>';
            break;

        case 'radio':
            $options = explode('|', $setting->options);
            
            $form_control = '<p><label title="'.$setting->slug.'">'.$setting->title.'</label>';

            $radio = array();
            foreach($options as $option)
            {
                list($op_value, $op_title) = explode('=', $option);
                $selected = ($op_value == $setting->value) ? ' checked="checked"' : '';
                
                $radio[] = '<input name="'.$setting->slug.'" value="'.$op_value.'"'.$selected.' type="radio"> '.$op_title;
            }
            $form_control .= implode('<br />', $radio);
            $form_control .= '<br /><small>'.$setting->description.'</small></p>';
            break;    
            
        case 'select':
            $options = explode('|', $setting->options);
            $form_control = '<p><label title="'.$setting->slug.'">'.$setting->title.'</label>';
            $form_control .= '<select name="'.$setting->slug.'">';
            foreach($options as $option)
            {
                list($op_value, $op_title) = explode('=', $option);
                
                $selected = $op_value == $setting->value ? ' selected="selected"' : '';
                
                $form_control .= '<option value="'.$op_value.'"'.$selected.'>'.$op_title.'</option>';
            }
            $form_control .= '</select>';
            break;
            
        default:
            echo 'error';     
    }

    return $form_control;
}