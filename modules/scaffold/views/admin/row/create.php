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
                'admin/scaffold/table/'. $table, 
                'Список', 
                array(
                    'class'=>'btn btn-primary'
                )
            )?>
        </li>
    </ul>

    <h3>Создание записи</h3>
</div>

<?php echo HTML\Form::display(array(
    'attr'=>array(
        'class'=>'form-horizontal'
    ),
    'inputs'=>Scaffold\Helper::generate_inputs($fields, $item, $table)
))?>