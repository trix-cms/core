<div class="page-header">
    <ul class="header-actions">
        <li>
            <?=URL::anchor(
                'admin/page/add', 
                'Создать', 
                array(
                    'class'=>'btn btn-primary'
                )
            )?>
        </li>
    </ul>

    <h3>Список</h3>
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