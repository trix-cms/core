<tr>
    <td>
        <?=$item->name?>
    </td>
    <td>
        <?=$item->slug?>
    </td>
    <td style="width: 50px; text-align: center;">
    	<ul class="actions">
            <?php if( !$item->default ):?>
        		<li>
                    <?php echo URL::anchor(
                        'users/admin/groups/edit/'. $item->slug, 
                        'edit',
                        array(
                            'class'=>'edit',
                            'rel'=>'tooltip',
                            'data-title'=>'Редактировать'
                        )
                    )?>
                </li>
        		<li>
                    <?php echo URL::anchor(
                        'users/admin/groups/delete/'. $item->slug, 
                        'edit',
                        array(
                            'class'=>'delete ajax-delete confirm',
                            'data-confirm'=>'Если в группе есть пользователи они будут перемещены в группу авторизованные пользователи. Удалить группу?',
                            'rel'=>'tooltip',
                            'data-title'=>'Удалить'
                        )
                    )?>
                </li>
            <?php endif;?>
    	</ul>
    </td>
</tr>