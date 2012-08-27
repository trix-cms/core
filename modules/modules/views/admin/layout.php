<?php $this->template->begin_content()?>

    <div class="page-header">
        <h2>Модули</h2>
    </div>
    
    
    <div class="page-header">
        <ul class="header-actions">
            <li>
                <?php if( $this->action == 'addons' ):?>
                    <?=URL::anchor(
                        'admin/modules',
                        'Установленные модули',
                        array(
                            'class'=>'btn btn-primary'
                        )
                    )?>
                <?php else:?>
                    <?=URL::anchor(
                        'admin/modules/addons',
                        'Найти дополнения',
                        array(
                            'class'=>'btn btn-primary'
                        )
                    )?>
                <?php endif?>
            </li>
        </ul>
    
        <h3><?=$this->action == 'addons' ? 'Доступные дополнения' : 'Установленные'?></h3>
    </div>
    
    <?=$content?>

<?php $this->template->end_content()?>