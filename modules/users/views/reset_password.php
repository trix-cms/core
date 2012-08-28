<div class="page-header">
    <h2>Восстановление пароля</h2>
</div>

<?php $this->alert->display()?>

<form action="" method="post" class="form-horizontal">
    <div class="control-group">
        <label class="control-label">
            Пароль
        </label>
        <div class="controls">
            <input type="password" name="password" />
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">
            Повтор пароля
        </label>
        <div class="controls">
            <input type="password" name="password_2" />
        </div>
    </div>
    
    <div class="form-actions">
        <input type="submit" name="submit" value="Сохранить" class="btn btn-primary" />
    </div>
</form>