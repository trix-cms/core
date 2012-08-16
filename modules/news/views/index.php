<?php Decorator::list_view(array(
    'view'=>'_item',
    'items'=>$items,
    'no_items'=>'<p>Нет новостей</p>'
))?>

<?php $pager->display()?>

<style>
    .news-item {
        margin-bottom: 10px;
    }
    .news-item .page-header {
        margin-bottom: 5px;
        border-bottom: none;
    }
</style>