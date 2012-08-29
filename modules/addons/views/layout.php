<?php $this->template->begin_content()?>

    <div class="page-header">
        <ul class="header-actions">
            <li>
                <?=URL::anchor(
                    'addons/my/add',
                    'Добавить дополнение',
                    array(
                        'class'=>'btn btn-primary'
                    )
                )?>
            </li>
        </ul>
    
        <h2>Дополнения</h2>
    </div>
    
    <?=$content?>
<?php $this->template->end_content()?>