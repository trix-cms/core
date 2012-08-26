<div class="page-header">
    <ul class="header-actions">
        <li>
            <?=URL::anchor(
                'users/admin/groups',
                'Список',
                array(
                    'class'=>'btn btn-primary'
                )
            )?> 
        </li>
    </ul>

    <h3>Создание</h3>
</div>

<?php HTML\Form::display(array(
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
            'name'=>'submit',
            'extra'=>' '. URL::anchor('users/admin/groups', 'Обратно', array('class'=>'btn'))
        )
    )
))?>