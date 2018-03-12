<?php

class Receipts_model extends MY_Model {
    
    public $table = 'XEINVC_AR_RECEIPTS_HEADER';
    public $primary_key = 'RECEIPT_NUMBER';
    protected $return_type = 'array';
    public function __construct()
	{
		parent::__construct();
	}

}