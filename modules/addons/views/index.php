<?php if( $items ):?>
    <?php HTML\Table::display(array(
        'headings'=>array(
            'Название',
            'Описание',
            'Версия',
            'Автор'
        ),
        'items'=>$items,
        'view'=>'_item'
    ))?>
<?php else:?>
    <p>Нет дополнений</p>
<?php endif?>