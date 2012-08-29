<?php

class Modules_Controller extends Trix\Controllers\Backend {
    
    function __construct()
    {
        parent::__construct();
        
        $this->load->model('modules/modules_m');
        
        // хлебные крошки
        $this->breadcrumbs->add_item('Модули', 'admin/modules');
        
        // вложенный шаблон
        $this->template->set_layout('layout');
    }
    
    /**
     * Список модулей
     */
    function action_index()
    {
        $modules = $this->modules_m->by_is_core(0)->get_all();
        
        $core_modules = $this->modules_m->by_is_core(1)->get_all();
        
        // хлебные крошки
        $this->breadcrumbs->add_item('Установленные', 'admin/modules');
        
        $this->render('index', array(
            'modules'=>$modules,
            'core_modules'=>$core_modules
        ));
    }
    
    /**
     * Включение, выключение модуля
     */
    function action_enable($mode = 'off', $slug)
    {
        $this->modules_m->by_slug($slug)->set('enable', $mode == 'on')->update();
        
        if( $this->is_ajax() )
        {
            echo json_encode(array(
                'success'=>TRUE
            ));
        }
        else
        {
            $this->alert->set_flash(Alert::SUCCESS, 'Модуль '. ($mode == 'on' ? 'включен' : 'отключен'));
            
            URL::referer();
        }
    }
    
    /**
     * Поиск дополнительных модулей
     */
    function action_addons()
    {
        $curl = new Utility\Curl;
        
        // доступные модули
        $content = $curl->simple_get(Modules\Addons\Base::ADDONS_URL);
        $content = $content ? unserialize($curl->simple_get(Modules\Addons\Base::ADDONS_URL)) : FALSE;
        
        // массиы установленных модулей
        $installed_modules = array();
        
        if( $content === FALSE )
        {
            $content = 'Возникли какие-то проблемы на сервере. Попробуйте позже.';
        }
        else
        {
            $modules = $this->modules_m->get_all();
            
            if( $modules )
            {
                foreach($modules as $item)
                {
                    $installed_modules[$item->slug . $item->author] = $item;
                }
            }
        }
        
        // хлебные крошки
        $this->breadcrumbs->add_item('Доступные дополнения', 'admin/modules');
        
        $this->render('addons', array(
            'items'=>$content,
            'installed_modules'=>$installed_modules
        ));
    }
    
    /**
     * Установка модуля
     */
    function action_install($id)
    {
        $installator = new Modules\Addons\Install($id);
        $installator->run();
        
        $this->success_return('Модуль успешно установлен');
    }
    
    /**
     * Удаление модуля
     */
    function action_uninstall($id)
    {
        $uninstall = new Modules\Addons\Uninstall($id);
        $uninstall->run();
        
        $this->success_return('Модуль успешно удален');
    }
    
    /**
     * Обновление модуля
     */
    function action_update($id)
    {
        $update = new Modules\Addons\Update($id);
        $update->run();
        
        $this->success_return('Модуль успешно обновлен');
    }
    
    private function success_return($str)
    {
        if( $this->is_ajax() )
        {
            echo json_encode(array(
                'success'=>TRUE,
                'message'=>$str
            ));
        }
        else
        {
            $this->alert->set_flash(Alert::SUCCESS, $str);
            
            URL::referer();
        }
    }
}