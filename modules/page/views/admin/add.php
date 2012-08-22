<div class="page-header">
    <ul class="header-actions">
        <li>
            <?=URL::anchor(
                'admin/page', 
                'Список', 
                array(
                    'class'=>'btn btn-primary'
                )
            )?>
        </li>
    </ul>

    <h3><?=$page ? 'Редактирование' : 'Создание'?></h3>
</div>

<?php Decorator::form_view(array(
    'attr'=>array(
        'class'=>'form-horizontal'
    ),
    'inputs'=>array(
        array(
            'type'=>'text',
            'name'=>'title',
            'label'=>'Название',
            'attr'=>array(
                'id'=>'title'
            ),
            'value'=>$page ? $page->title : set_value('title')
        ),
        array(
            'type'=>'text',
            'name'=>'url',
            'label'=>'Ссылка на страницу',
            'attr'=>array(
                'id'=>'url'
            ),
            'value'=>$page ? $page->url: set_value('url')
        ),
        array(
            'type'=>'textarea',
            'name'=>'body',
            'label'=>'Текст',
            'attr'=>array(
                'class'=>'wysiwyg'
            ),
            'value'=>$page ? $page->body: set_value('body')
        ),
        array(
            'type'=>'submit',
            'value'=>'Сохранить',
            'name'=>'submit',
            'extra'=>' '
                . ( $page ? '<input type="submit" name="apply" value="Применить" class="btn btn-primary" />' : '' )
                . ' '. URL::anchor('admin/page', 'К списку страниц', array('class'=>'btn'))
        )
    )
))?>