<div class="control-group">
    <label class="control-label" for="">
        <?php echo $label?>:
    </label>
    <div class="controls">
        <select name="<?php echo $name?>">
            <?php echo HTML::options($options, $default)?>
        </select>
    </div>
</div>