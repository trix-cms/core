<tr>
    <td style="text-align: left;">
        <?php echo str_repeat('&nbsp;&nbsp;&mdash;&nbsp;&nbsp;', $item->level - 1). $item->title?>
    </td>
    <td>
    	<ul class="actions">
    		<li>
                <?php echo URL::anchor(
                    'admin/categories/edit/'. $item->id, 
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
                    'admin/categories/delete/'. $item->id, 
                    'edit',
                    array(
                        'class'=>'delete confirm ajax-delete',
                        'rel'=>'tooltip',
                        'data-title'=>'Удалить',
                        'data-confirm'=>'Удалить?'
                    )
                )?>
            </li>
    	</ul>
    </td>
</tr>