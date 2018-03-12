<?php

class Wilayah_model extends MY_Model {
    
    public $table = 'INV_MST_WILAYAH';
    public $primary_key = 'INV_WILAYAH_ID';
    protected $return_type = 'array';
    public function __construct()
	{
		parent::__construct();
	}

}