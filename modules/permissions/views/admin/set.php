<div class="page-header">
    <h3>Установка прав группы <?php echo $this->uri->segment(4)?></h3>
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
    
    <?php foreach($modules->result() as $module):?>    
        <div class="control-group">
            <label for="<?php echo $module->url?>" class="control-label">
                <?php echo $module->title?>:
            </label>
            <div class="controls">
                <input type="checkbox" name="permissions[<?php echo $module->url?>]"<?php echo  ( isset($permissions[$module->url]) AND $permissions[$module->url] == 1) ? ' checked="checked"' : ''?> />
            </div>
        </div>
    <?php endforeach;?>
    
    <div class="form-actions">
        <input type="submit" name="submit" value="Сохранить" class="btn btn-primary" />
        <?php echo URL::anchor('admin/permissions', 'Обратно', 'class="btn"')?>
    </div>
</form>