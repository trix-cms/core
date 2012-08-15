<tr>
    <td style="width: 10px; text-align: center">
        <?=$item->id?>
    </td>
    <td style="text-align: left;">
        <?php echo URL::anchor('admin/news/edit/'. $item->id, $item->title)?>
    </td>
    <td style="width: 150px;">
        <?php echo $item->date?>
    </td>
    <td style="width: 100px; text-align: center;">
    	<ul class="actions">
    		<li>
                <?php echo $item->url(
                    'view',
                    array(
                        'class'=>'view',
                        'target'=>'_blank',
                        'rel'=>'tooltip',
                        'data-title'=>'Просмотр новости'
                    )
                )?>
            </li>
    		<li>
                <?php echo URL::anchor(
                    'admin/news/edit/'. $item->id, 
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
                    'admin/news/delete/'. $item->id, 
                    'edit',
                    array(
                        'class'=>'delete ajax-delete confirm',
                        'data-confirm'=>'Удалить?',
                        'rel'=>'tooltip',
                        'data-title'=>'Удалить'
                    )
                )?>
            </li>
    	</ul>
    </td>
</tr>