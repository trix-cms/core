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
                <?php Decorator::list_view(array(
                    'template'=>$view,
                    'items'=>$items
                )) ?>
            <?php else:?>
            
            <?php endif;?>
        </tbody>
    </table>

    <?php isset($pagination) ? $pagination->display() : ''?>
</div>