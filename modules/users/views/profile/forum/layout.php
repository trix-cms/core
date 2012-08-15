<?php $this->template->begin_content('users/profile/layout')?>

    <h3 style="margin-bottom: 10px;">На форуме</h3>

    <ul class="nav nav-tabs">
        <li<?php echo $this->action == 'index' ? ' class="active"' : ''?>>
            <?=URL::anchor('users/profile/forum', 'Темы')?>
        </li>
        <li<?php echo $this->action == 'posts' ? ' class="active"' : ''?>>
            <?=URL::anchor('users/profile/forum/posts', 'Ответы')?>
        </li>
    </ul>

    <?php echo $content?>
<?php $this->template->end_content()?>