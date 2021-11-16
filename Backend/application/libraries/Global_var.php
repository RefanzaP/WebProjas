<?php

class Global_var {

	protected $variable;

	public function set($name, $value) {
		$this->variable[$name] = $value;
	}

	public function get($name = null) {
		if ($name) {
			return $this->variable[$name];
		} else {
			return $this->variable;
		}
	}

	public function destroy($name) {
		unset($this->variable[$name]);
	}

}

function setGlobalVar($name, $value) {
	$CI = &get_instance();
	$CI->set($name, $value);
}

function getGlobalVar($name) {
	$CI = &get_instance();
	return $CI->global_var->get($name);
}

function unsetVar($name) {
	$CI = &get_instance();
	$CI->global_var->unset($name);
}