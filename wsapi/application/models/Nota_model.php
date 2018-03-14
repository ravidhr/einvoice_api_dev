<?php

class nota_model extends MY_Model {
    
    public function __construct()
	{
		$this->_database_connection = 'invoice_consolidasi';
        $this->table = 'INV_MST_NOTA';
        $this->primary_key = 'INV_NOTA_ID';

		parent::__construct();
	}

	public function getData($data){
        
        $where = array();
        if(isset($data['INV_NOTA_CODE'])){
            if($data['INV_NOTA_CODE']!=''){
                $where['INV_NOTA_CODE']=$data['INV_NOTA_CODE'];
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
        // print_r($where);die;
        $this->db->select('*')
            ->from($this->table)
            ->like($where);

		$query = $this->db->get();
        $result = $query->result_array();
        // print_r($result);die;
		return $result;
	}
}