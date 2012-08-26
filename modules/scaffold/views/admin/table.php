<div class="page-header">
    <ul class="header-actions">
        <li>
            <?=URL::anchor(
                'admin/scaffold', 
                'Список', 
                array(
                    'class'=>'btn btn-primary'
                )
            )?>
        </li>
    </ul>

    <h3>
        Таблица <?php echo $table?>
    </h3>
</div>         

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

    <h3>Записи (<?php echo $total?>)</h3>
</div>
        
<?php if( $rows ):?>
    <?php HTML\Table::display(array(
            'view'=>'_row',
            'items'=>$rows,
            'headings'=>$fields_headings
        ))?>
<?php else:?>
    <p>Нет записей</p>
<?php endif;?>