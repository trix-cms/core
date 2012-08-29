<?php $this->template->begin_content()?>
    <div class="page-header">
        <ul class="header-actions">
            <li>
                <?=URL::anchor(
                    'addons',
                    'Все дополнение',
                    array(
                        'class'=>'btn'
                    )
                )?>
            </li>
        </ul>
            
        <h2>Мои дополнения</h2>
    </div>
    
    <?=$content?>
<?php $this->template->end_content()?>