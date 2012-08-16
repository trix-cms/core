<div class="page-header">
    <h3>Список страниц</h3>
</div>

<?php Decorator::table_view(array(
    'view'=>'admin/_item',
    'items'=>$pages,
    'no_items'=>'<p>Нет страниц</p>',
    'headings'=>array(
        'ID',
        'Заголовок',
        'Ссылка',
        'Действия'
    )
))?>