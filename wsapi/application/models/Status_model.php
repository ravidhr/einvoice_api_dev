<?php

class status_model extends MY_Model {
    
    public function __construct()
	{
        $this->table = 'INV_MST_STATUS';
        $this->primary_key = 'INV_STATUS_ID';

		parent::__construct();
	}

}