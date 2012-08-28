<?php $this->template->begin_content()?>

    <ul class="nav nav-tabs">
        <li<?=$this->controller == 'users' ? ' class="active"' : ''?>>
            <?=URL::anchor(
                'admin/users',
                'Пользователи'
            )?>
        </li>
        <li<?=$this->controller == 'groups' ? ' class="active"' : ''?>>
            <?=URL::anchor(
                'users/admin/groups',
                'Группы'
            )?>
        </li>
        <li<?=$this->controller == 'permissions' ? ' class="active"' : ''?>>
            <?=URL::anchor(
                'users/admin/permissions',
                'Права'
            )?>
        </li>
    </ul>
    
    <?=$content?>
<?php $this->template->end_content()?>