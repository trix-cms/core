<div class="page-header">
    <ul class="header-actions">
        <li>
            <?=URL::anchor(
                'addons/my',
                'Список',
                array(
                    'class'=>'btn btn-primary'
                )
            )?>
        </li>
    </ul>
    
    <h3><?=$item ? 'Редактирование' : 'Добавление'?></h3>
</div>

<?php $this->alert->display()?>

<?php HTML\Form::display(array(
    'attr'=>array(
        'class'=>'form-horizontal',
        'enctype'=>'multipart/form-data'
    ),
    'inputs'=>array(
        array(
            'type'=>'text',
            'label'=>'Slug',
            'name'=>'slug',
            'value'=>$item ? $item->slug : set_value('slug'),
            'help'=>'Имя класса, например Breadcrumbs, Trix\Alert'
        ),
        array(
            'type'=>'text',
            'label'=>'Версия',
            'name'=>'version',
            'value'=>$item ? $item->version : set_value('version')
        ),
        array(
            'type'=>'text',
            'label'=>'Имя',
            'name'=>'name',
            'value'=>$item ? $item->name : set_value('name')
        ),
        array(
            'type'=>'textarea',
            'label'=>'Описание',
            'name'=>'description',
            'value'=>$item ? $item->desc : set_value('description')
        ),
        array(
            'type'=>'select',
            'name'=>'type',
            'label'=>'Тип',
            'options'=>Addons_m::get_types(),
            'value'=>$item ? $item->type : set_value('type')
        ),
        array(
            'type'=>'file',
            'name'=>'userfile',
            'label'=>'Модуль',
            'help'=>'Модуль упакован в zip архив',
            'options'=>Addons_m::get_types(),
            'value'=>$item ? $item->type : set_value('type')
        ),
        array(
            'type'=>'submit',
            'name'=>'submit',
            'value'=>'Сохранить',
            'extra'=>$item ? ' <input type="submit" name="apply" value="Применить" class="btn btn-primary" />' : ''
        )
    )
))?>