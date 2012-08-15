<?php $this->template->begin_content()?>

    <div class="page-header">
        <ul class="header-actions">
            <?php if( $this->action != 'add' ):?>
                <li>
                    <?=URL::anchor(
                        'users/admin/groups/add',
                        'Добавить',
                        array(
                            'class'=>'btn btn-primary'
                        )
                    )?> 
                </li>
            <?php else:?>
                <li>
                    <?=URL::anchor(
                        'users/admin/groups',
                        'Список',
                        array(
                            'class'=>'btn btn-primary'
                        )
                    )?> 
                </li>
            <?php endif;?>
        </ul>
    
        <h2>
            Группы
        </h2>
    </div>

    <?=$content?>
<?php $this->template->end_content()?>