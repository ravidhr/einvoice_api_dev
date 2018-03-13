<?php

class unit_model extends MY_Model {
    
    public function __construct()
	{
		//$this->_database_connection = 'consolidasi';
		$this->_database_connection = 'invoice_consolidasi'; //ilangin buat ke invoice
        $this->table = 'XEINVC_PRODUCTS';
        $this->primary_key = 'ID_NUM';

		parent::__construct();
	}

}