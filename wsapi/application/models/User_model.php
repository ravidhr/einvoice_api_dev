<?php

class user_model extends MY_Model {
    
    public function __construct()
	{
		//$this->_database_connection = 'consolidasi'; 
		$this->_database_connection = 'invoice_consolidasi'; //ilangin buat ke invoice
        $this->table = 'MST_USER'; //defaulrt gk ambil db invoice_consolidasi
        $this->primary_key = 'USERNAME';

		parent::__construct();
	}

}