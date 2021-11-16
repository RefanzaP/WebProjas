<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Redirect
{

    protected $CI;

    public function __construct()
    {
        $this->CI = &get_instance();              
    }

    public function with($name, $value = null)
    {
        if (is_array($name)) {
            foreach ($name as $var => $val) {
                $this->with($var, $val);
            }
        } else {
            $this->CI->session->set_flashdata($name, $value);
        }
        return $this;
    }

    public function withInput($input = array())
    {
        if (!$input) {
            $input = $this->CI->input->post();
        }
        $this->CI->session->set_flashdata('input', $input);
        return $this;
    }

    public function withValidation()
    {
        $this->CI->session->set_flashdata('validation', validation_errors());
        return $this;
    }

    public function to($direction = '')
    {
        redirect($direction);
    }

    public function back()
    {        
        $backTarget = $this->CI->url_memory->backURL(); 
        redirect($backTarget);            
    }

    public function guest($direction)
    {        
        $this->CI->url_memory->remember('redirectTarget', uri_string());
        redirect($direction);
    }

    public function intended($direction)
    {
        $redirectTarget = $this->CI->url_memory->getURL('redirectTarget');
        if ($redirectTarget) {
            redirect($redirectTarget);
        } else {
            redirect($direction);
        }
    }

}