<?php

class Form
{

    protected $CI;

    protected $_data;

    protected $_input;

    protected $_macros = array();

    public function __construct($config = array())
    {
        $this->CI = &get_instance();
        $this->CI->load->helper('form');        
        $this->_input = $this->CI->session->flashdata('input');          
    }           

    public function setData($data)
    {
        $this->_data = $data;
        return $this;
    }

    public function data($name, $value = null)
    {        
        if (!$value) {            
            if ($value = $this->getInputValue($name)) {                
                return $value;
            } elseif ($value = $this->getDataValue($name)) {
                return $value;
            } else {
                return $value;
            }
        }
        return $value;
    }

    public function open($action = '', $attributes = '', $hidden = array())
    {
        return form_open($action, $attributes, $hidden);
    }

    public function openMultipart($action = '', $attributes = '', $hidden = array())
    {
        return form_open_multipart($action, $attributes, $hidden);
    }

    public function text($name, $value = null, $attributes = '')
    {        
        return form_input($name, $this->data($name, $value), $attributes);
    }
   
    public function date($name, $value = null, $attributes = '')
    {        
        return form_input($name, toDate($this->data($name, $value)), $attributes);
    }

    public function time($name, $value = null, $attributes = '')
    {        
        return form_input($name, toTime($this->data($name, $value)), $attributes);
    }

    public function datetime($name, $value = null, $attributes = '')
    {        
        return form_input($name, toDateTime($this->data($name, $value)), $attributes);
    }

    public function password($name, $value = null, $attributes = '')
    {
        return form_password($name, null, $attributes);
    }

    public function textarea($name, $value = null, $attributes = '')
    {
        return form_textarea($name, $this->data($name, $value), $attributes);
    }

    public function radio($name, $value = '', $checked = false, $attributes = '')
    {
        if ($this->data($name) == $value) {
            $checked = true;
        }
        return form_radio($name, $value, $checked, $attributes);
    }

    public function checkbox($name, $value = '', $checked = false, $attributes = '')
    {
        if ($this->data($name) == $value) {

            $checked = true;
        }
        return form_checkbox($name, $value, $checked, $attributes);
    }

    public function select($name, $data = array(), $selected = null, $attributes = '')
    {        
        return form_dropdown($name, $data, $this->data($name, $selected), $attributes);
    }

    public function multiselect($name, $option = array(), $selected = array(), $attributes = '')
    {
        return form_multiselect($name, $option, $this->data($name, $selected), $attributes);
    }

    public function hidden($name, $value = null, $attributes)
    {
        return form_hidden($name, $value, $attributes);
    }

    public function upload($data, $value = null, $attributes = '')
    {
        return form_upload($data, $value, $attributes);
    }

    public function submit($name, $value = '', $attributes = '')
    {
        return form_submit($name, $value, $attributes);
    }

    public function reset($data, $value = '', $attributes = '')
    {
        return form_reset($data, $value, $attributes);
    }

    public function button($data, $content = '', $attributes = '')
    {
        return form_button($data, $content, $attributes);
    }    

    public function label($label, $id = '', $attributes = '')
    {
        return form_label($label, $id, $attributes);
    }

    public function close()
    {
        return form_close();
    }    

    protected function transformKey($key)
    {
        return str_replace(array('.', '[]', '[', ']'), array('_', '', '.', ''), $key);
    }

    protected function getDataArray($array, $key, $default) {            
        $key = $this->transformKey($key);
        if (is_null($key)) return $array;
        
        if (isset($array[$key])) return $array[$key];
        
        foreach (explode('.', $key) as $segment) {                
            if (!is_array($array) || !array_key_exists($segment, $array)) {
                return $default;
            }        
            $array = $array[$segment];
        }        
        return $array;
    }

    protected function getDataObject($object, $key, $default) {
        $object = $this->_data;
        $key = $this->transformKey($key);
        if (is_null($key) || trim($key) == '') return $object;

        foreach (explode('.', $key) as $segment) {
            if (!is_object($object) || !isset($object->{$segment})) {
                return $default;
            }

            $object = $object->{$segment};
        }

        return $object;
    }

    protected function getInputValue($key, $default = null)
    {
        if (is_array($this->_input)) {
            $result = $this->getDataArray($this->_input, $key, $default);
        } else {
            $result = $this->getDataObject($this->_input, $key, $default);
        }        
        return $result;
    }

    protected function getDataValue($key, $default = null)
    {
        if (is_array($this->_data)) {
            $result = $this->getDataArray($this->_data, $key, $default);
        } else {
            $result = $this->getDataObject($this->_data, $key, $default);
        }
        return $result;
    }

}

function formValue($name, $default = '') {
    $CI = &get_instance();
    return $CI->form->data($name, $default);
}