<?php

class Status_model extends MY_Model {
    
    public $table = 'INV_MST_STATUS';
    public $primary_key = 'INV_STATUS_ID';
    protected $return_type = 'array';
    public function __construct()
	{
		parent::__construct();
	}

}