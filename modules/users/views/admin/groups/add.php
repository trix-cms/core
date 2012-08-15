<?php Decorator::form_view(array(
    'attr'=>array(
        'class'=>'form-horizontal'
    ),
    'inputs'=>array(
        array(
            'type'=>'text',
            'name'=>'name',
            'value'=>$group ? $group->name : set_value('name'),
            'label'=>'Название'
        ),
        array(
            'type'=>'text',
            'name'=>'slug',
            'value'=>$group ? $group->slug : set_value('slug'),
            'label'=>'Slug'
        ),
        array(
            'type'=>'submit',
            'value'=>'Сохранить',
            'name'=>'submit'
        )
    )
))?>