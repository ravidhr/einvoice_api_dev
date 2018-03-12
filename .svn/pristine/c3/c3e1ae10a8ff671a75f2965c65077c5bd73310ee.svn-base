<?php
/**
nama model : Simop_invoice_header_model.php
Dibuat Oleh : Gagat Rahina 
tgl         : 5 Februari 2018 
no telp     : +628156237689
email       : gagat.rahina@sigma.co.id

**/

class Simop_receipt_header_model extends MY_Model {

    
    // public $_database_connection = 'itos';
    // public $table = 'NOTA_RECEIVING_H';
    // public $primary_key = 'ID_NOTA';

    // protected $return_type = 'array';   

    public function __construct()
	{
        $this->_database_connection = 'invoice_consolidasi';
        $this->table = 'XEINVC_AR_RECEIPTS_HEADER';
        $this->primary_key = 'RECEIPT_NUMBER';
		//$this->before_create[] = 'prep_data';
		/*
		$this->_database_connection = 'invoice_rupa2_prod';
        $this->table = 'IPCTPK_NOTA_HEADER';
        $this->primary_key = 'TRX_NUMBER';
		//$this->before_create[] = 'prep_data';
        */
					
		parent::__construct();
    }
    
    
    
    protected function prep_data($data){
		
		        
		$data['INTERFACE_HEADER_ATTRIBUTE15'] = $data['INTERFACE_HEADER_ATTRIBUTE15'];
		//$data['PRODUCT_NAME'] = $data['PRODUCT_NAME'];
		
        // $data['TOTAL'] = number_format($data['TOTAL']);
        // unset($data['ADM_NOTA']);
        // set($data['ID_NUM']='8');
		// set($data['PRODUCT_NAME']='DOUBLE DECKER ');
        // $data['NGANTUK'] = '123457';
        return $data;
    }

}