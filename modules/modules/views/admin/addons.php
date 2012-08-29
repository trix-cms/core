<?php $this->alert->display()?>

<div class="search-modules">
    <?php if( is_array($items) ):?>
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
        <p>Нет дополнений</p>
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
        label.html('устанавливается...');
        
        $.getJSON(BASE_URL + 'admin/modules/install/' + module, function(data){
            if( data.success ){
                label.removeClass('label-info').addClass('label-success').html('установлен');
            } else {
                label.wrap('<a class="download" href="#" />').parent().html('установить');
                $(".search-modules").before('<div class="alert alert-attention"><a class="close" data-dismiss="alert" href="#">&times;</a>' + data.message +'</div>');
            }            
        });        
        return false;
    });
    
    $(".update").live('click', function(){
        var module = $(this).parents("tr").attr("id");
        
        var label = $(this).wrap('<span class="label label-info" />').parent();
        label.html('обновляется');
        
        $.get(BASE_URL + 'admin/modules/update/' + module, function(data){
            label.removeClass('label-info').addClass('label-success').html('обновлен');
        });        
        return false;
    });
</script>