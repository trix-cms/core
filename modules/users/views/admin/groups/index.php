<div class="page-header">
    <ul class="header-actions">
        <li>
            <?=URL::anchor(
                'users/admin/groups/add',
                'Создать',
                array(
                    'class'=>'btn btn-primary'
                )
            )?> 
        </li>
    </ul>

    <h3>
        Список
    </h3>
</div>

<?php Decorator::table_view(array(
    'items'=>$groups,
    'view'=>'groups/_item',
    'headings'=>array(
        'Название',
        'Slug',
        'Действия'
    )
))?>