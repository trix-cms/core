<li<?php echo $item->is_current() ? ' class="current"' : ''?>>
    <?php echo URL::anchor('admin/'. $item->url, $item->title, 'title="" class="'. (!$item->has_submenu ? 'no-submenu' : '') .'"')?>
    
    <?php $new = Trix_Model::factory($item->url)->count_new()?>
    <?php echo $new ? '<span title="новые">'. $new .'</span>' : ''?>
    
    <?php $item->has_submenu ? $this->template->load($item->url.'/_submenu') : ''?>
</li>
