<tr>
    <td style="padding: 1px; width: 45px;">
        <?=URL::anchor(
            'admin/users/edit/'. $item->id, 
            HTML::image($item->avatar_url, array(
                'width'=>45,
                'class'=>'avatar-image'
            ))
        )?>
    </td>
    <td style="border-left: none">
        <span style="float: right;">
            <?php echo Date::nice($item->register_date)?>
        </span>
        
        <div style="margin-bottom: 10px;">
            <?php echo URL::anchor(
                'admin/users/profile/view/'. $item->id, 
                $item->login ? $item->login : '<strong><i>Имя не указано</i></strong>', 
                'class="contacts-user" title="#'. $item->id .'"'
            )?>
            <br />
            <?=$item->email?>
        </div>
        <div style="float: right">
            <div class="btn-group">
                <?php if( TRUE ):?>
                    <?=URL::anchor(
                        'admin/users/moderated/'. $item->id, 
                        'Отметить проверянным', 
                        'class="btn"'
                    )?>
                <?php endif;?>

                <?php echo URL::anchor(
                    'admin/users/edit/'. $item->id, 
                    'Редактировать',
                    'class="btn"'
                )?>
                
                <?php if( $item->group_slug != 'admins' AND !$item->is_deleted ):?>
                    <?=URL::anchor(
                        'admin/users/delete/'. $item->id, 
                        'Удалить', 
                        'class="btn"'
                    )?>
                <?php endif;?>
            </div>
        </div>
    </td>
</tr>