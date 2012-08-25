<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
* Code Igniter
*
* An open source application development framework for PHP 4.3.2 or newer
*
* @package     CodeIgniter
* @author      Dariusz Debowczyk
* @copyright   Copyright (c) 2006, D.Debowczyk
* @license     http://www.codeignitor.com/user_guide/license.html
* @link        http://www.codeigniter.com
* @since       Version 1.0
* @filesource
*/

// ------------------------------------------------------------------------

/**
* Session class using native PHP session features and hardened against session fixation.
*
* @package     CodeIgniter
* @subpackage  Libraries
* @category    Sessions
* @author      Dariusz Debowczyk
* @link        http://www.codeigniter.com/user_guide/libraries/sessions.html
*/
class CI_Session {

	var $flash_key = 'flash'; // prefix for "flash" variables (eg. flash:new:message)

	function __construct()
	{
		$this->object =& get_instance();
		log_message('debug', "Native_session Class Initialized");
		session_set_cookie_params(60*60*24*365*2);

		$this->_set_session_settings();

		$this->_sess_run();
	}

	function _set_session_settings()
	{
	    if( !$this->object->config->item('sess_use_database') )
		{
		    return;
		}

	    $this->life_time = $this->object->config->item('sess_expiration');
	    $this->table_name = $this->object->config->item('sess_table_name');

	    ini_set('session.gc_maxlifetime', $this->life_time);
        ini_set('session.gc_divisor', 100);

        session_set_save_handler(
            array($this, 'open'),
            array($this, 'close'),
            array($this, 'read'),
            array($this, 'write'),
            array($this, 'destroy'),
            array($this, 'gc')
        );
    }

	/**
    * Regenerates session id
    */
	function _regenerate_id()
	{
		// copy old session data, including its id
		$old_session_id = session_id();
		$old_session_data = $_SESSION;

		// regenerate session id and store it
		session_regenerate_id();
		$new_session_id = session_id();

		// switch to the old session and destroy its storage
		session_id($old_session_id);
		session_destroy();

		// switch back to the new session id and send the cookie
		session_id($new_session_id);
		session_start();

		// restore the old session data into the new session
		$_SESSION = $old_session_data;

		// update the session creation time
		$_SESSION['regenerated'] = time();

		// session_write_close() patch based on this thread
		// http://www.codeigniter.com/forums/viewthread/1624/
		// there is a question mark ?? as to side affects

		// end the current session and store session data.
		session_write_close();
	}

	/**
    * Regenerates session id
    */
	function regenerate_id()
	{
		// copy old session data, including its id
		$old_session_id = session_id();
		$old_session_data = $_SESSION;

		// regenerate session id and store it
		session_regenerate_id();
		$new_session_id = session_id();

		// switch to the old session and destroy its storage
		session_id($old_session_id);
		session_destroy();

		// switch back to the new session id and send the cookie
		session_id($new_session_id);
		$this->_set_session_settings();
		session_start();

		// restore the old session data into the new session
		$_SESSION = $old_session_data;

		// update the session creation time
		$_SESSION['regenerated'] = time();

		// session_write_close() patch based on this thread
		// http://www.codeigniter.com/forums/viewthread/1624/
		// there is a question mark ?? as to side affects

		// end the current session and store session data.
		session_write_close();
	}

	/**
    * Destroys the session and erases session storage
    */
	function sess_destroy()
	{
	    session_destroy();
		unset($_SESSION);
		if ( isset( $_COOKIE[session_name()] ) )
		{
			setcookie(session_name(), '', time()-42000, '/');
		}
		
	}

	/**
    * Reads given session attribute value
    */
	function userdata($item)
	{
		if($item == 'session_id'){ //added for backward-compatibility
			return session_id();
		}else{
			return ( ! isset($_SESSION[$item])) ? false : $_SESSION[$item];
		}
	}
    
    function all_userdata()
    {
        return isset($_SESSION) ? $_SESSION : false;
    }

	/**
    * Sets session attributes to the given values
    */
	function set_userdata($newdata = array(), $newval = '')
	{
		if (is_string($newdata))
		{
			$newdata = array($newdata => $newval);
		}

		if (count($newdata) > 0)
		{
			foreach ($newdata as $key => $val)
			{
				$_SESSION[$key] = $val;
			}
		}
	}

	/**
    * Erases given session attributes
    */
	function unset_userdata($newdata = array())
	{
		if (is_string($newdata))
		{
			$newdata = array($newdata => '');
		}

		if (count($newdata) > 0)
		{
			foreach ($newdata as $key => $val)
			{
				unset($_SESSION[$key]);
			}
		}
	}

