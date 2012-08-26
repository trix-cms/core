<div class="control-group">
    <label class="control-label" for="">
        <?php echo $label?>:
    </label>
    <div class="controls">
        <?php foreach($items as $item):?>
            <label class="checkbox">
                <input type="checkbox" name="<?php echo $item['name']?>" />
                <?php echo $item['label']?>
            </label>
        <?php endforeach;?>
        <?php if(isset($help)):?>
            <p class="help-block"><?php echo $help?></p>
        <?php endif;?>
    </div>
</div>