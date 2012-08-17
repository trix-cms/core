<tr>
    <td style="text-align: center; width: 50px;">
        <?php if( $primary_key ):?>
        <ul class="actions">
    		<li>
                <?php echo URL::anchor(
                    'admin/scaffold/row_edit/'. $table .'/'. $item->{$primary_key}, 
                    'edit', 
                    'class="edit" data-title="Редактировать запись" rel="tooltip"'
                )?>
            </li>
    		<li>
                <?php echo URL::anchor(
                    'admin/scaffold/row_delete/'. $table .'/'. $primary_key .'/'. $item->{$primary_key}, 
                    'edit', 
                    'class="delete confirm ajax-delete" data-confirm="Удалить запись?" data-title="Удалить запись" rel="tooltip"'
                )?>
            </li>
    	</ul>
        <?php else:?>
            Can't edit
        <?php endif;?>
    </td>
    
    <?php $k=0; foreach($item as $foo):?>
        <td <?php echo Scaffold\Helper::field_style($fields[$k])?>>
            <?php echo htmlspecialchars(Text::word_limiter($foo, 20, '...'))?>
        </td>
    <?php $k++; endforeach;?>
</tr>