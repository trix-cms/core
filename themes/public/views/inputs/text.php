<div class="control-group">
    <label class="control-label" for="">
        <?php echo $label?>:
    </label>
    <div class="controls">
        <input 
            type="text" 
            name="<?php echo $name?>" 
            value="<?php echo $value?>" 
            <?php echo HTML::parse_attributes($attr)?>
            data-title="<?php echo $help?>"
        />
    </div>
</div>