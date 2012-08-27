<form action="" method="post" class="form-horizontal">
<div class="modal" id="myModal">
    <div class="modal-header">
        <h3>Вход в админку</h3>
    </div>
    
    <div class="modal-body">
        <?php $this->alert->display()?>
        
        <div class="control-group">
            <label class="control-label">Логин</label>
            <div class="controls">
                <input type="text" name="login" value="" />
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">Пароль</label>
            <div class="controls">
                <input type="password" name="password" value="" />
            </div>
        </div>
    </div>
    
    <div class="modal-footer">
        <?=URL::anchor(
            '',
            'Перейти на сайт',
            array(
                'class'=>'btn'
            )
        )?>
        <input type="submit" name="submit" value="Войти" class="btn btn-primary" />
    </div>
</div>
</form>