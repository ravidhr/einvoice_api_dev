<?php

class Redaksi_model extends MY_Model {

    // public $_database_connection = 'consolidasi';
    public $table = 'INV_MST_REDAKSI';
    public $primary_key = 'INV_REDAKSI_ID';
    protected $return_type = 'array';
    public function __construct()
    {
        parent::__construct();
    }

    public function getData($data){
        
        $where = array();
        if(isset($data['INV_REDAKSI_ID'])){
            if($data['INV_REDAKSI_ID']!=''){
                $where['INV_REDAKSI_ID']=$data['INV_REDAKSI_ID'];
            }
        }
        if(isset($data['INV_NOTA_JENIS'])){
            if($data['INV_NOTA_JENIS']!=''){
                $where['INV_NOTA_JENIS']=$data['INV_NOTA_JENIS'];
            }
        }
        if(isset($data['INV_NOTA_LAYANAN'])){
            if($data['INV_NOTA_LAYANAN']!=''){
                $where['INV_NOTA_LAYANAN']=$data['INV_NOTA_LAYANAN'];
            }
        }
        if(isset($data['INV_UNIT_ID'])){
            if($data['INV_UNIT_ID']!=''){
                $where['INV_UNIT_ID']=$data['INV_UNIT_ID'];
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