<div class="control-group">
    <label class="control-label" for="">
        <?php echo $label?>:
    </label>
    <div class="controls">
        <?php if( isset($file) ):?>
            <div>
                <?php echo $file?>
            </div>
        <?php endif;?>
        <input type="file" name="<?php echo $name?>" />
        <?php if($help):?>
            <p class="help-block"><?php echo $help?></p>
        <?php endif;?>
    </div>
</div>