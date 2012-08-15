<h3 style="margin-bottom: 10px;">
    <?php echo $news ? 'Редактирование' : 'Добавление'?> новости
</h3>

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
            'value'=>$news ? 'Сохранить изменения' : 'Добавить новость',
            'attr'=>array('type'=>'submit', 'value'=>' '),
            'visibility'=>!$news,
            'extra'=>' '. URL::anchor('admin/news', 'Обратно', array('class'=>'btn'))
        )
    )
))?>