<div class="page-header">
    <ul class="header-actions">
        <li>
            <?=URL::anchor(
                'admin/users',
                'Список',
                array(
                    'class'=>'btn btn-primary'
                )
            )?>
        </li>
    </ul>

    <h3>
        Редактирование пользователя #<?php echo $item->id .' '.$item->login?>
    </h3>
</div>

<?php echo Decorator::form_view(array(
        'attr'=>array(
            'class'=>'form-horizontal'
        ),
        'inputs'=>array(
            array(
                'type'=>'text',
                'label'=>'Логин',
                'name'=>'login',
                'value'=>$item ? $item->login : set_value('login'),
            ),
            array(
                'type'=>'text',
                'label'=>'Почта',
                'name'=>'email',
                'value'=>$item ? $item->email : set_value('email'),
            ),
            array(
                'type'=>'select',
                'label'=>'Группа',
                'name'=>'group_slug',
                'value'=>$groups_options
            ),
            array(
                'type'=>'submit',
                'name'=>'submit',
                'value'=>'Сохранить',
                'attr'=>array('type'=>'submit', 'value'=>' '),
                'extra'=> ' '. URL::anchor('admin/users', 'Обратно', array('class'=>'btn'))
            )
        )
    ))?>