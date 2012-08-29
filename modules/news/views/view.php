<div class="cont_cols2">          	
	<div class="box1">
        <h2>
            <?=$item->title?>
        </h2>
        <?=HTML::image($item->image_url, array('class'=>'i', 'width'=>150))?>
        <p>
            <?php echo $item->intro?>
        </p>
		<?php echo $item->body?>
        
		<div class="social_likes"></div>
		<div class="cat">Раздел: <?=$item->category_title?></div>
		<div class="dt">
            <?=Date::nice($item->created_on)?>
        </div>
		<div style="clear:both"></div>
	</div>
</div>