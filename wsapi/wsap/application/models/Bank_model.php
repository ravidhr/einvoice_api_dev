<?php

class bank_model extends MY_Model {
    
    public function __construct()
	{
		$this->_database_connection = 'invoice_consolidasi';
        $this->table = 'INV_MST_BANK';
        $this->primary_key = 'INV_BANK_ID';

		parent::__construct();
	}

}