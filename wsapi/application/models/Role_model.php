<?php

class Role_model extends MY_Model {
    
    public $table = 'INV_MST_ROLE';
    public $primary_key = 'INV_ROLE_ID';
    protected $return_type = 'array';
    public function __construct()
	{

		parent::__construct();
    }
    
	public function getData($data){
        
        $where = array();
        
        if(isset($data['INV_ROLE_NAME'])){
            if($data['INV_ROLE_NAME']!=''){
                $where['INV_ROLE_NAME']=$data['INV_ROLE_NAME'];
            }
        }
        if(isset($data['INV_ROLE_DESCRIPTION'])){
            if($data['INV_ROLE_DESCRIPTION']!=''){
                $where['INV_ROLE_DESCRIPTION']=$data['INV_ROLE_DESCRIPTION'];
            }
        }
        if(isset($data['INV_ROLE_TYPE'])){
            if($data['INV_ROLE_TYPE']!=''){
                $where['INV_ROLE_TYPE']=$data['INV_ROLE_TYPE'];
            }
        }
        if(isset($data['INV_UNIT_JENIS'])){
            if($data['INV_UNIT_JENIS']!=''){
                $where['INV_UNIT_JENIS']=$data['INV_UNIT_JENIS'];
            }
        }
        // if(isset($data['INV_ROLE_KAPAL'])){
        //     if($data['INV_ROLE_KAPAL']!=''){
        //         $where['INV_ROLE_KAPAL']=$data['INV_ROLE_KAPAL'];
        //     }
        // }
        // if(isset($data['INV_ROLE_PETIKEMAS'])){
        //     if($data['INV_ROLE_PETIKEMAS']!=''){
        //         $where['INV_ROLE_PETIKEMAS']=$data['INV_ROLE_PETIKEMAS'];
        //     }
        // }
        // if(isset($data['INV_ROLE_BARANG'])){
        //     if($data['INV_ROLE_BARANG']!=''){
        //         $where['INV_ROLE_BARANG']=$data['INV_ROLE_BARANG'];
        //     }
        // }
        // if(isset($data['INV_ROLE_RUPARUPA'])){
        //     if($data['INV_ROLE_RUPARUPA']!=''){
        //         $where['INV_ROLE_RUPARUPA']=$data['INV_ROLE_RUPARUPA'];
        //     }
        // }

        // if(isset($data['INV_ROLE_ID'])){
        //     if($data['INV_ROLE_ID']!=''){
        //         $where['INV_ROLE_ID']=$data['INV_ROLE_ID'];
        //     }
        // }

        $this->db->select('*')
            ->from($this->table)
            ->like($where);

        $query = $this->db->get();
        $result = $query->result_array();
        
        return $result;
	}


}