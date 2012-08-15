<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
</a>
<a class="brand">
    <?=$this->settings->site_name?>
</a>
<div class="nav-collapse">
    <ul class="nav">
        <li>
            <?=URL::anchor(
                'admin/users/edit/'. $this->user->id,
                $this->user->login
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
            <?=URL::anchor('admin/logout', 'Выйти', array('style'=>'color: white'))?>
        </li>
    </ul>
</div>