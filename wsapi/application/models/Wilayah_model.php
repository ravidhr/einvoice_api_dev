<?php

class wilayah_model extends MY_Model {
    
    public function __construct()
	{
		$this->_database_connection = 'invoice_consolidasi';
        $this->table = 'INV_MST_WILAYAH';
        $this->primary_key = 'INV_WILAYAH_ID';

		parent::__construct();
	}

}


// public function __construct()
// 	{
// 		// $this->_database_connection = 'consolidasi';
// 		$this->_database_connection = 'invoice_consolidasi'; //ilangin buat ke invoice
//         $this->table = 'INV_MST_ENTITY';
//         //$this->primary_key = 'TRX_NUMBER';
//         $this->primary_key = 'INV_ENTITY_ID';
// 		//$this->_database_connection = 'consolidasi';
// 	    //public _database_connection = 'consolidasi';
// 	    // public $table = 'INV_MST_ENTITY';
// 	    // public $primary_key = 'INV_ENTITY_ID';
// 	    // protected $return_type = 'array';

// 		parent::__construct();
// 	}