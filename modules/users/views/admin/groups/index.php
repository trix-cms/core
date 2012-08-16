<?php Decorator::table_view(array(
    'items'=>$groups,
    'view'=>'users::admin/groups/_item',
    'headings'=>array(
        'Название',
        'Slug',
        'Действия'
    )
))?>