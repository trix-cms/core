<?php Decorator::table_view(array(
    'view'=>'admin/_item',
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