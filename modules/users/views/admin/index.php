<div class="page-header">
    <h3>
        Список
    </h3>
</div>

<?php Decorator::table_view(array(
    'view'=>'_item',
    'items'=>$users,
    'no_items'=>'<p>Нет пользователей</p>',
    'headings'=>array(
        'ID',
        'Логин',
        'Группа',
        'Почта',
        'Дата регистрации',
        'Действия'
    )
))?>