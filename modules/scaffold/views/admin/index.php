<div class="page-header">
    <h3>Таблицы</h3>
</div>

<?php if( $tables ):?>
    <ul class="list-style-arrow">
        <?php Decorator::list_view(array(
            'view'=>'_item',
            'items'=>$tables,
        ))?>
	</ul>
<?php else:?>
    <p>Нет таблиц</p>
<?php endif;?>