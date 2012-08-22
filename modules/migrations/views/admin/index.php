<div class="page-header">
    <ul class="header-actions">
        <li>
            <?=URL::anchor(
                'admin/migrations/create',
                'Создать',
                array(
                    'class'=>'btn btn-primary'
                )
            )?>
        </li>
    </ul>

    <h3>Список миграций</h3>
</div>

<?php if( $migrations ):?>
    <form class="table-form">
        <?php Decorator::table_view(array(
            'view'=>'admin/_row',
            'items'=>$migrations,
            'headings'=>array(
                'Версия',
                'Файл',
                'Действия'
            )
        ))?>
	</form>
<?php else:?>
    <p>Нет миграций</p>
<?php endif;?>