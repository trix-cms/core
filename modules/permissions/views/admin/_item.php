<li class="icon-arrow-right">
    <?php if($item->default):?>
        <?=$item->name?>
    <?php else:?>
        <?=URL::anchor(
            'admin/permissions/set/'. $item->slug,
            $item->name
        )?>
    <?php endif;?>
    
</li>