<?php

class Hicoscan_model extends MY_Model {
    
    public $_database_connection = 'itos';
    public $table = 'NOTA_HICOSCAN_H';
    public $primary_key = 'ID_NOTA';
    protected $return_type = 'array';

    public function __construct()
	{
		parent::__construct();
	}

}