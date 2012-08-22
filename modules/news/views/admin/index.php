<div class="page-header">
    <ul class="header-actions">
        <li>
            <?=URL::anchor(
                'admin/news/add',
                'Создать',
                array(
                    'class'=>'btn btn-primary'
                )
            )?>
        </li>
    </ul>
    <h3>Список</h3>
</div>

<?php if( $news ):?>
    <form class="table-form">
        <?php Decorator::table_view(array(
            'view'=>'admin/_row',
            'items'=>$news,
            'headings'=>array(
                'ID',
                'Заголовок',
                'Создано',
                'Действия'
            )
        ))?>
	</form>
<?php else:?>
    <p>Нет новостей</p>
<?php endif;?>