
<?php

class Materai_model extends MY_Model {
    
    // public $_database_connection = 'consolidasi';
    public $table = 'INV_MST_EMATERAI';
    public $primary_key = 'INV_EMATERAI_ID';
    protected $return_type = 'array';

    public function __construct()
	{
		parent::__construct();
	}

	public function getData($data){
        
        $where = array();
        
        if(isset($data['INV_EMATERAI_NUMBER'])){
            if($data['INV_EMATERAI_NUMBER']!=''){
                $where['INV_EMATERAI_NUMBER']=$data['INV_EMATERAI_NUMBER'];
            }
        }
        if(isset($data['INV_EMATERAI_REDAKSI'])){
            if($data['INV_EMATERAI_REDAKSI']!=''){
                $where['INV_EMATERAI_REDAKSI']=$data['INV_EMATERAI_REDAKSI'];
            }
        }
        if(isset($data['INV_ENTITY_ID'])){
            if($data['INV_ENTITY_ID']!=''){
                $where['INV_ENTITY_ID']=$data['INV_ENTITY_ID'];
            }
        }
        $this->db->select('*')
            ->from($this->table)
            ->like($where);

		$query = $this->db->get();
        $result = $query->result_array();
        
		return $result;
	}

}