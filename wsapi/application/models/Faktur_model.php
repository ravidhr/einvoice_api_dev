
<?php

class Faktur_model extends MY_Model {
    
    // public $_database_connection = 'consolidasi';
    public $table = 'INV_MST_FAKTUR';
    public $primary_key = 'INV_FAKTUR_ID';
    protected $return_type = 'array';

    public function __construct()
	{
		parent::__construct();
	}

	public function getData($data){
        
        $where = array();
        if(isset($data['INV_FAKTUR_EFECTIVE'])){
            if($data['INV_FAKTUR_EFECTIVE']!=''){
                $where['INV_FAKTUR_EFECTIVE']=$data['INV_FAKTUR_EFECTIVE'];
            }
        }
        if(isset($data['INV_FAKTUR_END'])){
            if($data['INV_FAKTUR_END']!=''){
                $where['INV_FAKTUR_END']=$data['INV_FAKTUR_END'];
            }
        }
        if(isset($data['INV_ENTITY_ID'])){
            if($data['INV_ENTITY_ID']!=''){
                $where['INV_ENTITY_ID']=$data['INV_ENTITY_ID'];
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