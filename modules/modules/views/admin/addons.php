<div class="search-modules">
    <?php if( $items ):?>
        <?php HTML\Table::display(array(
            'headings'=>array(
                'Название',
                'Описание',
                'Версия',
                'Действия'
            ),
            'items'=>$items,
            'view'=>'_addon_item'
        ))?>
    <?php else:?>
        <p>Дополнения не найдены</p>
    <?php endif?>
</div>

<div class="modal hide">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3>Установка модуля</h3>
  </div>
  <div class="modal-body">
    <p>Загружается… </p>
  </div>
  <div class="modal-footer">
    <a href="#" class="btn" data-dismiss="modal" >Закрыть</a>
  </div>
</div>

<script>
    $(".download").live('click', function(){        
        var module = $(this).parents("tr").attr("id");
        
        var label = $(this).wrap('<span class="label label-info" />').parent();
        label.html('устанавливается');
        
        $.get(BASE_URL + 'admin/modules/install/' + module, function(data){
            label.removeClass('label-info').addClass('label-success').html('установлен');
        });        
        return false;
    });
</script>