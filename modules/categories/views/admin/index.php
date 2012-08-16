<article class="full-block clearfix">
    <div class="article-container">
		<header>
			<h2 style="cursor: s-resize;">Категории</h2>
		</header>
        <section>
            <h3>Выберите модуль</h3>
            <ul class="stats-summary">
                <?php Decorator::list_view(array(
                    'template'=>'admin/categories/_module_item',
                    'items'=>$modules
                ))?>
			</ul>
        </section>
        <footer></footer>
	</div>
</article>