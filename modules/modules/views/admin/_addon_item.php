<tr id="<?=str_replace('\\', '-', $item->slug)?>">
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
    <td style="width: 120px; text-align: center;">    
        <?php if( !isset($installed_modules[$item->slug . $item->author]) ):?>
            <a 
                href="#"
                class="download"
            >установить</a>     
        <?php else:?>
            <span class="label label-success">установлен</span>
        <?php endif?>  
    </td>
</tr>