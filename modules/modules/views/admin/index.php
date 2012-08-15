<article class="full-block clearfix">
    <div class="article-container">
		<header>
			<h2 style="cursor: s-resize;">Модули</h2>
		</header>
        <section>
            <?php if($modules):?>
            <h3 class="clearfix">Дополнительные модули</h3>
               <?php Decorator::table_view(array(
                    'table_template'=>'_table',
                    'view'=>'modules/_row',
                    'items'=>$modules,
                    'headings'=>array(
                        '&nbsp;',
                        'Название',
                        'Статус',
                        //'Действия'
                    )
                ))?>
            <?php endif;?>
            
            <h3 class="clearfix">Основные модули</h3>
            <?php Decorator::table_view(array(
                'table_template'=>'_table',
                'view'=>'modules/_row',
                'items'=>$core_modules,
                'headings'=>array(
                    '&nbsp;',
                    'Название',
                    'Статус',
                    //'Действия'
                )
            ))?>
        </section>
        <footer></footer>
	</div>
</article>