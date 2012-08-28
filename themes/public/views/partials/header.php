<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
</a>
<?=URL::anchor(
    'admin',
    $this->settings->site_name,
    array(
        'class'=>'brand'
    )
)?>
<div class="nav-collapse">
    <ul class="nav">
    </ul>
    <ul class="nav pull-right">
        <?php if( $this->user->logged_in ):?>
            <?php if( $this->user->is_in_group('admins') ):?>
                <li>
                    <?=URL::anchor(
                        'admin',
                        'Панель управления'
                    )?>
                </li>
            <?php endif?>
            
            <li>
                <a><?=$this->user->login?></a> 
            </li>
            <li>
                <?=URL::anchor('users/logout', 'Выйти', array('style'=>'color: white'))?>
            </li>
        <?php else:?>
            <li>
                <?=URL::anchor(
                    'users/login',
                    'Вход'
                )?>
            </li>
            <li>
                <?=URL::anchor(
                    'users/register', 
                    'Регистрация'
                )?>
            </li>  
        <?php endif?>
    </ul>
</div>