<section>
    <div class="page-header">
        <h1>Пользователи сайта</h1>
    </div>
    
    <?php if( $users ):?>
        <ul class="thumbnails">
            <?php Decorator::list_view(array(
                'template'=>'communities/_user',
                'items'=>$users
            ))?>
        </ul>
        
        <?php echo $pagination->display()?>
    <?php else:?>
        <p>Нет пользователей</p>
    <?php endif;?>

</section>