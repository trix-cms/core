<div class="page-header">
    <h2>Восстановление пароля</h2>
</div>

<?php $this->alert->display()?>

<form action="" method="post" class="form-horizontal">
    <div class="control-group">
        <label class="control-label">
            E-mail
        </label>
        <div class="controls">
            <input type="text" name="email" value="<?=set_value('email')?>" />
        </div>
    </div>
    
    <div class="form-actions">
        <input type="submit" name="submit" value="Отправить" class="btn btn-primary" />
    </div>
</form>