<div class="page-header">
    <h2>Регистрация</h2>
</div>

<?php $this->alert->display()?>

<?php HTML\Form::display(array(
    'attr'=>array(
        'class'=>'form-horizontal'
    ),
    'inputs'=>array(
        array(
            'type'=>'text',
            'label'=>'Логин',
            'name'=>'login',
            'value'=>set_value('login')
        ),
        array(
            'type'=>'text',
            'label'=>'Почта',
            'name'=>'email',
            'value'=>set_value('email')
        ),
        array(
            'type'=>'password',
            'label'=>'Пароль',
            'name'=>'password',
            'value'=>''
        ),
        array(
            'type'=>'password',
            'label'=>'Повтор пароля',
            'name'=>'password_retype',
            'value'=>''
        ),
        array(
            'type'=>'submit',
            'value'=>'Зарегистрироваться',
            'name'=>'submit',
            'extra'=>' '.URL::anchor('users/login', 'Войти', array('class'=>'btn'))
        )
    )
))?>