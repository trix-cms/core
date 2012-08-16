<div class="page-header">
    <ul class="header-actions">
        <li>
            <?=URL::anchor(
                'admin/scaffold/row_create/'. $table, 
                'Создать запись', 
                array(
                    'class'=>'btn'
                )
            )?>
        </li>
    </ul>

    <h3>
        Таблица <?php echo $table?> - <?php echo $total?> запись(ей)
    </h3>
</div>         
        
<?php if( $rows ):?>
    <?php Decorator::table_view(array(
            'view'=>'admin/_row',
            'items'=>$rows,
            'headings'=>$fields_headings
        ))?>
<?php else:?>
    <p>Нет записей</p>
<?php endif;?>