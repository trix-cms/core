<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/* load the MX_Router class */
require APPPATH."third_party/MX/Router.php";

class Trix_Router extends MX_Router {
    
    function fetch_method()
    {
        $class = str_replace($this->config->item('controller_suffix'), '', $this->fetch_class());
        
        if ($this->method == $class)
		{
			return 'action_index';
		}

		return 'action_'. $this->method;
    }
    
    /**
     * Возращает имя текущего контроллера
     */
    function fetch_controller()
    {
        return str_replace('_controller', '', $this->fetch_class());
    }
    
    /**
     * Возращает имя текущего экшена
     */
    function fetch_action()
    {
        return str_replace('action_', '', $this->fetch_method());
    }
    
    /** Locate the controller **/
	public function locate($segments) {
		
		$this->module = '';
		$this->directory = '';
		$ext = $this->config->item('controller_suffix').EXT;

		/* use module route if available */
		if (isset($segments[0]) AND $routes = Modules::parse_routes($segments[0], implode('/', $segments))) {
			$segments = $routes;
		}
	
		/* get the segments array elements */
		list($module, $directory, $controller) = array_pad($segments, 3, NULL);

		/* check modules */
		foreach (Modules::$locations as $location => $offset) {
		
			/* module exists? */
			if (is_dir($source = $location.$module.'/controllers/')) {
				
				$this->module = $module;
				$this->directory = $offset.$module.'/controllers/';
				
				/* module sub-controller exists? */
				if($directory AND is_file($source.$directory.$ext)) {
					return array_slice($segments, 1);
				}
					
				/* module sub-directory exists? */
				if($directory AND is_dir($source.$directory.'/')) {

					$source = $source.$directory.'/';
					$this->directory .= $directory.'/';

					/* module sub-directory controller exists? */
					if(is_file($source.$directory.$ext)) {
						return array_slice($segments, 1);
					}
				
					/* module sub-directory sub-controller exists? */
					if($controller AND is_file($source.$controller.$ext))	{
						return array_slice($segments, 2);
					}
				}
                
                /* module sub-sub-directory exists? */
                if( isset($segments[2]) )
                {
                    if($directory AND is_dir($source.$segments[2].'/')) {
                        				    
    					$source = $source.$segments[2].'/'; 
    					$this->directory .= $segments[2].'/';
    
    					/* module sub-directory controller exists? */
    					if(is_file($source.$segments[3].$ext)) {
    						return array_slice($segments, 3);
    					}
    				
    					/* module sub-directory sub-controller exists? */
    					if($controller AND is_file($source.$controller.$ext))	{
    						return array_slice($segments, 2);
    					}
    				}
                }
				
				/* module controller exists? */			
				if(is_file($source.$module.$ext)) {
					return $segments;
				}
			}
		}
		
		/* application controller exists? */			
		if (is_file(APPPATH.'controllers/'.$module.$ext)) {
			return $segments;
		}
		
		/* application sub-directory controller exists? */
		if($directory AND is_file(APPPATH.'controllers/'.$module.'/'.$directory.$ext)) {
			$this->directory = $module.'/';
			return array_slice($segments, 1);
		}
		
		/* application sub-directory default controller exists? */
		if (is_file(APPPATH.'controllers/'.$module.'/'.$this->default_controller.$ext)) {
			$this->directory = $module.'/';
			return array($this->default_controller);
		}
	}
}