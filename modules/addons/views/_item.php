<tr>
    <td>
        <?=URL::anchor(
            'addons/view/'. $item->id,
            $item->name            
        )?>
    </td>
    <td>
        <?=$item->desc?>
    </td>
    <td style="text-align: center; width: 50px;">
        <?=$item->version?>
    </td>
    <td>
        <?=$item->author?>
    </td>
</tr>