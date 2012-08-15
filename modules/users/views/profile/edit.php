<section>
    <div class="page-header" style="margin-bottom: 0px;">        
        <h3>
            Редактирование профиля
            <small class="small-link"><?=URL::anchor('users/profile', 'просмотр')?></small>
        </h3>
    </div>
    
    <div class="row">
        <div class="span1">
            <div style="margin-left: 10px; padding-top: 10px; text-align: center;">
                <?php echo HTML::image(
                    $user->avatar_url, 
                    array(
                        'class'=>'avatar-image'
                    )
                )?>
            </div>
        </div>
        <div class="span6">
            <div>
                
                <section style="margin-top: 5px;">
                    <h3 class="heading">Загрузка аватара</h3>
                    <form action="<?=URL::site_url('users/profile/avatar')?>" method="post" enctype="multipart/form-data" class="form-horizontal">
                        <fieldset>
                            <div class="control-group">
                    			<label class="control-label">Изображение</label>
                                <div class="controls">
                                    <input type="file" name="userfile" />
                                </div>
                    			<td>
                            </div>
                            
                            <div style="padding-left: 160px;">
                                <input type="submit" name="avatar_upload" class="btn btn-primary" value="Загрузить" />
                            </div>
                        </fieldset>
                    </form>
                
                </section>
                
                <hr />
                
                <section>
                    <h3>Редактирование профиля</h3>
                    <br />
                    <form action="" method="post" class="form-horizontal">
                        
                        <div style="padding-left: 160px;">
                            <input type="submit" name="submit" value="Сохранить" class="btn btn-primary" />
                        </div>
                    </form>    
                </section>
                <hr />
                <section>
                    <h3 style="margin-bottom: 10px;">
                        Смена пароля
                    </h3>
                    
                    <?php echo Decorator::form_view(array(
                        'attr'=>array(
                            'class'=>'form-horizontal',
                            'action'=>URL::site_url('users/profile/password')
                        ),
                        'inputs'=>array(
                            array(
                                'type'=>'password',
                                'label'=>'Старый пароль',
                                'name'=>'old_password',
                                'value'=>'',
                            ),
                            array(
                                'type'=>'password',
                                'label'=>'Новый пароль',
                                'name'=>'password',
                                'value'=>'',
                            ),
                            array(
                                'type'=>'password',
                                'label'=>'Пароль еще раз',
                                'name'=>'password2',
                                'value'=>''
                            ),
                            array(
                                'attr'=>array(
                                    'style'=>'margin-left: 160px;'
                                ),
                                'type'=>'submit',
                                'name'=>'submit',
                                'value'=>'Сохранить'
                            )
                        )
                    ))?>
                </div>
                </section>
                
                
            </div>
        </div>
    </div>
</section>