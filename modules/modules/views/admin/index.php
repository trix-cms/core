<ul class="nav nav-tabs">
    <li>
        <li class="active"><a href="#addons" data-toggle="tab">Дополнения</a></li>
    </li>
    <li>
        <li><a href="#core" data-toggle="tab">Ядро</a></li>
    </li>
</ul>

<div id="myTabContent" class="tab-content">
    <div class="tab-pane active in" id="addons">
        <?php if( $modules ):?>
            <?php HTML\Table::display(array(
                'view'=>'_row',
                'items'=>$modules,
                'headings'=>array(
                    'Название',
                    'Описание',
                    'Версия',
                    'Тип',
                    'Статус',
                    'Действия'
                )
            ))?>
        <?php else:?>
            <p>Дополнительные модули не установлены. <?=URL::anchor('admin/modules/addons', 'Найти')?></p>
        <?php endif?>
    </div>
    <div class="tab-pane" id="core">
        <?php HTML\Table::display(array(
            'view'=>'_row',
            'items'=>$core_modules,
            'headings'=>array(
                'Название',
                'Описание',
                'Версия',
                'Тип',
                'Статус',
                'Действия'
            )
        ))?>
    </div>
</div>

<style>
    .module-enable {cursor: pointer;}
</style>

<script>
    $(".module-enable").click(function(){
        var module = $(this).parents("tr").attr("id");
        
        if( $(this).hasClass('label-success') ){
            $(this).removeClass('label-success').addClass('label-important').html('отключен');
            $.get(BASE_URL + 'admin/modules/enable/off/' + module );
        } else {
            $(this).removeClass('label-important').addClass('label-success').html('включен');
            $.get(BASE_URL + 'admin/modules/enable/on/' + module );
        }
    });
</script>