<?php $this->template->begin_content()?>  
    <section>
        <div class="page-header" style="margin-bottom: 0px;">        
            <h3>
                <?php if( $user->is_current ):?>
                    <?php if( $this->action == 'edit' ):?>
                        Редактирование профиля
                        <small class="small-link"><?=URL::anchor('users/profile', 'просмотр')?></small>
                    <?php else:?>
                        Личный профиль
                        <small class="small-link"><?=URL::anchor('users/profile/edit', 'редактировать')?></small>
                    <?php endif;?>
                <?php else:?>
                    Профиль пользователя
                <?php endif;?>
                
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
                    <?php echo $content?>
                </div>
            </div>
        </div>
    </section>
<?php $this->template->end_content()?>