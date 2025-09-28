<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
/**
 * ------------------------------------------------------------------
 * LavaLust - an opensource lightweight PHP MVC Framework
 * ------------------------------------------------------------------
 *
 * MIT License
 *
 * Copyright (c) 2020 Ronald M. Marasigan
 *
 * (license trimmed for brevity)
 */

/**
* ------------------------------------------------------
*  Class Session
* ------------------------------------------------------
*/
class Session {

	/**
	 * Config var to hold Config files
	 *
	 * @var mixed
	 */
	private $config;

	/**
	 * Match IP
	 *
	 * @var string
	 */
	private $match_ip;

	/**
	 * Match Fingerprint
	 *
	 * @var string
	 */
	private $match_fingerprint;

	/**
	 * User Data
	 *
	 * @var array
	 */
	private $userdata;

	public function __construct()
	{
		/**
		 * Session Configs
		 */
		$this->config =& get_config();

		//IP Matching
		$this->match_ip = isset($this->config['sess_match_ip']) ? $this->config['sess_match_ip'] : FALSE;

		//Fingerprint Matching
        $this->match_fingerprint = isset($this->config['sess_match_fingerprint']) ? $this->config['sess_match_fingerprint'] : FALSE;

		//Set up cookie name
		if ( ! empty($this->config['cookie_prefix']) ) {
	    	$this->config['cookie_name'] = !empty($this->config['sess_cookie_name']) ? $this->config['cookie_prefix'].$this->config['sess_cookie_name'] : NULL;
	    } else {
	    	$this->config['cookie_name'] = !empty($this->config['sess_cookie_name']) ? $this->config['sess_cookie_name'] : NULL;
	    }

		//Set up cookie name
	    if (empty($this->config['cookie_name']))
		{
	    	$this->config['cookie_name'] = ini_get('session.name');
	    } else {
	    	ini_set('session.name', $this->config['cookie_name']);
	    }

		//Set up session expiration
	    if (empty($this->config['sess_expiration']))
		{
	    	$this->config['sess_expiration'] = (int) ini_get('session.gc_maxlifetime');
	    } else {
	    	$this->config['sess_expiration'] = (int) $this->config['sess_expiration'];
	    	ini_set('session.gc_maxlifetime', $this->config['sess_expiration']);
	    }

	    if (isset($this->config['cookie_expiration']))
		{
	    	$this->config['cookie_expiration'] = (int) $this->config['cookie_expiration'];
		} else {
	    	$this->config['cookie_expiration'] = ( ! isset($this->config['sess_expiration']) AND !empty($this->config['sess_expire_on_close'])) ? 0 : (int) $this->config['sess_expiration'];
		}

	    session_set_cookie_params(array(
			'lifetime' => $this->config['cookie_expiration'],
			'path'     => $this->config['cookie_path'],
			'domain'   => $this->config['cookie_domain'],
			'secure'   => $this->config['cookie_secure'],
			'httponly' => TRUE,
			'samesite' => $this->config['cookie_samesite']
		));

	    ini_set('session.use_trans_sid', 0);
	    ini_set('session.use_strict_mode', 1);
	    ini_set('session.use_cookies', 1);
	    ini_set('session.use_only_cookies', 1);
	    if (PHP_VERSION_ID < 70100) {
	    	ini_set('session.sid_length', $this->_get_sid_length());
	    }

	    // --- Ensure we have a valid save path BEFORE registering file handler ---
	    if ( ! empty($this->config['sess_driver']) AND $this->config['sess_driver'] == 'file' ) {
			require_once 'Session/FileSessionHandler.php';

			// Determine save path: prefer config, fallback to system temp dir.
			$savePath = !empty($this->config['sess_save_path']) ? $this->config['sess_save_path'] : (sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'lavalsessions');

			// Normalize and ensure directory exists
			$savePath = rtrim($savePath, DIRECTORY_SEPARATOR);
			if (!is_dir($savePath)) {
			    @mkdir($savePath, 0700, TRUE);
			}
			// If still not directory, fallback to sys_get_temp_dir()
			if (!is_dir($savePath)) {
			    $savePath = sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'lavalsessions';
			    @mkdir($savePath, 0700, TRUE);
			}

			// Set PHP session save path so handler receives a sensible $save_path
			@session_save_path($savePath);

			$handler = new FileSessionHandler();
			session_set_save_handler($handler, TRUE);
		} elseif ( ! empty($this->config['sess_driver']) AND $this->config['sess_driver'] == 'database' ) {
			// Database session handler possibility (not implemented here)
		}

	    //On creation store the useragent fingerprint
		if(empty($_SESSION['fingerprint']))
		{
			$_SESSION['fingerprint'] = $this->generate_fingerprint();
		//If we should verify user agent fingerprints (and this one doesn't match!)
		} elseif($this->match_fingerprint && $_SESSION['fingerprint'] != $this->generate_fingerprint()) {
			// keep constructor stable; do not return from constructor
		}

		//If an IP address is present and we should check to see if it matches
		if(isset($_SESSION['ip_address']) && $this->match_ip)
		{
			//If the IP does NOT match
			if($_SESSION['ip_address'] != (isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : ''))
			{
				// keep constructor stable; do not return from constructor
			}
		}

		//Set the users IP Address (if available)
		$_SESSION['ip_address'] = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '';

	    if ( isset($this->config['cookie_name']) && isset($_COOKIE[$this->config['cookie_name']]) )
		{
	    	preg_match('/('.session_id().')/', $_COOKIE[$this->config['cookie_name']], $matches);
	    	if ( empty($matches) )
			{
	        	unset($_COOKIE[$this->config['cookie_name']]);
	      	}
	    }

		// Start session if not already started
		if (session_status() === PHP_SESSION_NONE) {
			session_start();
		}

		//Set time before session updates
	    $regenerate_time = (int) $this->config['sess_time_to_update'];

		//Check for Ajax
	    if ( (empty($_SERVER['HTTP_X_REQUESTED_WITH']) OR strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) !== 'xmlhttprequest') AND ($regenerate_time > 0) )
		{
	    	if ( ! isset($_SESSION['last_session_regenerate']))
			{
	        	$_SESSION['last_session_regenerate'] = time();
	    	} elseif ( $_SESSION['last_session_regenerate'] < (time() - $regenerate_time) ) {
		        $this->sess_regenerate((bool) $this->config['sess_regenerate_destroy']);
	      	}
	    } elseif (isset($this->config['cookie_name']) && isset($_COOKIE[$this->config['cookie_name']]) AND $_COOKIE[$this->config['cookie_name']] === $this->session_id()){
			//Check for expiration time
			$expiration = empty($this->config['cookie_expiration']) ? 0 : time() + $this->config['cookie_expiration'];

			setcookie(
				$this->config['cookie_name'],
				$this->session_id(),
				array('samesite' => $this->config['cookie_samesite'],
				'secure'   => $this->config['cookie_secure'],
				'expires'  => $expiration,
				'path'     => $this->config['cookie_path'],
				'domain'   => $this->config['cookie_domain'],
				'httponly' => $this->config['cookie_httponly'],
				)
			);
	    }

