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
        Редактирование пользователя
    </h3>
</div>

<?php echo Decorator::form_view(array(
        'attr'=>array(
            'class'=>'form-horizontal'
        ),
        'inputs'=>array(
            array(
                'type'=>'text',
                'label'=>'ID',
                'name'=>'id',
                'value'=>$item ? $item->id : '',
                'visibility'=>$item,
                'attr'=>array(
                    'disabled'=>'disabled',
                    'style'=>'width: 30px; text-align: center;'
                )
            ),
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
                'options'=>$groups_options,
                'value'=>$item ? $item->group_slug : set_value('group_slug'),
                'attr'=>array(
                    $item->id == $this->user->id ? 'disabled' : 'enabled'=>''
                )
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