<div class="page-header">
    <ul class="header-actions">
        <li>
            <?=URL::anchor(
                'admin/news',
                'Список',
                array(
                    'class'=>'btn btn-primary'
                )
            )?>
        </li>
    </ul>
    <h3>
        <?=$news ? 'Редактирование' : 'Добавление'?>
    </h3>
</div>

<?php echo Decorator::form_view(array(
    'attr'=>array(
        'enctype'=>'multipart/form-data',
        'class'=>'form-horizontal'
    ),
    'inputs'=>array(
        array(
            'attr'=>array(
                'id'=>'title'
            ),
            'type'=>'text',
            'label'=>'Заголовок',
            'name'=>'title',
            'value'=> $news ? $news->title : set_value('title'),
        ),
        array(
            'attr'=>array(
                'id'=>'url'
            ),
            'type'=>'text',
            'label'=>'ЧПУ',
            'name'=>'url',
            'value'=>$news ? $news->url : set_value('url')
        ),
        array(
            'type'=>'textarea',
            'label'=>'Текст',
            'name'=>'content',
            'value'=> $news ? $news->content : set_value('content'),
            'attr'=>array(
                'class'=>'', 
                'style'=>'height: 250px;'
            )
        ),
        array(
            'type'=>'submit',
            'name'=>'apply',
            'value'=>'Применить',
            'attr'=>array('type'=>'submit', 'value'=>' '),
            'visibility'=>$news ? TRUE : FALSE,
            'extra'=>' <input type="submit" name="submit" value="Сохранить" class="btn btn-primary" /> '. URL::anchor('admin/news', 'Обратно', array('class'=>'btn'))
        ),
        array(
            'type'=>'submit',
            'name'=>'submit',
            'value'=>'Сохранить',
            'attr'=>array('type'=>'submit', 'value'=>' '),
            'visibility'=>!$news,
            'extra'=>' '. URL::anchor('admin/news', 'Обратно', array('class'=>'btn'))
        )
    )
))?>