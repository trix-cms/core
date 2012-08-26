<?php if($modules):?>
    <div class="page-header">
        <ul class="header-actions">
            <li>
                <?=URL::anchor(
                    'admin/modules/install',
                    'Установить',
                    array(
                        'class'=>'btn btn-primary'
                    )
                )?>
            </li>
        </ul>
    
        <h3>Дополнительные</h3>
    </div>
    
   <?php HTML\Table::display(array(
        'view'=>'_row',
        'items'=>$modules,
        'headings'=>array(
            'Название',
            'Описание',
            'Статус',
            'Действия'
        )
    ))?>
<?php endif;?>

<div class="page-header">
    <h3>Основные модули</h3>
</div>

<?php HTML\Table::display(array(
    'view'=>'_row',
    'items'=>$core_modules,
    'headings'=>array(
        'Название',
        'Описание',
        'Статус',
        'Действия'
    )
))?>