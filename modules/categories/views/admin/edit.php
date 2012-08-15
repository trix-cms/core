<div class="page-header">
    <h2>Категории</h2>
</div>

<section>
    <div class="page-header">
        <h3>Редактирование категории <?php echo $category->title?></h3>
    </div>
    <?php Decorator::form_view(array(
        'attr'=>array(
            'class'=>'form-horizontal'
        ),
        'inputs'=>array(
            array(
                'type'=>'text',
                'label'=>'Название',
                'name'=>'title',
                'value'=>$category->title
            ),
            array(
                'type'=>'textarea',
                'label'=>'Описание',
                'name'=>'description',
                'value'=>$category->description,
                'attr'=>array('class'=>'medium', 'style'=>'height: 100px;'),
                'visibility'=>FALSE
            ),
            array(
                'type'=>'select',
                'label'=>'Подкатегория',
                'name'=>'parent_id',
                'options'=>$cat_options
            ),
            array(
                'type'=>'submit',
                'name'=>'submit',
                'value'=>'Сохранить',
                'attr'=>array('type'=>'submit', 'value'=>' '),
                'extra'=>' '.URL::anchor('admin/categories/module/'. $category->module, 'Обратно', array('class'=>'btn'))
            )
        )
    ))?>
</section>