<div class="control-group">
    <label class="control-label" for="">
        <?php echo $label?>:
    </label>
    <div class="controls">
        <select name="<?php echo $name?>" <?=isset($attr) ? Tag::parse_attributes($attr) : ''?>>
            <?php echo HTML::options($options, $value)?>
        </select>
    </div>
</div>