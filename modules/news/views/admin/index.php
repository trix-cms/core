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