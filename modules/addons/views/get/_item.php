<tr id="<?=$item->slug?>">
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
        <a 
            href="#"
            class="download"
        >установить</a>       
    </td>
</tr>