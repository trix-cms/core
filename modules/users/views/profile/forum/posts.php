<table class="table">
    <tbody>
        <?php if( $posts ):?>
            <?php HTML\TList::display(array(
                'template'=>'forum/posts/_user_item',
                'items'=>$posts
            ))?>
        <?php else:?>
            
        <?php endif;?>
    </tbody>
</table>
<?php $pager->display()?>