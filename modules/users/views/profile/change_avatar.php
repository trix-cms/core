<h3 class="heading">Загрузка аватара</h3>
<form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
    <fieldset>
        <div class="control-group">
			<label class="control-label">Изображение</label>
            <div class="controls">
                <input type="file" name="userfile" />
            </div>
			<td>
        </div>
        <div class="form-actions">
            <input type="submit" name="avatar_upload" class="btn btn-primary" value="Загрузить" style="margin-top: -4px;" /> 
            <?php echo URL::anchor('users/profile', 'Обратно', 'class="btn"')?>
        </div>
    </fieldset>
</form>
