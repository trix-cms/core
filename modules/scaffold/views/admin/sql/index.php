<div class="page-header">
    <h3>SQL</h3>
</div>

<?php echo HTML\Form::display(array(
    'attr'=>array(
        'enctype'=>'multipart/form-data',
        'class'=>'form-horizontal'
    ),
    'inputs'=>array(
        array(
            'type'=>'textarea',
            'label'=>'Запрос',
            'name'=>'query',
            'value'=>set_value('query'),
            'attr'=>array('class'=>'medium', 'style'=>'height: 200px;')
        ),
        array(
            'type'=>'submit',
            'name'=>'submit',
            'value'=>'Выполнить запрос',
            'extra'=> ' '. URL::anchor('admin/scaffold', 'К списку таблиц', array('class'=>'btn'))
        )
    )
))?>