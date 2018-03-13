<?php

class simop_barang_list_transaksi_model extends MY_Model {

    
    // public $_database_connection = 'itos';
    // public $table = 'NOTA_RECEIVING_H';
    // public $primary_key = 'ID_NOTA';

    // protected $return_type = 'array';   

    public function __construct()
	{
        $this->_database_connection = 'invoice_barang_cabang';
        $this->table = 'XEINVC_NOTA_BARANG';
        $this->primary_key = 'TRX_NUMBER';
		$this->before_create[] = 'prep_data';

        
					
		parent::__construct();
    }
    
    
    
    protected function prep_data($data){
		
		        
		$data['NO_UKK'] = $data['NO_UKK'];
		//$data['PRODUCT_NAME'] = $data['PRODUCT_NAME'];
		
        // $data['TOTAL'] = number_format($data['TOTAL']);
        // unset($data['ADM_NOTA']);
        // set($data['ID_NUM']='8');
		// set($data['PRODUCT_NAME']='DOUBLE DECKER ');
        // $data['NGANTUK'] = '123457';
        return $data;
    }

}