<?php $this->template->begin_content()?>
    <div class="page-header">
        <ul class="header-actions">
            <?php if( isset($upgrade_to_latest) AND $upgrade_to_latest ):?>
                <li>
                    <?=URL::anchor(
                        'admin/migrations/latest', 
                        'Обновить до последней версии', 
                        array(
                            'class'=>'btn'
                        )
                    )?>
                </li>      
            <?php endif;?>
            
            <?php if( $this->action != 'create' ):?>
                <li>
                    <?=URL::anchor(
                        'admin/migrations/create',
                        'Создать файл миграции',
                        array(
                            'class'=>'btn btn-primary'
                        )
                    )?>
                </li>
            <?php else:?>
                <li>
                    <?php echo URL::anchor(
                        'admin/migrations', 
                        'Список миграций', 
                        array(
                            'class'=>'btn btn-primary'
                        )
                    )?>
                </li>
            <?php endif;?>
            
        </ul>
        <h2>Миграции</h2>
    </div>
    
    <?=$content?>
<?php $this->template->end_content()?>