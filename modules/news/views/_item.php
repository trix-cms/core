<div class="news-item">
    <div class="page-header">
        <div style="float: right;">
            <?=Date::nice($item->created_on)?>
        </div>
        <h3>
            <?php echo $item->title?>
        </h3>
    </div>
    
    <?php echo nl2br($item->content)?>
</div>
<hr />