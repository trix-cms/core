<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/* load the MX_Loader class */
require APPPATH."third_party/MX/Loader.php";

class MY_Loader extends MX_Loader {
    
    /** Load a module view **/
	public function view($view, $vars = array(), $return = FALSE) 
    {        
        // если рендер из модуля, то грузим из соответсвующего модуля
        if( $this->module != '' AND strstr($view, '::') === FALSE )
        {
            $view = $this->module .'::'. $view;
        }
        
        // пути поиска файла
        $this->_ci_view_paths = array();
        
        // расположение модулей
        $path = CI::$APP->config->item('modules_locations');
        $modules_locations = key( $path );
        
        $admin_folder = CI::$APP->is_backend ? 'admin/' : '';

        if( strstr($view, '::') !== FALSE )
        {
            list($module, $view) = explode('::', $view);
            
            // поиск в теме с модулем
    		$this->_ci_view_paths[] = CI::$APP->config->item('theme_location').CI::$APP->template->theme . '/views/' . $module .'/';
            
            // поиск в текущем модуле
            $this->_ci_view_paths[] = $modules_locations . $module .'/'. 'views/' . $admin_folder;
            
            // поиск в системной папке
            $this->_ci_view_paths[] = APPPATH . 'views/' . $admin_folder;
        }
        else
        {
            // поиск в теме
    		$this->_ci_view_paths[] = CI::$APP->config->item('theme_location') . CI::$APP->template->theme . '/views/';
            
            // поиск в системной папке
            $this->_ci_view_paths[] = APPPATH . 'views/' . $admin_folder;
        }
        
		return $this->_ci_load(array(
            '_ci_view'=>$view, 
            '_ci_vars'=>$this->_ci_object_to_array($vars), 
            '_ci_return'=>$return
        ));
	}
    
    public function _ci_load($_ci_data) {
        
        $file_exists = FALSE;
		
		foreach (array('_ci_view', '_ci_vars', '_ci_path', '_ci_return') as $_ci_val) {
			$$_ci_val = ( ! isset($_ci_data[$_ci_val])) ? FALSE : $_ci_data[$_ci_val];
		}

		if ($_ci_path == '') 
        {
            // расширение
		    $_ci_ext = pathinfo($_ci_view, PATHINFO_EXTENSION);
			$_ci_file = ($_ci_ext == '') ? $_ci_view.EXT : $_ci_view;
            
            // ищем файл
            foreach ($this->_ci_view_paths as $view_file)
    		{
    			if (file_exists($view_file.$_ci_file))
    			{
    				$_ci_path = $view_file.$_ci_file;
    				$file_exists = TRUE;
    				break;
    			}
    		}
		} 
        else 
        {
            $file_exists = TRUE;
			$_ci_file = basename($_ci_path);
		}
        
        // если не нашли, выводим ошибку
        if ( ! $file_exists && ! file_exists($_ci_path))
		{
			show_error('Unable to load the requested file: '.$_ci_file);
		}

		if (is_array($_ci_vars)) 
			$this->_ci_cached_vars = array_merge($this->_ci_cached_vars, $_ci_vars);
		
		extract($this->_ci_cached_vars);

		ob_start();

		if ((bool) @ini_get('short_open_tag') === FALSE AND CI::$APP->config->item('rewrite_short_tags') == TRUE) {
			echo eval('?>'.preg_replace("/;*\s*\?>/", "; ?>", str_replace('<?=', '<?php echo ', file_get_contents($_ci_path))));
		} else {
			include($_ci_path); 
		}

		log_message('debug', 'File loaded: '.$_ci_path);

		if ($_ci_return == TRUE) return ob_get_clean();

		if (ob_get_level() > $this->_ci_ob_level + 1) {
			ob_end_flush();
		} else {
			CI::$APP->output->append_output(ob_get_clean());
		}
	}	
}