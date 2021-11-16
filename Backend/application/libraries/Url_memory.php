<?php

class Url_memory {

	protected $CI;	

	public function __construct() {
		$this->CI = & get_instance();
		$this->log();
	}

	public function log() {
		if (!$this->CI->input->is_ajax_request()) {
			$currentURL = $this->CI->session->userdata('currentURL');
			if ($currentURL) {
				$BackURL = $currentURL;
				$this->CI->session->set_userdata('backURL', $BackURL);
			}
			$this->CI->session->set_userdata('currentURL', uri_string());
		}
	}

	public function remember($name, $url) {
		$memory = $this->CI->session->userdata('memory_url');
		$memory[$name] = $url;
		$this->CI->session->set_userdata('memory_url', $memory);
	}

	public function clear($name) {
		$memory = $this->CI->session->userdata('memory_url');
		if (isset($memory[$name])) {
			unset($memory[$name]);
		}
		$this->CI->session->set_userdata('memory_url', $memory);
	}

	public function getURL($name) {
		try {
			$memory = $this->CI->session->userdata('memory_url');
			if (isset($memory[$name])) {
				return $memory[$name];
			} else {
				throw new Exception('MemoryUrlNotFound');				
			}
		} catch(Exception $e) {
			return false;
		}
	}

	public function currentURL() {
		return $currentURL = $this->CI->session->userdata('currentURL');
	}

	public function backURL() {
		try {
			if ($this->CI->session->userdata('backURL')) {
				return $this->CI->session->userdata('backURL');
			} else {
				throw new Exception('BackUrlNotFound');				
			}	
		} catch(Exception $e) {
			show_error($e->getMessage());
		}		
	}	

}