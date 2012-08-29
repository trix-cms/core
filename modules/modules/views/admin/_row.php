<tr id="<?=$item->slug?>">
    <td>
        <?php if( $item->is_backend ):?>
            <?=URL::anchor(
                'admin/'. strtolower($item->slug),
                $item->name
            )?>
        <?php else:?>
            <?=$item->name?>
        <?php endif?>
    </td>
    <td>
        <?=$item->description?>
    </td>
    <td style="width: 50px; text-align: center;">
        <?=$item->version?>
    </td>
    <td style="width: 80px; text-align: center;">  
        <?php if( $item->is_utility ):?>
            <span class="label label-info">утилита</span>
        <?php elseif( $item->is_helper):?>
            <span class="label label-warning">хелпер</span>
        <?php elseif( $item->is_frontend OR $item->is_backend ):?>
            <span class="label label-success">модуль</span>
        <?php endif?>        
    </td>
    <td style="width: 80px; text-align: center;">
        <?php if( $item->is_frontend ):?>
            <span class="module-enable label <?=$item->enable ? 'label-success' : 'label-important'?>">
                <?php echo $item->enable ? 'включен' : 'отключен'?>
            </span>
        <?php endif?>     
    </td>
    <td style="width: 50px; text-align: center;">
    	<ul class="actions">
            <?php if( !$item->is_core ):?>
        		<li>
                    <?php echo URL::anchor(
                        'admin/modules/uninstall/'. $item->id,
                        'edit', 
                        array(
                            'class'=>'delete ajax-delete confirm',
                            'title'=>'Удалить',
                            'rel'=>'tooltip',
                            'data-confirm'=>'Удалить модуль?'
                        )
                    )?>
                </li>
            <?php endif?>
    	</ul>
    </td>    
</tr>