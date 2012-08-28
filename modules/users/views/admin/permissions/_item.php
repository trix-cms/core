<?php if( $i == 0 ):?>
    <tr>
        <td>
            Панель управления
        </td>
        <?php foreach($groups as $group):?>
            <td style="text-align: center;">
                <input 
                    type="checkbox"
                    name="groups[<?=$group->slug?>][has_backend_access]"
                    <?=(
                            isset($permissions[$group->slug]->has_backend_access) 
                            AND $permissions[$group->slug]->has_backend_access
                        )
                            ? ' checked="checked"' 
                            : ''
                    ?> 
                    
                    <?php if( $group->default ):?>
                        disabled="disabled"
                    <?php endif?>
                />
            </td>
        <?php endforeach?>
    </tr>
<?php else:?>
    <tr>
        <td>
            <?=$item->name?>
        </td>
        <?php foreach($groups as $group):?>
            <td style="text-align: center;">
                <input 
                    type="checkbox" 
                    name="groups[<?=$group->slug?>][modules][<?=$item->slug?>]"
                    <?=(
                            isset($permissions[$group->slug]->permissions[$item->slug]) 
                            AND $permissions[$group->slug]->permissions[$item->slug]
                        ) 
                            ? ' checked="checked"' 
                            : ''
                    ?> 
                    <?php if( $group->default ):?>
                        disabled="disabled"
                    <?php endif?>
                />
            </td>
        <?php endforeach?>
    </tr>
<?php endif?>

<?php /*
<li class="icon-arrow-right">
    <?php if($item->default):?>
        <?=$item->name?>
    <?php else:?>
        <?=URL::anchor(
            'users/admin/permissions/set/'. $item->slug,
            $item->name
        )?>
    <?php endif;?>
    
</li>
*/?>