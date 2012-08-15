<article class="full-block clearfix">
    <div class="article-container">
		<header>
			<h2 style="cursor: s-resize;">Scaffolding</h2>
            <nav>
    			<ul class="button-switch">
    				<li><?php echo URL::anchor('admin/scaffold/table/'. $table, 'Все записи', 'class="button"')?></li>
    			</ul>
    		</nav>
		</header>
        <section>
        <h3 class="clearfix">Создание записи в таблице <?php echo $table?></h3>
            <?php echo Decorator::form_view(array(
                'attr'=>array(
                    'class'=>'form-horizontal'
                ),
                'inputs'=>Scaffold_Helper::generate_inputs($fields, $item)
            ))?>
        </section>
        <footer></footer>
	</div>
</article>