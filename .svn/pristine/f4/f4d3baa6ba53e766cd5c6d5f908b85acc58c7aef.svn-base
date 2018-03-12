<?php

class Invheader_model extends MY_Model{
    //public $_database_connection = 'consolidasi';
    public $table = 'XEINVC_AR_INVOICE_HEADER';
    public $primary_key = 'TRX_NUMBER';
    protected $return_type = 'array';

    public function __construct()
    {

        parent::__construct();
    }

    public function getData($data){
        // die('124');
        $where = array();
        if(isset($data['TRX_NUMBER'])){
            if($data['TRX_NUMBER']!=''){
                $where['TRX_NUMBER']=$data['TRX_NUMBER'];
            }
        }
        if(isset($data['BILLER_REQUEST_ID'])){
            if($data['BILLER_REQUEST_ID']!=''){
                $where['BILLER_REQUEST_ID']=$data['BILLER_REQUEST_ID'];
            }
        }
        if(isset($data['STATUS'])){
            if($data['STATUS']!=''){
                $where['STATUS']=$data['STATUS'];
            }
        }
        if(isset($data['CUSTOMER_NAME'])){
            if($data['CUSTOMER_NAME']!=''){
                $where['CUSTOMER_NAME']=$data['CUSTOMER_NAME'];
            }
        }
        if(isset($data['CREATION_DATE'])){
            if($data['CREATION_DATE']!=''){
                $where['CREATION_DATE']=$data['CREATION_DATE'];
            }
        }
        if(isset($data['TRX_DATE'])){
            if($data['TRX_DATE']!=''){
                $where['TRX_DATE']=$data['TRX_DATE'];
            }
        }
        if(isset($data['MODULE'])){
            if($data['MODULE']!=''){
                $module = ($data['MODULE']);
                if($module == 'KAPAL'){
                    $where['HEADER_CONTEXT']='KPL';
                } elseif ($module =='RUPARUPA') {
                    $where['HEADER_CONTEXT']='RUPA';
                } elseif ($module =='BARANG') {
                    $where['HEADER_CONTEXT']='BRG';
                } else {
                    $where['HEADER_CONTEXT']='PTKM';
                }
            }
        }else {
            $where['HEADER_CONTEXT']='PTKM';
        }

        $this->db->select('*')
            ->from($this->table)
            ->like($where);
        
        $query = $this->db->get();
        $result = $query->result_array();
        
        return $result;
    }
    
}