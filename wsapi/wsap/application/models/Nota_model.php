<?php

class nota_model extends MY_Model {
    
    public function __construct()
	{
		$this->_database_connection = 'invoice_consolidasi';
        $this->table = 'INV_MST_NOTA';
        $this->primary_key = 'INV_NOTA_ID';

		parent::__construct();
	}

}