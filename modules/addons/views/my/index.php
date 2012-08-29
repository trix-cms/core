<div class="page-header">
    <ul class="header-actions">
        <li>
            <?=URL::anchor(
                'addons/my/add',
                'Добавить дополнение',
                array(
                    'class'=>'btn btn-primary'
                )
            )?>
        </li>
    </ul>
    
    <h3>Список</h3>
</div>

<?php $this->alert->display()?>

<?php if( $items ):?>
    <?php HTML\Table::display(array(
        'headings'=>array(
            'Название',
            'Описание',
            'Версия',
            'Действия'
        ),
        'items'=>$items,
        'view'=>'my/_item'
    ))?>
<?php else:?>
    <p>Нет дополнений</p>
<?php endif?>