	/**
    * Starts up the session system for current request
    */
	function _sess_run()
	{
		session_start();
		$session_id_ttl = $this->object->config->item('sess_time_to_update');

		if (is_numeric($session_id_ttl))
		{
			if ($session_id_ttl > 0)
			{
				$this->session_id_ttl = $this->object->config->item('sess_time_to_update');
			}
			else
			{
				$this->session_id_ttl = (60*60*24*365*2);
			}
		}



        if(isset($_COOKIE['PHPSESSID'])) session_id($_COOKIE['PHPSESSID']);
		// check if session id needs regeneration
		if ( $this->_session_time_to_update() )
		{
			// regenerate session id (session data stays the
			// same, but old session storage is destroyed)
            if(!$this->object->agent->is_robot())
            {
                $this->regenerate_id();
            }
		}

        $this->set_userdata('ip_address', $_SERVER['REMOTE_ADDR']);
		$this->set_userdata('user_agent', $_SERVER['HTTP_USER_AGENT']);

		// delete old flashdata (from last request)
		$this->_flashdata_sweep();

		// mark all new flashdata as old (data will be deleted before next request)
		$this->_flashdata_mark();
	}

	/**
    * Checks if session need update
    */
	function _session_time_to_update()
	{
		if ( !isset( $_SESSION['regenerated'] ) )
		{
			$_SESSION['regenerated'] = time();
			return false;
		}

		$expiry_time = time() - $this->session_id_ttl;

		if ( $_SESSION['regenerated'] <=  $expiry_time )
		{
			return true;
		}

		return false;
	}

	/**
    * Sets "flash" data which will be available only in next request (then it will
    * be deleted from session). You can use it to implement "Save succeeded" messages
    * after redirect.
    */
	function set_flashdata($key, $value)
	{
		$flash_key = $this->flash_key.':new:'.$key;
		$this->set_userdata($flash_key, $value);
	}

	/**
    * Keeps existing "flash" data available to next request.
    */
	function keep_flashdata($key)
	{
		$old_flash_key = $this->flash_key.':old:'.$key;
		$value = $this->userdata($old_flash_key);

		$new_flash_key = $this->flash_key.':new:'.$key;
		$this->set_userdata($new_flash_key, $value);
	}

	/**
    * Returns "flash" data for the given key.
    */
	function flashdata($key)
	{
		$flash_key = $this->flash_key.':old:'.$key;
		return $this->userdata($flash_key);
	}

	/**
    * PRIVATE: Internal method - marks "flash" session attributes as 'old'
    */
	function _flashdata_mark()
	{
		foreach ($_SESSION as $name => $value)
		{
			$parts = explode(':new:', $name);
			if (is_array($parts) && count($parts) == 2)
			{
				$new_name = $this->flash_key.':old:'.$parts[1];
				$this->set_userdata($new_name, $value);
				$this->unset_userdata($name);
			}
		}
	}

	/**
    * PRIVATE: Internal method - removes "flash" session marked as 'old'
    */
	function _flashdata_sweep()
	{
		foreach ($_SESSION as $name => $value)
		{
			$parts = explode(':old:', $name);
			if (is_array($parts) && count($parts) == 2 && $parts[0] == $this->flash_key)
			{
				$this->unset_userdata($name);
			}
		}
	}

	function open( $save_path, $session_name )
    {
        return true;
     }

     function close()
     {
        return true;
     }

     function read($session_id)
     {
        if( $this->object->agent->is_robot() )
        {
            $session_id = $this->object->agent->robot();
        }

        $this->object->db->select('user_data');
        $this->object->db->where('session_id', $session_id);
        $query = $this->object->db->get($this->table_name);

        return $query->num_rows() ? $query->row()->user_data : '';
     }

     function write($session_id, $data)
     {
        if( $this->object->agent->is_robot() )
        {
            $session_id = $this->object->agent->robot();
        }

        $this->object->db->where('session_id', $session_id);
        $count = $this->object->db->count_all_results($this->table_name);

        $data_m['user_data']        = $data;
        $data_m['last_activity']    = time();
        $data_m['ip_address']       = $_SERVER['REMOTE_ADDR'];
        $data_m['user_agent']       = $_SERVER['HTTP_USER_AGENT'];
        $data_m['request_uri']      = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
        $data_m['user_id']          = (int)$this->userdata('user_id');

        if( $count == 1 )
        {
            $this->object->db->where('session_id', $session_id);
            $this->object->db->update($this->table_name, $data_m);
        }
        else
        {
            $data_m['session_id'] = $session_id;
            $this->object->db->insert($this->table_name, $data_m);
        }

        return TRUE;
     }

     function destroy($session_id)
     {
        if( $this->object->agent->is_robot() )
        {
            $session_id = $this->object->agent->robot();
        }

        $this->object->db->where('session_id', $session_id);
        $this->object->db->delete($this->table_name);

        return TRUE;
     }

     function gc()
     {
        $this->object->db->where('last_activity <', 'UNIX_TIMESTAMP(NOW()) - '.$this->life_time, FALSE);
        $this->object->db->or_where('user_data', '');

        $this->object->db->delete($this->table_name);

        return true;
     }
}