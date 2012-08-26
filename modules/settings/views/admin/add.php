<article class="full-block clearfix">
    <div class="article-container">
		<header>
			<h2 style="cursor: s-resize;">Настройки</h2>
		</header>
        <section>
        <h3 class="clearfix">Добавление настройки</h3>
        
            <?php echo HTML\Form::display(array(
                'template'=>'_form',
                'inputs_template'=>'_inputs',
                'inputs'=>array(
                    array(
                        'type'=>'text',
                        'label'=>'Идентификатор',
                        'name'=>'slug',
                        'value'=>set_value('slug'),
                    ),
                    array(
                        'type'=>'select',
                        'label'=>'Модуль',
                        'name'=>'module',
                        'value'=>$modules_options
                    ),
                    array(
                        'type'=>'text',
                        'label'=>'Название',
                        'name'=>'title',
                        'value'=>set_value('title'),
                    ),
                    array(
                        'type'=>'textarea',
                        'label'=>'Описание',
                        'name'=>'description',
                        'value'=>'',
                        'attr'=>array('style'=>'height: 100px;', 'class'=>'medium')
                    ),
                    array(
                        'type'=>'text',
                        'label'=>'Значение',
                        'name'=>'value',
                        'value'=>set_value('value')
                    ),
                    array(
                        'type'=>'select',
                        'label'=>'Тип',
                        'name'=>'type',
                        'value'=>array(
                            array(
                                'value'=>'text',
                                'label'=>'text'
                            ),
                            array(
                                'value'=>'textarea',
                                'label'=>'textarea'
                            ),
                            array(
                                'value'=>'select',
                                'label'=>'select'
                            ),
                        )
                    ),
                    array(
                        'type'=>'text',
                        'label'=>'Опции',
                        'name'=>'options',
                        'value'=>''
                    ),
                    array(
                        'type'=>'text',
                        'label'=>'Атрибуты',
                        'name'=>'attr',
                        'value'=>''
                    ),
                    array(
                        'type'=>'button',
                        'name'=>'submit',
                        'value'=>'Добавить',
                        'attr'=>array('type'=>'submit', 'value'=>' '),
                        'extra'=> ' '. URL::anchor('admin/settings', 'обратно')
                    )
                )
            ))?>
            
        </section>
        <footer></footer>
	</div>
</article>