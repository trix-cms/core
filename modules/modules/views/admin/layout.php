<?php $this->template->begin_content()?>

    <div class="page-header">
        <h2>Модули</h2>
    </div>
    
    <ul class="nav nav-tabs">
        <li<?=$this->action == 'index' ? ' class="active"' : ''?>>
            <?=URL::anchor(
                'admin/modules',
                'Установленные'
            )?>
        </li>
        <li<?=$this->action == 'search' ? ' class="active"' : ''?>>
            <?=URL::anchor(
                'admin/modules/search',
                'Поиск'
            )?>
        </li>
    </ul>
    
    <?=$content?>

<?php $this->template->end_content()?>