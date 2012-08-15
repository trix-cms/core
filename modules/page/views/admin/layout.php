<?php $this->template->begin_content()?>

<div class="page-header">
    <ul class="header-actions">
        <?php if( $this->action == 'add' OR $this->action =='edit' ):?>
            <li>
                <?=URL::anchor(
                    'admin/page', 
                    'Список страниц', 
                    array(
                        'class'=>'btn btn-primary'
                    )
                )?>
            </li>
        <?php endif;?>
        
        <?php if( $this->action != 'add' ):?>
            <li>
                <?=URL::anchor(
                    'admin/page/add', 
                    'Создать страницу', 
                    array(
                        'class'=>'btn btn-primary'
                    )
                )?>
            </li>
        <?php endif;?>
    </ul>
    
    <h2>Страницы</h2>
</div>

<?=$content?>

<?php $this->template->end_content()?>