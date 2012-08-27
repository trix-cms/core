<div class="page-header">
    <?php if( $this->module == 'settings' ):?>
        <h2>Настройки</h2>
    <?php else:?>
        <h3>Настройки</h3>
    <?php endif;?>
</div>

<section>
<?php if( $settings ):?>

    <?php if( $tabs ):?>
        <ul class="nav nav-tabs">
        <?php $i=0; foreach($tabs as $tab):?>
            <li<?=$i==0? ' class="active"' : ''?>>
                <a data-toggle="tab" href="#<?=$tab->tabs?>">
                    <?=$tab->tabs?>
                </a>
            </li>
        <?php $i++; endforeach;?>
        </ul>
    <?php endif;?>

    <form 
        action="<?php echo URL::site_url('admin/settings/edit/'.( CI::$APP->module ? CI::$APP->module : ''))?>" 
        method="post"
        class="form-horizontal"
    >
        <?php if( $tabs ):?>        
        
            <div class="tab-content">
                <?php $i=0; foreach($tabs as $tab):?>
                    <div class="tab-pane<?=$i==0 ? ' active' : ''?>" id="<?=$tab->tabs?>">
                    <?php $i=0; foreach($settings[$tab->tabs] as $setting):?>
                        <?php $this->load->view('settings::_item', array('item'=>$setting), FALSE)?>
                    <?php $i++; endforeach?>
                    </div>
                <?php $i++; endforeach;?>
            </div>
            
        <?php else:?>     
               		
            <?php foreach($settings as $setting):?>
                <?php $this->load->view('settings::_item', array('item'=>$setting), FALSE)?>
            <?php endforeach?>
            
        <?php endif;?>
        
        <div class="form-actions">
            <button type="submit" name="submit" value="submit" class="btn btn-primary">
                Сохранить
            </button>
        </div>
    </form>
<?php else:?>
    <p>Нет настроек</p>
<?php endif;?>
</section>