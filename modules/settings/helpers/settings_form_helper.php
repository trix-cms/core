<?php

function theme_options($path, $current)
{
    $result = '';
    
    $dirs = glob($path.'/*', GLOB_ONLYDIR);
    
    foreach($dirs as $dir)
    {
        $foo = pathinfo($dir, PATHINFO_BASENAME);

        if($foo != 'admin' AND $foo != 'wiki')
        {
            $selected = $current == $foo ? ' selected="selected"' : '';
            
            $result .= '<option value="'.$foo.'"'.$selected.'>'.$foo.'</option>';
        }
    }
    
    return $result;
}


function theme_list($path, $current)
{
    $dirs = glob($path.'/*', GLOB_ONLYDIR);
    $ignore_list = array('admin', 'old_admin', 'new_admin', 'wiki');
    
    foreach($dirs as $dir)
    {
        $foo = pathinfo($dir, PATHINFO_BASENAME);
        
        $active = $foo == $current ? ' border: 4px solid lime;;' : '';
        
        if(!in_array($foo, $ignore_list)):
            ?>
            <div style="display: inline-block; margin: 0 10px;">
                <img width="250" style="border: 1px solid #aaa; <?php echo $active?>" height="250" src="<?php echo URL::site_url($dir.'/screenshot.png')?>" alt="<?php echo $dir?>" />
                <div style="text-align: left; margin-top: 4px">
                    <?php echo $foo?>
                    <span style="float: right;">
                    <?php if($foo == $current):?>
                        Активна
                    <?php else:?>
                        <?php echo URL::anchor('admin/settings/set_theme/'.$foo, 'Активировать')?>
                    <?php endif;?>
                    </span>
                </div>
            </div>
            <?php
        endif;
    }
}



function form_control_2($setting)
{
    $form_control = '';

    switch($setting['type'])
    {
        case 'text':
            $form_control = '<p><label title="'.$setting['slug'].'">'.$setting['title'].'</label><input type="text" "class="text-input medium-input" value="'. $setting['value'] .'" name="'. $setting['slug'] .'" /><br /><small>'.$setting['description'].'</small></p>';
            break;
        
        case 'textarea':
            $form_control = '<p><label title="'.$setting['slug'].'">'.$setting['title'].'</label><textarea cols="79" rows="8" id="textarea" name="'. $setting['slug'] .'">'. $setting['value'] .'</textarea><br /><small>'.$setting['description'].'</small></p>';
            break;

        case 'radio':
            $options = explode('|', $setting['options']);
            
            $form_control = '<p><label title="'.$setting['slug'].'">'.$setting['title'].'</label>';

            $radio = array();
            foreach($options as $option)
            {
                list($op_value, $op_title) = explode('=', $option);
                $selected = ($op_value == $setting['value']) ? ' checked="checked"' : '';
                
                $radio[] = '<input name="'.$setting['slug'].'" value="'.$op_value.'"'.$selected.' type="radio"> '.$op_title;
            }
            $form_control .= implode('<br />', $radio);
            $form_control .= '<br /><small>'.$setting['description'].'</small></p>';
            break;    
            
        case 'select':
            $options = explode('|', $setting['options']);
            $form_control .= '';
            $form_control .= '<select name="'.$setting['slug'].'">';
            foreach($options as $option)
            {
                list($op_value, $op_title) = explode('=', $option);
                
                $selected = $op_value == $setting['value'] ? ' selected="selected"' : '';
                
                $form_control .= '<option value="'.$op_value.'"'.$selected.'>'.$op_title.'</option>';
            }
            $form_control .= '</select>';
            break;
            
        default:
            echo 'error';     
    }

    return $form_control;
}

function form_control($setting)
{
    $form_control = '';

    switch($setting['type'])
    {
        case 'text':
            $form_control = '<input id="'. $setting['slug'] .'" type="text" value="'. $setting['value'] .'" name="'. $setting['slug'] .'" />';
            break;
        
        case 'textarea':
            $form_control = '<textarea name="'. $setting['slug'] .'" '.$setting['attr'].'>'. $setting['value'] .'</textarea>';
            break;

        case 'radio':
            $options = explode('|', $setting['options']);
            foreach($options as $option)
            {
                list($op_value, $op_title) = explode('=', $option);
                
                $selected = $op_value == $setting['value'] ? ' checked="checked"' : '';
                
                $form_control .= '<input type="radio" class="radio" name="'. $setting['slug'] .'" value="'. $op_value .'"'.$selected.' /> <label>'. $op_title .'</label> ';
            }
            break;    
            
        case 'select':
            $options = explode('|', $setting['options']);
            $form_control .= '';
            $form_control .= '<select name="'.$setting['slug'].'">';
            foreach($options as $option)
            {
                list($op_value, $op_title) = explode('=', $option);
                
                $selected = $op_value == $setting['value'] ? ' selected="selected"' : '';
                
                $form_control .= '<option value="'.$op_value.'"'.$selected.'>'.$op_title.'</option>';
            }
            $form_control .= '</select>';
            break;
            
        default:
            echo 'error';     
    }

    return $form_control;
}