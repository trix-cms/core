<tr>
    <td style="width: 5px; text-align: center;">
        <?=$item->id?>
    </td>
    <td>
        <?=URL::anchor(
            'admin/page/edit/'. $item->id,
            $item->title
        )?>
    </td>
    <td>
        <?=URL::anchor(
            $item->full_url, 
            $item->full_url . '', 
            array(
                'target'=>'_blank'
            )
        )?> <i class="icon-external-link"></i>
    </td>
    <td style="width: 10px; text-align: center;">
        <ul class="actions">
            <li>
                <?php echo URL::anchor(
                    'admin/page/edit/'. $item->id, 
                    ' ', 
                    array(
                        'class'=>'edit',
                        'rel'=>'tooltip',
                        'data-title'=>'Редактирование'
                    )
                )?>
            </li>
            <li>
                <?php echo URL::anchor(
                    'admin/page/delete/'. $item->id, 
                    ' ', 
                    array(
                        'class'=>'edit confirm delete ajax-delete',
                        'rel'=>'tooltip',
                        'data-confirm'=>'Удалить страницу &laquo;'. $item->title .'&raquo;?',
                        'data-title'=>'Удаление'
                    )
                )?>
            </li>
        </ul>
    </td>
</tr>