<?php if( $setting->type == 'text' ):?>

		<input type="text" class="medium" id="<?php echo $setting->slug?>" value="<?php echo $setting->value?>" name="<?php echo $setting->slug?>" />
    
<?php elseif( $setting->type == 'textarea' ):?>

    <textarea name="<?php echo $setting->slug?>" class="large" rows="5"><?php echo $setting->value?></textarea>
    
<?php elseif( $setting->type == 'radio' ):?>

    <?php $options = explode('|', $setting->options)?>
    <?php foreach($options as $option):?>
        <?php list($op_value, $op_title) = explode('=', $option);
              $selected = $op_value == $setting->value ? ' checked="checked"' : '';
        ?>
        <input type="radio" class="radio" name="<?php echo $setting->slug?>" value="<?php echo $op_value?>" <?php echo $selected?>/> <label><?php echo $op_title?></label>
    <?php endforeach;?>

<?php elseif( $setting->type == 'select' ):?>

    <?php $options = explode('|', $setting->options)?>
    <select name="<?php echo $setting->slug?>">
        <?php foreach($options as $option):?>
            <?php list($op_value, $op_title) = explode('=', $option); 
                  $selected = $op_value == $setting->value ? ' selected="selected"' : '';
            ?>
            <option value="<?php echo $op_value?>"<?php echo $selected?>><?php echo $op_title?></option>
        <?php endforeach;?>
    </select>

<?php endif?> 