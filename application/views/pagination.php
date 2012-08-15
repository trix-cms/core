<?php if($pages_total > 1):?>
    <div class="pagination">
    <ul>
        <li class="prev<?php echo $current_page == 1 ? ' disabled' : ''?>"><?php echo $current_page != 1 ? URL::anchor($link, '««', 'title="Первая страница"', $query) : '<a>««</a>'?></li>

        <li<?php echo $current_page == 1 ? ' class="disabled"' : ''?>><?php echo $current_page != 1 ? URL::anchor(( $current_page == 2 ? $link : $link.'/'.($current_page - 1)), '«', '', $query) : '<a>«</a>'?></li>

        <?php if($current_page <= 10):?>

            <?php if($pages_total < 10):?>

                <?php for($i=1; $i<=$pages_total; $i++):?>
                    <li<?php echo ($current_page == $i ? ' class="active"': '')?>><?php echo ($current_page != $i) ? URL::anchor(( $i == 1 ? $link : $link.'/'.$i), $i, '', $query) : '<a>'. $i .'</a>'?></li>
                <?php endfor;?>

            <?php else:?>

                <?php for($i=1; $i<=10; $i++):?>
                    <li<?php echo ($current_page == $i ? ' class="active"': '')?>><?php echo ($current_page != $i) ? URL::anchor(( $i == 1 ? $link : $link.'/'.$i), $i, ($current_page == $i ? 'class="active"': ''), $query) : $i?></li>
                <?php endfor;?>
                <li><?php echo URL::anchor($link.'/11', '...', '', $query)?></li>

            <?php endif;?>

        <?php else:?>

            <?php

            $start_page = ($current_page%10 != 0) ? floor($current_page/10)*10 + 1 : $current_page - 9;
            $end_page = $start_page + 9;

            if($pages_total < $end_page)
            {
                $end_page = $pages_total;
            }

            ?>
            <li><?php echo URL::anchor($link.'/'.($start_page - 1), '...', '', $query)?></li>

            <?php for($i=$start_page; $i<=$end_page; $i++):?>
                <li<?php echo ($current_page == $i ? ' class="active"': '')?>><?php echo ($current_page != $i) ? URL::anchor(( $i == 1 ? $link : $link.'/'.$i), $i, '', $query) : $i?></li>
            <?php endfor;?>

            <?php if($pages_total > ($start_page + 10)):?>
                <li><?php echo URL::anchor($link.'/'.($end_page + 1), '...', '', $query)?></li>
            <?php endif;?>

        <?php endif;?>

        <li<?php echo $current_page == $pages_total ? ' class="disabled"' : ''?>><?php echo $current_page != $pages_total ? URL::anchor($link.'/'.($current_page + 1), '»', '', $query) : '<a>»</a>'?></li>

        <li class="next<?php echo $current_page == $pages_total ? ' disabled' : ''?>"><?php echo $current_page != $pages_total ? URL::anchor($link.'/'.$pages_total, '»»', 'title="Последняя страница"', $query) : '<a>»»</a>'?></li>
        
    </ul>
    </div>
<?php endif;?>
