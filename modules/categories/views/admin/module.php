<div class="page-header">
    <h3>
        Категории
    </h3>
</div>

<?php if( $categories ):?>
    <table class="table table-bordered">
        <thead>
            <tr>
                <td>Название</td>
                <td>Действия</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach($categories as $category):?>
                <?php $this->load->view('categories::_row', array('item'=>$category), FALSE, 'categories')?>
            <?php endforeach;?>
        </tbody>
    </table>
<?php else:?>
    <p>Нет категорий</p>
<?php endif;?>

<div class="page-header">
    <h3>Создать категорию</h3>
</div>


<?php HTML\Form::display(array(
    'attr'=>array(
        'class'=>'form-horizontal'
    ),
    'inputs'=>array(
        array(
            'type'=>'text',
            'label'=>'Название',
            'name'=>'title',
            'value'=>''
        ),
        array(
            'type'=>'textarea',
            'label'=>'Описание',
            'name'=>'description',
            'value'=>'',
            'attr'=>array(
                'class'=>'medium', 
                'style'=>'height: 100px;'
            )
        ),
        array(
            'type'=>'select',
            'label'=>'Подкатегория',
            'name'=>'parent_id',
            'options'=>$cat_options,
            'default'=>0
        ),
        array(
            'type'=>'submit',
            'name'=>'submit',
            'value'=>'Создать категорию',
            'attr'=>array('type'=>'submit', 'value'=>' ')
        )
    )
))?>