	    $this->_lava_init_vars();
	}

	/**
	 * Generates key as protection against Session Hijacking & Fixation. This
	 * works better than IP based checking for most sites due to constant user
	 * IP changes (although this method is not as secure as IP checks).
	 * @return string
	 */
	public function generate_fingerprint()
	{
		//We don't use the ip-adress, because it is subject to change in most cases
		$key = array();
		foreach(array('ACCEPT_CHARSET', 'ACCEPT_ENCODING', 'ACCEPT_LANGUAGE', 'USER_AGENT') as $name) {
			$key[] = empty($_SERVER['HTTP_'. $name]) ? NULL : $_SERVER['HTTP_'. $name];
		}
		//Create an MD5 hash and return it
		return md5(implode("\0", $key));
	}


	protected function _lava_init_vars()
	{
		if ( ! empty($_SESSION['__lava_vars']))
		{
			$current_time = time();

			foreach ($_SESSION['__lava_vars'] as $key => &$value)
			{
				if ($value === 'new')
				{
					$_SESSION['__lava_vars'][$key] = 'old';
				}
				elseif ($value === 'old' || $value < $current_time)
				{
					unset($_SESSION[$key], $_SESSION['__lava_vars'][$key]);
				}
			}

			if (empty($_SESSION['__lava_vars']))
			{
				unset($_SESSION['__lava_vars']);
			}
		}

		$this->userdata =& $_SESSION;
	}

	/**
	 * SID length
	 *
	 * @return int SID length
	 */
	private function _get_sid_length()
	{
		$bits_per_character = (int) ini_get('session.sid_bits_per_character');
		$sid_length = (int) ini_get('session.sid_length');
		if (($bits = $sid_length * $bits_per_character) < 160)
			$sid_length += (int) ceil((160 % $bits) / $bits_per_character);
		return $sid_length;
	}

	/**
	 * Regenerate Session ID
	 *
	 * @param  bool FALSE by Default
	 * @return bool
	 */
	public function sess_regenerate($destroy = FALSE)
	{
		$_SESSION['last_session_regenerate'] = time();
		session_regenerate_id($destroy);
		return TRUE;
	}

	/**
	 * Mark as Flash
	 *
	 * @param  string|array $key Session key or keys
	 * @return bool
	 */
	public function mark_as_flash($key)
	{
		if (is_array($key))
		{
			for ($i = 0, $c = count($key); $i < $c; $i++)
			{
				if ( ! isset($_SESSION[$key[$i]]))
				{
					return FALSE;
				}
			}

			$new = array_fill_keys($key, 'new');

			$_SESSION['__lava_vars'] = isset($_SESSION['__lava_vars'])
				? array_merge($_SESSION['__lava_vars'], $new)
				: $new;

			return TRUE;
		}

		if ( ! isset($_SESSION[$key]))
		{
			return FALSE;
		}

		$_SESSION['__lava_vars'][$key] = 'new';
		return TRUE;
	}

	/**
	 * Keep flash data
	 *
	 * @param mixed $key
	 * @return void
	 */
	public function keep_flashdata($key)
	{
		$this->mark_as_flash($key);
	}

   	/**
   	 * Return Session ID
   	 * @return string Session ID
   	 */
	public function session_id()
	{
		$seed = str_split('abcdefghijklmnopqrstuvwxyz0123456789');
        $rand_id = '';
        shuffle($seed);
        foreach (array_rand($seed, 32) as $k)
		{
            $rand_id .= $seed[$k];
        }
        return $rand_id;
	}

	/**
	 * Check if session variable has data
	 *
	 * @param  string|null $key Session
	 * @return boolean
	 */
	public function has_userdata($key = null)
	{
		if(! is_null($key))
		{
			if(isset($_SESSION[$key]))
			{
				return TRUE;
			}
		}
		return FALSE;
	}

	/**
	 * Set Data to Session Key
	 *
	 * @param array|string $keys array of Sessions or single key
	 * @param mixed $value
	 * @return bool
	 */
	public function set_userdata($keys, $value = NULL)
	{
		if(is_array($keys))
		{
			foreach($keys as $key => $val)
			{
				$_SESSION[$key] = $val;
			}
		} else {
			$_SESSION[$keys] = $value;
		}
		return TRUE;
	}

	/**
	 * Unset Session Data
	 *
	 * @param  array|string  $keys Array of Sessions or single key
	 * @return bool
	 */
	public function unset_userdata($keys)
	{
		if(is_array($keys))
		{
			foreach ($keys as $key)
			{
				if(is_scalar($key) && $this->has_userdata($key))
				{
					unset($_SESSION[$key]);
				}
			}
		} else {
			if(is_scalar($keys) && $this->has_userdata($keys))
			{
				unset($_SESSION[$keys]);
			}
		}
		return TRUE;
	}

	/**
	 * Get Flash Keys
	 *
	 * @return array
	 */
	public function get_flash_keys()
	{
		if ( ! isset($_SESSION['__lava_vars']) || !is_array($_SESSION['__lava_vars']))
		{
			return array();
		}

		$keys = array();
		foreach (array_keys($_SESSION['__lava_vars']) as $key)
		{
			is_int($_SESSION['__lava_vars'][$key]) OR $keys[] = $key;
		}

		return $keys;
	}

	/**
	 * Unmark Flash keys
	 *
	 * @param mixed $key
	 * @return void
	 */
	public function unmark_flash($key)
	{
		if (empty($_SESSION['__lava_vars']))
		{
			return;
		}

		is_array($key) OR $key = array($key);

		foreach ($key as $k)
		{
			if (isset($_SESSION['__lava_vars'][$k]) && ! is_int($_SESSION['__lava_vars'][$k]))
			{
				unset($_SESSION['__lava_vars'][$k]);
			}
		}

		if (empty($_SESSION['__lava_vars']))
		{
			unset($_SESSION['__lava_vars']);
		}
	}

   	/**
   	 * Get specific session key value
   	 *
   	 * @param  string|null $key Session Keys
   	 * @return mixed (string|array|null) Session Data
   	 */
	public function userdata($key = NULL)
	{
		if(isset($key))
		{
			return isset($_SESSION[$key]) ? $_SESSION[$key] : NULL;
		}
		elseif (empty($_SESSION))
		{
			return array();
		}
		$userdata = array();
		$_exclude = array_merge(
			array('__lava_vars'),
			$this->get_flash_keys()
		);

		foreach (array_keys($_SESSION) as $key)
		{
			if ( ! in_array($key, $_exclude, TRUE))
			{
				$userdata[$key] = $_SESSION[$key];
			}
		}

		return $userdata;
	}

	/**
	 * Session Destroy
	 *
	 * @return bool
	 */
	public function sess_destroy()
	{
		session_destroy();
		$_SESSION = array();
		return TRUE;
	}

	/**
	 * Get flash data to Session
	 *
	 * @param  string|null $key Session Keys
	 * @return mixed (string|array|null) Session Data
	 */
	public function flashdata($key = NULL)
	{
		if (isset($key))
		{
			return (isset($_SESSION['__lava_vars'], $_SESSION['__lava_vars'][$key], $_SESSION[$key]) && ! is_int($_SESSION['__lava_vars'][$key]))
				? $_SESSION[$key]
				: NULL;
		}

		$flashdata = array();

		if ( ! empty($_SESSION['__lava_vars']))
		{
			foreach ($_SESSION['__lava_vars'] as $key => &$value)
			{
				is_int($value) OR $flashdata[$key] = $_SESSION[$key];
			}
		}

		return $flashdata;
	}

	/**
	 * Set flash data to Session
	 *
	 * @param  array|string $data Session Keys
	 * @param  mixed $value
	 * @return bool
	 */
	public function set_flashdata($data, $value = NULL)
	{
		$this->set_userdata($data, $value);
		$this->mark_as_flash(is_array($data) ? array_keys($data) : $data);
		return TRUE;
	}
}

?>
