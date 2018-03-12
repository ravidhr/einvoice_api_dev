<?php

class Mstnota_model extends MY_Model {
    
    // public _database_connection = 'consolidasi';
    public $table = 'INV_MST_NOTA';
    public $primary_key = 'INV_NOTA_ID';
    protected $return_type = 'array';

    public function __construct()
	{
        // $this->table = 'INV_MST_NOTA';
        // $this->primary_key = 'INV_NOTA_ID';
		parent::__construct();
    }
    
	public function getDistict($field){
        
        $select = 'select distinct '.$field.' from INV_MST_NOTA where '.$field.' IS NOT NULL';
        // die($select);
		$query = $this->db->query($select);
		$row = $query->result();
		return $row;
	}

}