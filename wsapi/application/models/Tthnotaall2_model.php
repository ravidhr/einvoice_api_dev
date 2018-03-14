<?php

class tthnotaall2_model extends MY_Model {
    
    
    public function __construct()
	{
        $this->_database_connection = 'itos';
        $this->table = 'TTH_NOTA_ALL2';
        $this->primary_key = 'NO_NOTA';
        
		parent::__construct();
    }

    
}