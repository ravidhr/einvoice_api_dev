<?php

class Pejabat_model extends MY_Model {

    // public $_database_connection = 'consolidasi';
    public $table = 'INV_MST_PEJABAT';
    public $primary_key = 'INV_PEJABAT_ID';
    protected $return_type = 'array';
    public function __construct()
    {
        parent::__construct();
    }

    public function getData($data){
        
        $where = array();
        if(isset($data['INV_PEJABAT_ID'])){
            if($data['INV_PEJABAT_ID']!=''){
                $where['INV_PEJABAT_ID']=$data['INV_PEJABAT_ID'];
            }
        }
        if(isset($data['INV_PEJABAT_NAME'])){
            if($data['INV_PEJABAT_NAME']!=''){
                $where['INV_PEJABAT_NAME']=$data['INV_PEJABAT_NAME'];
            }
        }
        if(isset($data['INV_UNIT_ID'])){
            if($data['INV_UNIT_ID']!=''){
                $where['INV_UNIT_ID']=$data['INV_UNIT_ID'];
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