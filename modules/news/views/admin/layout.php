<?php $this->template->begin_content()?>

    <div class="page-header">
        <ul class="header-actions">       
            <li>
                <?=URL::anchor(
                    'admin/news/settings',
                    'Настройки',
                    array(
                        'class'=>'btn'
                    )
                )?>
            </li>
        </ul>
        <h2>Новости</h2>
    </div>

    <?=$content?>

<?php $this->template->end_content()?>