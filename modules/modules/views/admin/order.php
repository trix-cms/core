<article class="full-block clearfix">
    <div class="article-container">
		<header>
			<h2 style="cursor: s-resize;">Модули</h2>
		</header>
        <section>
        <h3 class="clearfix">Порядок модулей в меню</h3>
            <?php HTML\Table::display(array(
                'table_template'=>'_sortable_table',
                'view'=>'admin/_sort_row',
                'items'=>$modules,
                'id'=>'modules',
                'headings'=>array(
                    '&nbsp;',
                    'Название',
                )
            ))?>
        </section>
        <footer></footer>
	</div>
</article>
<script>
    $(function(){
        $(".sortable").sortable({
            handle: '.sortable-helper',
            connectWith: '.sortable',
            items: '.link',
            update: function(event, ui){
                var ids = new Array;
                var area = $(this).parent().find(".sortable").attr("id");

                $(this).parent().find("tr.link").each(function(i, item){
                    ids[i] = ($(this).attr("id")).replace('module_', ''); 
                });
                
                $.post(BASE_URL + 'admin/modules/reorder', 
                    {ids: ids},
                    function(data){}
                );
            },
        }); 
    });
</script>