<?php

class Exmo_model extends MY_Model {
    
    public $_database_connection = 'itos';
    public $table = 'EXMO_NOTA';
    public $primary_key = 'ID_NOTA';
    protected $return_type = 'array';

    public function __construct()
	{
		parent::__construct();
	}

}