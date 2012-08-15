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
             
            <?php if( $this->action != 'add' ):?>
                <li>
                    <?=URL::anchor(
                        'admin/news/add',
                        'Добавить новость',
                        array(
                            'class'=>'btn btn-primary'
                        )
                    )?>
                </li>
            <?php endif;?>
            
            <?php if( $this->action != 'index' ):?>
                <li>
                    <?=URL::anchor(
                        'admin/news',
                        'Список новостей',
                        array(
                            'class'=>'btn btn-primary'
                        )
                    )?>
                </li>
            <?php endif;?>
        </ul>
        <h2>Новости</h2>
    </div>

    <?=$content?>

<?php $this->template->end_content()?>