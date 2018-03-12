<?php

class Bank_model extends MY_Model {
    
    public function __construct()
    {
        $this->table = 'INV_MST_BANK';
        $this->primary_key = 'INV_BANK_ID';

        parent::__construct();
    }

    public function getData($data){

        // print_r($this->table);die;
        
        $where = array();
        
        if(isset($data['INV_BANK_ID'])){
            if($data['INV_BANK_ID']!=''){
                $where['INV_BANK_ID']=$data['INV_BANK_ID'];
            }
        }
        if(isset($data['INV_BANK_REKENING'])){
            if($data['INV_BANK_REKENING']!=''){
                $where['INV_BANK_REKENING']=$data['INV_BANK_REKENING'];
            }
        }
        if(isset($data['INV_BANK_NAME'])){
            if($data['INV_BANK_NAME']!=''){
                $where['INV_BANK_NAME']=$data['INV_BANK_NAME'];
            }
        }
        if(isset($data['INV_BANK_NOTE'])){
            if($data['INV_BANK_NOTE']!=''){
                $where['INV_BANK_NOTE']=$data['INV_BANK_NOTE'];
            }
        }
        if(isset($data['INV_SOURCE_ID'])){
            if($data['INV_SOURCE_ID']!=''){
                $where['INV_SOURCE_ID']=$data['INV_SOURCE_ID'];
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