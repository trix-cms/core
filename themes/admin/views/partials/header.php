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
        <li<?=$this->module == 'modules' ? ' class="active"' : ''?>>
            <?=URL::anchor(
                'admin/modules',
                'Модули'
            )?>
        </li>
        <li<?=$this->module == 'settings' ? ' class="active"' : ''?>>
            <?=URL::anchor(
                'admin/settings',
                'Настройки сайта'
            )?>
        </li>
    </ul>
    <ul class="nav pull-right">
        <li>
            <?=URL::anchor('', 'Перейти на сайт')?>
        </li>
        <li>
            <?=URL::anchor(
                'admin/users/edit/'. $this->user->id,
                $this->user->login
            )?>
        </li>
        <li>
            <?=URL::anchor('admin/logout', 'Выйти', array('style'=>'color: white'))?>
        </li>
    </ul>
</div>