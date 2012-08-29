<tr id="<?=$item->id?>">
    <td>
        <?=URL::anchor(
            'addons/view/'. $item->class,
            $item->name   
        )?>
    </td>
    <td>
        <?=$item->desc?>
    </td>
    <td style="text-align: center; width: 50px;">
        <?=$item->version?>
    </td>
    <td style="width: 120px; text-align: center;">     
        <?php if( !isset($installed_modules[$item->class . $item->author]) ):?>
            <a
                href="#"
                class="download"
            >установить</a>     
        <?php else:?>        
            <?php if( $item->version != $installed_modules[$item->class . $item->author]->version ):?>
                <a 
                    href="#"
                    class="update"
                    style="text-decoration: none;"
                ><span class="label label-warning">обновить</span></a>
            <?php else:?>
                <span class="label label-success">установлен</span>
            <?php endif?>
        <?php endif?>  
    </td>
</tr>