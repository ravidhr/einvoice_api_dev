
<?php

class signbank_model extends MY_Model {
    
    // public $_database_connection = 'consolidasi';
    public $table = 'INV_MST_SIGNBANK';
    public $primary_key = 'INV_SIGNBANK_ID';
    protected $return_type = 'array';

    public function __construct()
	{
		parent::__construct();
	}

	public function getData($data){
        
        $where = array();
        if(isset($data['INV_SIGNBANK_ID'])){
            if($data['INV_SIGNBANK_ID']!=''){
                $where['INV_SIGNBANK_ID']=$data['INV_SIGNBANK_ID'];
            }
        }
        if(isset($data['INV_BANK_ID'])){
            if($data['INV_BANK_ID']!=''){
                $where['INV_BANK_ID']=$data['INV_BANK_ID'];
            }
        }
        if(isset($data['INV_BANK_NAME'])){
            if($data['INV_BANK_NAME']!=''){
                $where['INV_BANK_NAME']=$data['INV_BANK_NAME'];
            }
        }
        // print_
        if(isset($data['INV_UNIT_CODE'])){
            if($data['INV_UNIT_CODE']!=''){
                $where['INV_UNIT_CODE']=$data['INV_UNIT_CODE'];
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

}