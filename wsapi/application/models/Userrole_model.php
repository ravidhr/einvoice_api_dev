<?php

class Userrole_model extends MY_Model {

    // public $_database_connection = 'consolidasi';
    public $table = 'INV_MST_USERROLE';
    public $primary_key = 'INV_USERROLE_ID';
    protected $return_type = 'array';
    public function __construct()
	{
		parent::__construct();
	}

	public function getData($data){
        
        $where = array();
        if(isset($data['INV_USERROLE_ID'])){
            if($data['INV_USERROLE_ID']!=''){
                $where['INV_USERROLE_ID']=$data['INV_USERROLE_ID'];
            }
        }
        if(isset($data['INV_USER_USERNAME'])){
            if($data['INV_USER_USERNAME']!=''){
                $where['INV_USER_USERNAME']=$data['INV_USER_USERNAME'];
            }
        }
        if(isset($data['INV_ROLE_NAME'])){
            if($data['INV_ROLE_NAME']!=''){
                $where['INV_ROLE_NAME']=$data['INV_ROLE_NAME'];
            }
        }
        if(isset($data['INV_USER_ID'])){
            if($data['INV_USER_ID']!=''){
                $where['INV_USER_ID']=$data['INV_USER_ID'];
            }
        }
        // print_r($where);die;
        // die($where);
        $this->db->select('*')
            ->from($this->table)
            ->like($where);

		$query = $this->db->get();
        $result = $query->result_array();
        
		return $result;
	}

}