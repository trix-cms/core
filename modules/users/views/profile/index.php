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
                <table class="table">
                    <tbody>
                        <tr>
                            <td style="border-top: none;">ID</td>
                            <td style="border-top: none;"><?=$user->id?></td>
                        </tr>
                        <tr>
                            <td>Имя</td>
                            <td><?=$user->login ? $user->login : 'не указано'?></td>
                        </tr>
                        <tr>
                            <td>Статус</td>
                            <td>Админ</td>
                        </tr>
                        <tr>
                            <td>Репутация исполнителя</td>
                            <td>
                                <?=$user->reputation?>
                            </td>
                        </tr>
                        <tr>
                            <td>Рефералов</td>
                            <td><?=$user->referals_count?></td>
                        </tr>
                        <tr>
                            <td>Дата регистрации на сайте</td>
                            <td><?=Date::nice($user->register_date)?></td>
                        </tr>
                        <tr>
                            <td>Последний визит</td>
                            <td><?=$user->lastvisit_date ? Date::nice($user->lastvisit_date) : ''?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

