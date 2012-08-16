<?php

class Settings {
    
    function __construct()
    {                        
        CI::$APP->load->model('settings/settings_m');
        
        $settings = CI::$APP->settings_m->select('slug, value, module')->get_all();
        
        if( $settings )
        {
            foreach($settings as $setting)
            {
                if( $setting->module == 'settings' )
                {
                    $this->{$setting->slug} = $setting->value;
                }
                else
                {
                    $this->{$setting->module}->{$setting->slug} = $setting->value;
                }
            }
        }              
    }
    
    function display()
    {        
        // разделы настроек
        $tabs = CI::$APP->db->distinct()
                                ->select('tabs')
                                ->where('module', CI::$APP->module ? CI::$APP->module : '')
                                ->get(CI::$APP->settings_m->table);
        $tabs = $tabs->num_rows() > 1 ? $tabs->result() : FALSE;
        
        // настройки
        $settings = CI::$APP->settings_m->by_module(CI::$APP->module ? CI::$APP->module : '')->get_all();
        
        if( $tabs )
        {
            $foo = array();
            foreach($settings as $setting)
            {
                if( $setting->tabs )
                {
                    $foo[$setting->tabs][] = $setting;
                }
            }
            
            $settings = $foo;
        }

        if( CI::$APP->module )
        {            
            // хлебные крошки
            CI::$APP->breadcrumbs->add_item('Настройки', 'admin/settings');
        }

        CI::$APP->template->render('settings::admin/index', array(
            'settings'=>$settings,
            'tabs'=>$tabs
        ));
    }    
}