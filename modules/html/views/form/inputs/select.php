<div class="control-group">
    <label class="control-label" for="">
        <?php echo $label?>:
    </label>
    <div class="controls">
        <select name="<?php echo $name?>" <?=isset($attr) ? HTML\Tag::parse_attributes($attr) : ''?>>
            <?php echo HTML\Tag::options($options, $value)?>
        </select>
    </div>
</div>