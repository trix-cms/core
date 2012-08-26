<?php use HTML\HTML?>

<div class="control-group">
    <label class="control-label" for="">
        <?php echo $label?>:
    </label>
    <div class="controls">
        <?php echo Tag::textarea($name, $value, $attr)?>
    </div>
</div>