<tr class="item">
    <td>
        <?=URL::anchor(
            'addons/view/'. $item->slug,
            $item->name            
        )?>
    </td>
    <td>
        <?=$item->desc?>
    </td>
    <td style="text-align: center; width: 50px;">
        <?=$item->version?>
    </td>
    <td style="width: 50px; text-align: center;">
        <ul class="actions">
            <li>
                <?=URL::anchor(
                    'addons/my/edit/'. $item->id,
                    '',
                    array(
                        'class'=>'edit',
                        'rel'=>'tooltip',
                        'data-title'=>'Редактировать'
                    )
                )?>
            </li>
            <li>
                <?=URL::anchor(
                    'addons/my/delete/'. $item->id,
                    '',
                    array(
                        'class'=>'delete ajax-delete confirm',
                        'rel'=>'tooltip',
                        'data-title'=>'Удалить',
                        'data-confirm'=>'Удалить дополнение?'
                    )
                )?>
            </li>
        </ul>
    </td>
</tr>