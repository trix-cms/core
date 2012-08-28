<tr>
    <td style="text-align: center; width: 10px;">
        <?=$item->id?>
    </td>
    <td>
        <?php if( $item->id != 0 ):?>
            <?php echo URL::anchor(
                'admin/users/profile/view/'. $item->id, 
                $item->login ? $item->login : '<strong><i>Имя не указано</i></strong>', 
                'class="contacts-user" title="#'. $item->id .'"'
            )?>
        <?php else:?>
            <?=$item->login?>
        <?php endif?>        
    </td>
    <td>
        <?=Users\Groups::label($item->group_slug)?>
    </td>
    <td>
        <?=$item->email?>
    </td>
    <td>
        <?php echo \Trix\Date::nice($item->register_date)?>
    </td>
    <td style="text-align: center; width: 10px;">
        <?php if( $item->id != 0 ):?>
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
                
                <?php if( $item->group_slug != 'admins' ):?>
                    <li>
                        <?=URL::anchor(
                            'admin/users/delete/'. $item->id, 
                            'Удалить', 
                            array(
                                'class'=>'delete confirm ajax-delete',
                                'rel'=>'tooltip',
                                'data-confirm'=>'Удалить пользователя '. $item->login .'?',
                                'data-title'=>'Удалить'
                            )
                        )?>
                    </li>
                <?php endif;?>
            </ul>
        <?php endif;?>
    </td>
</tr>