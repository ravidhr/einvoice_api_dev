<?php

class simop_GetInvoiceRupa_model extends MY_Model {

    
    // public $_database_connection = 'itos';
    // public $table = 'NOTA_RECEIVING_H';
    // public $primary_key = 'ID_NOTA';

    // protected $return_type = 'array';   

    public function __construct()
	{
        $this->_database_connection = 'invoice_rupa2_prod';
		$this->table = 'IPCTPK_NOTA_DETAIL';
		$this->primary_key = 'TRX_NUMBER';
		$this->before_create[] = 'prep_data';

        
					
		parent::__construct();
    }
    
    
    
    protected function prep_data($data){
		
		        
		$data['TRX_NUMBER'] = $data['TRX_NUMBER'];
		//$data['PRODUCT_NAME'] = $data['PRODUCT_NAME'];
		
        // $data['TOTAL'] = number_format($data['TOTAL']);
        // unset($data['ADM_NOTA']);
        // set($data['ID_NUM']='8');
		// set($data['PRODUCT_NAME']='DOUBLE DECKER ');
        // $data['NGANTUK'] = '123457';
        return $data;
    }

}