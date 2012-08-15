<div class="well" style="padding: 9px 0;">
    <ul class="nav nav-list">
        <li<?=$this->controller == 'dashboard' ? ' class="active"' : ''?>>
            <?=URL::anchor(
                'admin/dashboard',
                '<i class="icon-home"></i> Панель управления'
            )?>
        </li>
    
        <li class="nav-header">Содержимое</li>
        <li<?=$this->module == 'news' ? ' class="active"' : ''?>>
            <?=URL::anchor(
                'admin/news',
                '<i class="icon-book"></i> Новости'
            )?>
        </li>
        <li<?=$this->module == 'page' ? ' class="active"' : ''?>>
            <?=URL::anchor(
                'admin/page',
                '<i class="icon-pencil"></i> Страницы'
            )?>
        </li>
        
        <li class="nav-header">Пользователи</li>
        <li<?=$this->controller == 'users' ? ' class="active"' : ''?>>
            <?=URL::anchor(
                'admin/users',
                '<i class="icon-user"></i> Управление'
            )?>
        </li>
        <li<?=$this->controller == 'groups' ? ' class="active"' : ''?>>
            <?=URL::anchor(
                'users/admin/groups',
                '<i class="icon-th-list"></i> Группы'
            )?>
        </li>
        <li<?=$this->module == 'permissions' ? ' class="active"' : ''?>>
            <?=URL::anchor(
                'admin/permissions',
                '<i class="icon-lock"></i> Права'
            )?>
        </li>
        
        <li class="nav-header">Настройки</li>
        <li<?=$this->module == 'settings' ? ' class="active"' : ''?>>
            <?=URL::anchor(
                'admin/settings',
                '<i class="icon-cog"></i> Настройки сайта'
            )?>
        </li>
        
        <li class="nav-header">Утилиты</li>
        <li<?=$this->module == 'migrations' ? ' class="active"' : ''?>>
            <?=URL::anchor(
                'admin/migrations',
                '<i class="icon-arrow-up"></i> Миграции'
            )?>
        </li>
        <li<?=$this->module == 'scaffold' ? ' class="active"' : ''?>>
            <?=URL::anchor(
                'admin/scaffold',
                '<i class="icon-random"></i> Scaffolding'
            )?>
        </li>
        
        <li class="divider"></li>
        <li>
            <a href="#">
                <i class="icon-flag"></i>
                 Помощь
            </a>
        </li>
    </ul>
</div>