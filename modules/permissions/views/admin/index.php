<div class="page-header">
    <h3>
        Группы
    </h3>
</div>

<ul>
    <?php Decorator::list_view(array(
        'items'=>$groups,
        'view'=>'_item'
    ))?>
</ul>