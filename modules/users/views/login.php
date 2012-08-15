<p style="margin-bottom: 20px;">
    Для входа в свой аккаунт, введите Ваш регистрационный e-mail и пароль.
</p>

<form action="" method="post" class="form-horizontal">

	<div class="control-group">
        <label class="control-label" for="login">E-mail</label> 
        <div class="controls">
            <input type="text" value="<?php echo set_value('email')?>" name="email" />
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
        <input type="submit" class="btn btn-success" name="submit" value="Войти" style="width: 100px;" />
    </div>
</form>
</div>