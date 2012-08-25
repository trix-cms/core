<tr>
    <td style="width: 10%;">
        <?=URL::anchor(
            'admin/'. $item->name,
            $item->title
        )?>
    </td>
    <td>
        <?=$item->description?>
    </td>
    <td style="width: 100px; text-align: center;">
        <?php if( $item->is_frontend ):?>
            <span class="label <?=$item->enable ? 'label-success' : 'label-important'?>">
                <?php echo $item->enable ? 'Включен' : 'Отключен'?>
            </span>
        <?php endif?>
    </td>
    <td style="width: 50px; text-align: center;">
    	<ul class="actions">
            <?php if( !$item->is_core ):?>
        		<li>
                    <?php echo URL::anchor(
                        '', 
                        'edit', 
                        array(
                            'class'=>'delete ajax-delete confirm',
                            'title'=>'Удалить',
                            'rel'=>'tooltip',
                            'confirm'=>'Удалить модуль?'
                        )
                    )?>
                </li>
            <?php endif?>
    	</ul>
    </td>
</tr>