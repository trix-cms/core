<?php $current_version = Migrations\Helper::version($item)?>
<tr>
    <td style="width: 10px; text-align: right;">
        <?=$current_version?>
    </td>
    <td style="text-align: left;">
        <?php echo basename($item)?>
    </td>
    <td style="width: 100px; text-align: center;">
        <?php if( $version==$current_version ):?>
    	   <span class="label label-success">текущая</span>
        <?php elseif( $current_version > $version ):?>
            <?=URL::anchor(
                'admin/migrations/version/'. $current_version, 
                'обновить',
                array(
                    'rel'=>'tooltip',
                    'data-title'=>'Обновить до версии '. $current_version
                )
            )?>
        <?php else:?>
            <?=URL::anchor(
                'admin/migrations/version/'. $current_version, 
                'откатить',
                array(
                    'rel'=>'tooltip',
                    'data-title'=>'Откатить до версии '. $current_version
                )
            )?>
        <?php endif;?>
    </td>
</tr>