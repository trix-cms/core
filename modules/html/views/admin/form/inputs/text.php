<div class="control-group">
    <label class="control-label" for="">
        <?php echo $label?>:
    </label>
    <div class="controls">
        <input type="text" name="<?php echo $name?>" value="<?php echo $value?>" <?php echo HTML\Tag::parse_attributes($attr)?> />
        <?php if($help):?>
            <p class="help-block"><?php echo $help?></p>
        <?php endif;?>
    </div>
</div>