<div class="page-header">
    <ul class="header-actions">
        <li>
            <?=URL::anchor(
                'addons',
                'Все дополнения',
                array(
                    'class'=>'btn'
                )
            )?>
        </li>
    </ul>

    <h3>
        <?=$item->name?>
    </h3>
</div>

<div>
    <p><strong>Описание</strong></p>
    <p><?=$item->desc?></p>
    
    <p><strong>Демо</strong></p>
    <p></p>
    
    <p><strong>Документация</strong></p>
    <p></p>
    
    <p><strong>Скачать</strong></p>
    <p></p>    
</div>