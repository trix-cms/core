<tr>
    <td>
    	<a class="toggle-table-switch" href="#" title="Show options" rel="tooltip">Options</a>
    	<ul class="table-switch" style="display: none; ">
    	</ul>
    </td>
    <td style="text-align: left;"><?php echo $item->title?></td>
    <td><span class="tag <?php echo $item->enable ? 'green' : 'gray'?>"><?php echo $item->enable ? 'On' : 'Off'?></span></td>
    <td>
    	<ul class="actions">
    		<li>
                <?php echo URL::anchor('', 'view', 'class="view" target="_blank" title="View item" rel="tooltip"')?>
            </li>
    		<li><?php echo URL::anchor('', 'edit', 'class="edit" title="Edit Item" rel="tooltip"')?></li>
    		<li><?php echo URL::anchor('', 'edit', 'class="delete" title="Delete Item" rel="tooltip"')?></li>
    	</ul>
    </td>
</tr>