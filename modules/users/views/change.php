<div class="alert alert-block alert-success">
    <p><strong>Вы успешно зарегистрированы!</strong> Вы можете поменять имя.</p>
</div>

<form action="" method="post" class="form-horizontal">
	<div class="control-group">
        <label class="control-label" for="login">Ваше имя</label> 
        <div class="controls">
            <input type="text" value="<?php echo $this->user->name?>" name="name" />
        </div>
    </div>
    
    <div class="form-actions">
        <input type="submit" class="btn btn-primary" name="submit" value="Поменять имя" />
        <?php echo URL::anchor('', 'Перейти на главную', 'class="btn"')?>
        <?php echo URL::anchor('users/profile', 'Перейти в свой профиль', 'class="btn"')?>
    </div>
</form>