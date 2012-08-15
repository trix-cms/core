<?php

/**
 * Вспомогательные скрипты
 */
class Utility_Controller extends MX_Controller {
    
    function __construct()
    {
        parent::__construct();
        
        // закомментировать для включения
        show_404();
    }
    
    /**
     * Добавление или удаление префикса у таблиц
     * 
     * @param string Режим(добавление - add, удаление - remove)
     */
    function action_table_prefix($mode = false, $prefix = '')
    {
        // загружаем бд
        $this->load->database();
        
        if( $mode != 'add' AND $mode != 'remove' )
        {
            echo 'Не указан режим или префикс';
            exit;
        }
        
        // список таблиц
        $tables = $this->db->list_tables();
        
        foreach($tables as $table)
        {            
            if( $mode == 'add' )
            {
                $old_table_name = $table;
                $new_table_name = $prefix . $table;
            }
            else
            {
                $old_table_name = $table;
                $new_table_name = str_replace($prefix, '', $table);
            }
            
            $sql = "ALTER TABLE $old_table_name RENAME TO $new_table_name";
            echo $sql.'<br />';
            $this->db->query($sql);
        }
        
        echo 'Таблицы переименнованы';
    }
}