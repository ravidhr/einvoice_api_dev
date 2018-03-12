<?php

class Invlines_model extends MY_Model {
    
    // public $_database_connection = 'consolidasi';
    public $table = 'XEINVC_AR_INVOICE_LINES';
    public $primary_key = 'TRX_NUMBER';
    protected $return_type = 'array';
    public function __construct()
	{
		parent::__construct();
    }
    
    
	public function getTerbilang($amount){
		$this->load->database();
		$sql =    'select terbilang ('.$amount.') as nilai from dual';
		
		$sql = $this->db->query($sql);
		$result = $sql->result();
		return $result;
	}
}