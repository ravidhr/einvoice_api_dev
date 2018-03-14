<?php

class User_model extends MY_Model {
    
    public $table = 'INV_MST_USER';
    public $primary_key = 'INV_USER_ID';
    protected $return_type = 'array';
    public function __construct()
    {

        parent::__construct();
    }
    
    public function getData($data){
        
        $where = array();
        
        if(isset($data['INV_USER_NAME'])){
            if($data['INV_USER_NAME']!=''){
                $where['INV_USER_NAME']=$data['INV_USER_NAME'];
            }
        }
        if(isset($data['INV_USER_NIPP'])){
            if($data['INV_USER_NIPP']!=''){
                $where['INV_USER_NIPP']=$data['INV_USER_NIPP'];
            }
        }
        if(isset($data['INV_USER_USERNAME'])){
            if($data['INV_USER_USERNAME']!=''){
                $where['INV_USER_USERNAME']=$data['INV_USER_USERNAME'];
            }
        }
        if(isset($data['INV_USER_ID'])){
            if($data['INV_USER_ID']!=''){
                $where['INV_USER_ID']=$data['INV_USER_ID'];
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