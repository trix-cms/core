<div class="control-group">
    <label 
        for="<?php echo $item->slug?>" 
        class="control-label"
    >
        <?php echo $item->title?>
    </label>
    <div class="controls">
        <div 
            style="display: inline-block;"
            rel="tooltip"
            data-title="<?php echo $item->description?>"
            data-placement="right"
            data-target="focus"
        >
            <?php $this->load->view('settings::_form_item', array(
                'setting'=>$item
            ), FALSE)?>
        </div>
    </div>
</div>