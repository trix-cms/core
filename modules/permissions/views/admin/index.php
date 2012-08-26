<div class="page-header">
    <h3>
        Группы
    </h3>
</div>

<ul>
    <?php HTML\TList::display(array(
        'items'=>$groups,
        'view'=>'_item'
    ))?>
</ul>