<?php

class Transhipment_model extends MY_Model {
    
    // public _database_connection = 'consolidasi';
    public $table = 'NOTA_TRANSHIPMENT_H';
    public $primary_key = 'ID_NOTA';
    protected $return_type = 'array';

    public function __construct()
	{
		parent::__construct();
	}

}