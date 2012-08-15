<article class="full-block clearfix">
    <div class="article-container">
		<header>
			<h2 style="cursor: s-resize;">Scaffolding</h2>
            <nav>
    			<ul class="button-switch">
    				<li><?php echo URL::anchor('admin/scaffold', 'Таблицы', 'class="button"')?></li>
    			</ul>
    		</nav>
		</header>
        <section>
            <h3 class="clearfix">SQL запросы</h3>
            <?php echo Decorator::form_view(array(
                'attr'=>array(
                    'enctype'=>'multipart/form-data',
                    'class'=>'form-horizontal'
                ),
                'inputs'=>array(
                    array(
                        'type'=>'textarea',
                        'label'=>'Запрос',
                        'name'=>'query',
                        'value'=>set_value('query'),
                        'attr'=>array('class'=>'medium', 'style'=>'height: 200px;')
                    ),
                    array(
                        'type'=>'submit',
                        'name'=>'submit',
                        'value'=>'Выполнить запрос',
                        'extra'=> ' '. URL::anchor('admin/scaffold', 'К списку таблиц', array('class'=>'btn'))
                    )
                )
            ))?>
        </section>
        <footer></footer>
	</div>
</article>