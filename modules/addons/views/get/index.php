<?php if( $items ):?>
    <?php HTML\Table::display(array(
        'headings'=>array(
            'Название',
            'Описание',
            'Версия',
            'Действия'
        ),
        'items'=>$items,
        'view'=>'get/_item'
    ))?>
<?php else:?>
    <p>Дополнения не найдены</p>
<?php endif?>