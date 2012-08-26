<div class="page-header">
    <h3>Таблицы</h3>
</div>

<?php if( $tables ):?>
    <ul style="list-style: none;">
        <?php HTML\TList::display(array(
            'view'=>'_item',
            'items'=>$tables,
        ))?>
	</ul>
<?php else:?>
    <p>Нет таблиц</p>
<?php endif;?>