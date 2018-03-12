<?php

class Unit_model extends MY_Model {
    
    public function __construct()
    {
        $this->table = 'INV_MST_UNIT';
        $this->primary_key = 'INV_UNIT_ID';
        parent::__construct();
    }

    public function getData($data){
        
        $where = array();
        if(isset($data['INV_UNIT_NAME'])){
            if($data['INV_UNIT_NAME']!=''){
                $where['INV_UNIT_NAME']=$data['INV_UNIT_NAME'];
            }
        }
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