<?php

class receipts_model extends MY_Model {
    
    public function __construct()
	{
        $this->_database_connection = 'invoice_consolidasi';
        $this->table = 'XEINVC_AR_RECEIPTS_HEADER';
        $this->primary_key = 'RECEIPT_NUMBER';

		parent::__construct();
	}

}