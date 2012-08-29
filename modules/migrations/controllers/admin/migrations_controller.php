<?php

class Migrations_Controller extends Trix\Controllers\Backend {
    
    function __construct()
    {
        parent::__construct();
        
        // загружаем класс
        $this->load->library('migration');
        
        // загружаем модель
        $this->load->model('migrations/migrations_m');
        
        // хлебные крошки
        $this->breadcrumbs->add_item('Миграции', 'admin/migrations');
        
        // layout
        $this->template->set_layout('layout');
    }
    
    function action_index()
    {
        // файлы миграций
        $migrations = array_reverse(Migrations\Helper::get_migrations());
        
        // текущая версия
        $version = $this->migrations_m->get_version();

        // последняя доступная версия
        $latest = $this->migrations_m->get_latest();
        
        // можно ли обновить до последней версии
        $upgrade_to_latest = $latest > $version;
        
        $this->render('index', array(
            'migrations'=>$migrations,
            'version'=>$version,
            'upgrade_to_latest'=>$upgrade_to_latest
        ));
    }
    
    /**
     * Обновление схемы БД до версии указанной в конфигурационном файле
     */
    function action_current()
    {
        if ( ! $this->migration->current())
        {
        	$this->alert->set(Trix\Alert::ERROR, $this->migration->error_string());
        }
        else
        {
            $this->alert->set(
                Trix\Alert::SUCCESS, 
                'Версия БД обновлена до '. $this->config->item('migration_version')
            );
        }
        
        URL::referer();
    }
    
    /**
     * Обновление схемы БД до последней версии
     */
    function action_latest()
    {
        if ( ! $this->migration->latest())
        {
        	$this->alert->set(Trix\Alert::ERROR, $this->migration->error_string());
        }
        else
        {
            $this->alert->set(Trix\Alert::SUCCESS, 'Версия БД обновлена до последней');
        }
        
        URL::referer();
    }
    
    /**
     * Обновление схемы БД до указанной версии
     */
    function action_version($version)
    {
        if ( ! $this->migration->version($version))
        {
        	$this->alert->set(Trix\Alert::ERROR, $this->migration->error_string());
        }
        else
        {
            $this->alert->set(
                Trix\Alert::SUCCESS, 
                'БД обновлена до версии '. $version
            );
        }
        
        URL::referer();
    }
    
    /**
     * Создание файла миграции
     */
    function action_create()
    {
        $this->load->library('Trix\Form_validation');
        
        // обрабатываем форму
        if( $this->input->post('submit') )
        {
            // правила валидации
            $this->form_validation->set_rules('name', 'Имя файла', 'trim|required');
            
            // валидация данных
            if( $this->form_validation->run() )
            {
                // нужные переменные
                $name = $this->input->post('name');
                
                // создаем файл миграции
                if( $this->create($name) )
                {
                    // уведомительное сообщение
                    $this->alert->set(Trix\Alert::SUCCESS, 'Файл миграции создан');
                    
                    // редиректим
                    URL::redirect('admin/migrations');
                }
                else
                {
                    // файл миграции не был создан по какой-то причине
                    $this->alert->set(Trix\Alert::ERROR, $this->error_string);
                }                
            }
            else
            {
                // данные формы не прошли валидацию
                $this->alert->set(Trix\Alert::ERROR, validation_errors());
            }
        }
        
        // хлебные крошки
        $this->breadcrumbs->add_item('Создание файла миграции', 'admin/migrations/create');
        
        $this->render('create');
    }
    
    /**
     * Создание файла миграции
     */    
    function create($name)
    {
        // последняя версия
        $latest = $this->migrations_m->get_latest();
        
        // имя файла
        $version = $latest + 1;
        $zeros = str_repeat(0, 3 - strlen($version));
        $file_name = $zeros . $version .'_'. $name .'.php';
        
        $file_path = $this->config->item('migration_path') . $file_name;
        
        // проверяем, что файла не существует
        if( file_exists($file_path) )
        {
            $this->error_string = 'Файл с таким именем уже существует';
            return FALSE;
        }
        
        // шаблон файла миграции
        $template = $this->load->view('template', array('name'=>$name), TRUE);
        
        // создаем файл
        file_put_contents($file_path, $template);
        
        return TRUE;
    }
}