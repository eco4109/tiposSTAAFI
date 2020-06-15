<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Sesion {

	private $CI;

    function __construct()
    {
        $this->CI =& get_instance();
		$this->CI->load->library('session');
    }

    public function existe_sesion() { 
		if($this->CI->session->userdata('logged_in')==null)
			redirect(base_url()."login");	
    }

	public function cerrar_sesion() {
		$this->CI->session->sess_destroy();
			redirect(base_url()."login");
	}

}
?>