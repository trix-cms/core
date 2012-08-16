<tr>
    <td style="text-align: center; width: 10px;">
        <?=$item->id?>
    </td>
    <td>
        <?php echo URL::anchor(
            'admin/users/profile/view/'. $item->id, 
            $item->login ? $item->login : '<strong><i>Имя не указано</i></strong>', 
            'class="contacts-user" title="#'. $item->id .'"'
        )?>
    </td>
    <td>
        <?=Users_Groups::label($item->group_slug)?>
    </td>
    <td>
        <?=$item->email?>
    </td>
    <td>
        <?php echo Date::nice($item->register_date)?>
    </td>
    <td style="text-align: center; width: 10px;">
        <ul class="actions">            
            <li>
                <?php echo URL::anchor(
                    'admin/users/edit/'. $item->id, 
                    'Редактировать',
                    array(
                        'class'=>'edit',
                        'rel'=>'tooltip',
                        'data-title'=>'Редактировать'
                    )
                )?>
            </li>
            
            <?php if( $item->group_slug != 'admins' AND !$item->is_deleted ):?>
                <li>
                    <?=URL::anchor(
                        'admin/users/delete/'. $item->id, 
                        'Удалить', 
                        array(
                            'class'=>'delete'
                        )
                    )?>
                </li>
            <?php endif;?>
        </ul>
    </td>
</tr>