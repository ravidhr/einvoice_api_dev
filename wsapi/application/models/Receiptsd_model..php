<?php

class Receiptsd_model extends MY_Model {
    
    // public $_database_connection = 'consolidasi';
    public $table = 'XEINVC_AR_RECEIPT_LINES';
    public $primary_key = 'LINE_NUMBER';
    protected $return_type = 'array';
    public function __construct()
	{
		parent::__construct();
	}

}