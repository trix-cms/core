<?php 

namespace Utility;

/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 4.3.2 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2009, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * CodeIgniter String Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/helpers/string_helper.html
 */

// ------------------------------------------------------------------------

/**
 * Trim Slashes
 *
 * Removes any leading/traling slashes from a string:
 *
 * /this/that/theother/
 *
 * becomes:
 *
 * this/that/theother
 *
 * @access	public
 * @param	string
 * @return	string
 */
class String {

	static function trim_slashes($str)
	{
		return trim($str, '/');
	}

    // ------------------------------------------------------------------------

    /**
     * Strip Slashes
     *
     * Removes slashes contained in a string or in an array
     *
     * @access	public
     * @param	mixed	string or array
     * @return	mixed	string or array
     */
	static function strip_slashes($str)
	{
		if (is_array($str))
		{
			foreach ($str as $key => $val)
			{
				$str[$key] = self::strip_slashes($val);
			}
		}
		else
		{
			$str = stripslashes($str);
		}

		return $str;
	}

    // ------------------------------------------------------------------------

    /**
     * Strip Quotes
     *
     * Removes single and double quotes from a string
     *
     * @access	public
     * @param	string
     * @return	string
     */
	static function strip_quotes($str)
	{
		return str_replace(array('"', "'"), '', $str);
	}

    // ------------------------------------------------------------------------

    /**
     * Quotes to Entities
     *
     * Converts single and double quotes to entities
     *
     * @access	public
     * @param	string
     * @return	string
     */
	static function quotes_to_entities($str)
	{
		return str_replace(array("\'","\"","'",'"'), array("&#39;","&quot;","&#39;","&quot;"), $str);
	}

    // ------------------------------------------------------------------------
    /**
     * Reduce Double Slashes
     *
     * Converts double slashes in a string to a single slash,
     * except those found in http://
     *
     * http://www.some-site.com//index.php
     *
     * becomes:
     *
     * http://www.some-site.com/index.php
     *
     * @access	public
     * @param	string
     * @return	string
     */
	static function reduce_double_slashes($str)
	{
		return preg_replace("#([^:])//+#", "\\1/", $str);
	}

    // ------------------------------------------------------------------------

    /**
     * Reduce Multiples
     *
     * Reduces multiple instances of a particular character.  Example:
     *
     * Fred, Bill,, Joe, Jimmy
     *
     * becomes:
     *
     * Fred, Bill, Joe, Jimmy
     *
     * @access	public
     * @param	string
     * @param	string	the character you wish to reduce
     * @param	bool	TRUE/FALSE - whether to trim the character from the beginning/end
     * @return	string
     */
	static function reduce_multiples($str, $character = ',', $trim = FALSE)
	{
		$str = preg_replace('#'.preg_quote($character, '#').'{2,}#', $character, $str);

		if ($trim === TRUE)
		{
			$str = trim($str, $character);
		}

		return $str;
	}

    // ------------------------------------------------------------------------

    /**
     * Create a Random String
     *
     * Useful for generating passwords or hashes.
     *
     * @access	public
     * @param	string 	type of random string.  Options: alunum, numeric, nozero, unique
     * @param	integer	number of characters
     * @return	string
     */
	static function random($type = 'alnum', $len = 8)
	{
		switch($type)
		{
			case 'alnum'	:
			case 'numeric'	:
			case 'nozero'	:

					switch ($type)
					{
						case 'alnum'	:	$pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
							break;
						case 'numeric'	:	$pool = '0123456789';
							break;
						case 'nozero'	:	$pool = '123456789';
							break;
					}

					$str = '';
					for ($i=0; $i < $len; $i++)
					{
						$str .= substr($pool, mt_rand(0, strlen($pool) -1), 1);
					}
					return $str;
			  break;
			case 'unique' : return md5(uniqid(mt_rand()));
			  break;
		}
	}

    // ------------------------------------------------------------------------

    /**
     * Alternator
     *
     * Allows strings to be alternated.  See docs...
     *
     * @access	public
     * @param	string (as many parameters as needed)
     * @return	string
     */
	static function alternator()
	{
		static $i;

		if (func_num_args() == 0)
		{
			$i = 0;
			return '';
		}
		$args = func_get_args();
		return $args[($i++ % count($args))];
	}

    // ------------------------------------------------------------------------

    /**
     * Repeater function
     *
     * @access	public
     * @param	string
     * @param	integer	number of repeats
     * @return	string
     */
	static function repeater($data, $num = 1)
	{
		return (($num > 0) ? str_repeat($data, $num) : '');
	}

    /**
     * Multibyte replace
     *
     * @access	public
     * @param	string
     * @param	string
     * @param	string
     * @return	string
     */
    function mb_replace($search, $replace, $subject) {

        if(is_array($subject)) {
            $ret = array();
            foreach($subject as $key => $val) {
                $ret[$key] = self::mb_str_replace($search, $replace, $val);
            }
            return $ret;
        }

        foreach((array) $search as $key => $s) {
            if($s == '') {
                continue;
            }
            $r = !is_array($replace) ? $replace : (array_key_exists($key, $replace) ? $replace[$key] : '');
            $pos = mb_strpos($subject, $s);
            while($pos !== false) {
                $subject = mb_substr($subject, 0, $pos) . $r . mb_substr($subject, $pos + mb_strlen($s));
                $pos = mb_strpos($subject, $s, $pos + mb_strlen($r));
            }
        }

        return $subject;

    }
}