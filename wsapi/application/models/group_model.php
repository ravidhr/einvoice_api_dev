<?php

class group_model extends MY_Model {
    
    public function __construct()
	{
        $this->table = 'MST_GROUP';
        $this->primary_key = 'ID_GROUP';

		parent::__construct();
	}

}