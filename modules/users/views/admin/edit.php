<article class="full-block clearfix">
    <div class="article-container">
		<header>
			<h2 style="cursor: s-resize;">Пользователи</h2>
            <nav>
    			<ul class="button-switch">
    				<li><?php echo URL::anchor('admin/users', 'Список', 'class="button"')?></li>
    			</ul>
    		</nav>
		</header>
        <section>
        <h3 class="clearfix">Редактирование пользователя #<?php echo $item->id .' '.$item->login?></h3>
        
            <?php echo Decorator::form_view(array(
                'template'=>'_form',
                'inputs_template'=>'_inputs',
                'inputs'=>array(
                    array(
                        'type'=>'text',
                        'label'=>'Логин',
                        'name'=>'login',
                        'value'=>$item ? $item->login : set_value('login'),
                    ),
                    array(
                        'type'=>'text',
                        'label'=>'Почта',
                        'name'=>'email',
                        'value'=>$item ? $item->email : set_value('email'),
                    ),
                    array(
                        'type'=>'select',
                        'label'=>'Группа',
                        'name'=>'group_slug',
                        'value'=>$groups_options
                    ),
                    array(
                        'type'=>'image-file',
                        'label'=>'Аватар',
                        'mode'=>'edit', 
                        'name'=>'userfile',
                        'attr'=>array('id'=>'file_upload'),
                        'is_file'=> ($item AND $item->avatar != '') OR Uploadify::file(),
                        'file'=> $item ? $item->avatar_url
                                       : URL::site_url( Uploadify::$temp_folder .'thumbs/'. Uploadify::file() ),
                        'scriptData'=>array(
                            'max_width'=>48,
                            'hash'=>Uploadify::hash()
                        ),
                        'delete_url'=>$item ? URL::base_url() .'admin/users/delete_avatar/'. $item->id : ''
                    ),
                    array(
                        'type'=>'button',
                        'name'=>'apply',
                        'value'=>'Применить',
                        'attr'=>array('type'=>'submit', 'value'=>' '),
                        'visibility'=>$item ? TRUE : FALSE
                    ),
                    array(
                        'type'=>'button',
                        'name'=>'submit',
                        'value'=>'Сохранить',
                        'attr'=>array('type'=>'submit', 'value'=>' '),
                        'extra'=> ' '. URL::anchor('admin/users', 'обратно')
                    )
                )
            ))?>
            
        </section>
        <footer></footer>
	</div>
</article>