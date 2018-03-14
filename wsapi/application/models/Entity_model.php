<?php

class entity_model extends MY_Model {
    // $this->_database_connection = 'consolidasi';
    // //public _database_connection = 'consolidasi';
    // public $table = 'INV_MST_ENTITY';
    // public $primary_key = 'INV_ENTITY_ID';
    // protected $return_type = 'array';

    public function __construct()
	{
		// $this->_database_connection = 'consolidasi';
		$this->_database_connection = 'invoice_consolidasi'; //ilangin buat ke invoice
        $this->table = 'INV_MST_ENTITY';
        //$this->primary_key = 'TRX_NUMBER';
        $this->primary_key = 'INV_ENTITY_ID';
		//$this->_database_connection = 'consolidasi';
	    //public _database_connection = 'consolidasi';
	    // public $table = 'INV_MST_ENTITY';
	    // public $primary_key = 'INV_ENTITY_ID';
	    // protected $return_type = 'array';

		parent::__construct();
	}

    public function getData($data){
        
        $where = array();
        if(isset($data['INV_ENTITY_CODE'])){
            if($data['INV_ENTITY_CODE']!=''){
                $where['INV_ENTITY_CODE']=$data['INV_ENTITY_CODE'];
            }
        }
        if(isset($data['INV_ENTITY_NAME'])){
            if($data['INV_ENTITY_NAME']!=''){
                $where['INV_ENTITY_NAME']=$data['INV_ENTITY_NAME'];
            }
        }
        // print_r($where);die;
        // die($select);
        $this->db->select('*')
            ->from($this->table)
            ->like($where);

        $query = $this->db->get();
        $result = $query->result_array();
        
        return $result;
    }
	public function getLastId(){
            
        $query = $this->db->query("select MAX(INV_ENTITY_ID) as LASTID from INV_MST_ENTITY");

        $result = $query->row();
        
        return !empty($result->LASTID) ? $result->LASTID : 0;
	}
}