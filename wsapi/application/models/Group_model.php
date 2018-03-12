<?php

class Group_model extends MY_Model {
    
    // public $_database_connection = 'consolidasi';
    public $table = 'MST_GROUP';
    public $primary_key = 'ID_GROUP';
    protected $return_type = 'array';
    public function __construct()
	{
		parent::__construct();
	}

}