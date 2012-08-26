<div class="page-header">
    <ul class="header-actions">
        <li>
            <?=URL::anchor(
                'admin/scaffold/row_create/'. $table, 
                'Создать', 
                array(
                    'class'=>'btn btn-primary'
                )
            )?>
        </li>
    </ul>

    <h3>Записи ()</h3>
</div>

<div style="overflow-x: scroll;">
    <table class="table table-bordered" class="scaffold-table">
    	<thead>
    		<tr>
                <?php foreach($headings as $item):?>
                    <th><?php echo $item?></th>
                <?php endforeach;?>
    		</tr>
    	</thead>
    	<tbody>
            <?php if( $items ):?>
                <?php HTML\TList::display(array(
                    'template'=>$view,
                    'items'=>$items
                )) ?>
            <?php else:?>
            
            <?php endif;?>
        </tbody>
    </table>

    <?php isset($pagination) ? $pagination->display() : ''?>
</div>