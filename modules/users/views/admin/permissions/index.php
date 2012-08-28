<div class="page-header">
    <h3>
        Группы
    </h3>
</div>

<form action="" method="post" class="form-horizontal">
    <?=HTML\Table::display(array(
        'headings'=>$headings,
        'items'=>$modules,
        'view'=>'permissions/_item'
    ))?>
    
    <div class="form-actions">
        <input type="submit" name="submit" value="Сохранить" class="btn btn-primary" />
    </div>
</form>