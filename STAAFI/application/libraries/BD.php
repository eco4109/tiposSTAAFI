<?php defined('BASEPATH') OR exit('No direct script access allowed');

class BD {

	private $CI;

    function __construct()
    {
        $this->CI =& get_instance();        
        $this->CI->load->helper('url');
        $this->CI->config->item('base_url');
        $this->CI->load->database();
    }

    public function iniciar_transaccion() 
    {
		$this->db->trans_start();	
    }

	public function completar_transaccion() 
    {
		$this->db->trans_complete();	
    }

    public function status_transaccion() 
    {
		$this->db->trans_status();	
    }

}
?>