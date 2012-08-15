<div class="nav nav-pills">
    <li<?php echo $this->uri->segment(1) == '' ? ' class="active"' : ''?>>
        <?php echo URL::anchor(
            '',
            'Главная'
        )?>
    </li>
    <li<?php echo $this->module == 'news' ? ' class="active"' : ''?>>
        <?php echo URL::anchor(
            'news',
            'Новости'
        )?>
    </li>
    <li<?php echo $this->module == 'page' ? ' class="active"' : ''?>>
        <?php echo URL::anchor(
            'page',
            'Страницы'
        )?>
    </li>
    <li<?php echo $this->module == 'users' ? ' class="active"' : ''?>>
        <?php echo URL::anchor(
            'users',
            'Пользователи'
        )?>
    </li>
</div>