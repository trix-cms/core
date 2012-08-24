<div class="page-header">
    <ul class="header-actions">
        <li>
            <?=URL::anchor(
                'admin/migrations',
                'Список',
                array(
                    'class'=>'btn btn-primary'
                )
            )?>
        </li>
    </ul>

    <h3>Создание миграции</h3>
</div>

<?php echo Decorator::form_view(array(
    'attr'=>array(
        'class'=>'form-horizontal'
    ),
    'inputs'=>array(
        array(
            'type'=>'text',
            'label'=>'Имя файла',
            'name'=>'name',
            'value'=> isset($page) ? $page->title : set_value('name'),
        ),
        array(
            'type'=>'submit',
            'name'=>'submit',
            'value'=>'Создать',
            'attr'=>array('type'=>'submit', 'value'=>' '),
            'extra'=> ' '. URL::anchor('admin/migrations', 'Обратно', array('class'=>'btn'))
        )
    )
))?>