<?php

class Sendmail_model extends MY_Model{
    //public $_database_connection = 'consolidasi';
    public $table = 'EMAIL_LG';
    public $primary_key = 'NO_NOTA';
    protected $return_type = 'array';

    public function __construct()
    {

        parent::__construct();
    }

    public function getData($data){
        // die('124');
        $where = array();
        if(isset($data['NO_NOTA'])){
            if($data['NO_NOTA']!=''){
                $where['NO_NOTA']=$data['NO_NOTA'];
            }
        }
        if(isset($data['MODULE'])){
            if($data['MODULE']!=''){
                $module = ($data['MODULE']);
                if($module == 'KAPAL'){
                    $where['LAYANAN']='KPL';
                } elseif ($module =='RUPARUPA') {
                    $where['LAYANAN']='RUPA';
                } elseif ($module =='BARANG') {
                    $where['LAYANAN']='BRG';
                } else {
                    $where['LAYANAN']='PTKM';
                }
            }
        }else {
            // $where['LAYANAN']='PTKM';
        }
        if(isset($data['JENIS_NOTA'])){
            if($data['JENIS_NOTA']!=''){
                $where['JENIS_NOTA']=$data['JENIS_NOTA'];
            }
        }
        if(isset($data['CUSTOMER'])){
            if($data['CUSTOMER']!=''){
                $where['CUSTOMER']=$data['CUSTOMER'];
            }
        }
        $this->db->select('*')
            ->from($this->table)
            ->like($where);
        $query = $this->db->get();
        $result = $query->result_array();
        $resultEnd = array();
        foreach ($result as $key => $value) {
            unset($value['HTML_DATA']);
            unset($value['TEXT_DATA']);
            $resultEnd[] = $value;
        }
        
        return $resultEnd;
    }
    
}