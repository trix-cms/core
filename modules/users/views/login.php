<div class="page-header">
    <h2>Вход</h2>
</div>

<?php $this->alert->display()?>

<form action="" method="post" class="form-horizontal">

	<div class="control-group">
        <label class="control-label" for="login">Почта или логин</label> 
        <div class="controls">
            <input type="text" value="<?php echo set_value('credentials')?>" name="credentials" />
        </div>
    </div>
    
	<div class="control-group">
        <label class="control-label" for="password">Пароль</label>
        <div class="controls">
            <input type="password" value="" name="password" />
            <br />
            <?=URL::anchor('users/reset', 'Забыли пароль?', array('style'=>'margin-left: 115px;'))?>
        </div>
    </div>
    
    <div class="form-actions">
        <input type="submit" class="btn btn-primary" name="submit" value="Войти" style="width: 100px;" />
        <?=URL::anchor(
            'users/register',
            'Регистрация',
            array(
                'class'=>'btn'
            )
        )?>
    </div>
</form>
</div>