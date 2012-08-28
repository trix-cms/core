<div class="page-header">
    <h3>Установка прав группы <?=$group?></h3>
</div>

<form action="" method="post" class="form-horizontal">

    <div class="control-group">
        <label for="has_backend_access" class="control-label">
            Доступ в админку:
        </label>
        <div class="controls">
            <input type="checkbox" name="has_backend_access"<?php echo ( $has_backend_access == 1 ) ? ' checked="checked"' : ''?> />
        </div>
    </div>
    
    <?php foreach($modules as $module):?>    
        <div class="control-group">
            <label for="<?php echo $module->slug?>" class="control-label">
                <?php echo $module->name?>:
            </label>
            <div class="controls">
                <input type="checkbox" name="permissions[<?php echo $module->slug?>]"<?php echo  ( isset($permissions[$module->slug]) AND $permissions[$module->slug] == 1) ? ' checked="checked"' : ''?> />
            </div>
        </div>
    <?php endforeach;?>
    
    <div class="form-actions">
        <input type="submit" name="submit" value="Сохранить" class="btn btn-primary" />
        <?php echo URL::anchor('admin/permissions', 'Обратно', 'class="btn"')?>
    </div>
</form>