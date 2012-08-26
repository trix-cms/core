<table class="table table-bordered">
    <thead>
        <tr>
            <th>Заголовок темы</th>
            <th>Сообщений</th>
        </tr>
    </thead>
    <tbody>
        <?php if( $topics ):?>
            <?php HTML\TList::display(array(
                'template'=>'forum/topics/_user_item',
                'items'=>$topics
            ))?>
        <?php else:?>
            <tr>
                <td colspan="3" style="text-align: center;">Нет тем</td>
            </tr>
        <?php endif;?>
    </tbody>
</table>