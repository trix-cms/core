<?php

class Settings_Controller extends Controllers\Backend {
    
    function __construct()
    {
        parent::__construct();
    }
    
    function action_index()
    {
        $this->settings->display();
    }    
    
    function action_edit($module = 'settings')
    {
        $settings = $this->settings_m->by_module($module)->get_all();

        foreach($settings as $setting)
        {
            $this->settings_m->where('slug', $setting->slug)->set_value($this->input->post($setting->slug))->update();
        }
        
        $this->set_message(Notification::SUCCESS, 'Настройки сохранены');

        URL::referer();
    } 
}