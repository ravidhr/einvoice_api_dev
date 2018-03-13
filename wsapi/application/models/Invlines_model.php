<?php

class invlines_model extends MY_Model {
    
    public function __construct()
	{
		//$this->_database_connection = 'consolidasi';
        $this->_database_connection = 'invoice_consolidasi';
        $this->table = 'XEINVC_AR_INVOICE_LINES';
        $this->primary_key = 'TRX_NUMBER';

		parent::__construct();
	}
}