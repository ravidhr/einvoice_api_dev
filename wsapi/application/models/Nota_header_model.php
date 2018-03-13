<?php

class nota_header_model extends MY_Model {

    
    // public $_database_connection = 'itos';
    // public $table = 'NOTA_RECEIVING_H';
    // public $primary_key = 'ID_NOTA';

    // protected $return_type = 'array';   

    public function __construct()
	{
		
        //$this->_database_connection = 'itos';
        $this->_database_connection = 'invoice_consolidasi';
        $this->table = 'XEINVC_AR_INVOICE_HEADER';
        $this->primary_key = 'TRX_NUMBER';
		//echo "function mota header module construct ";
        //die();
        //$this->before_create[] = 'prep_data';
		
		//echo "JML data ".count($data);
		//die();
		//if(count($data) == 0){
         /*   $receiveddata = array(
                    'ID_NUM' => '6',
                    'PRODUCT_NAME' => 'DOUBLE DECKER',
                    'PRICE' => '2000',
                    'QUANTITY' => '1',
                    'SELLER' => 'BHINEKKA'
                );
            $this->db->insert('XEINVC_PRODUCTS', $receiveddata);    
                       		
        //    return true;
        //}else {
        //    return false;
       // }*/
		
		parent::__construct();
    }
    
    
    
    protected function prep_data($data){
		
		        
		//$data['ID_NUM'] = $data['ID_NUM'];
		//$data['PRODUCT_NAME'] = $data['PRODUCT_NAME'];
		
        // $data['TOTAL'] = number_format($data['TOTAL']);
        // unset($data['ADM_NOTA']);
        // set($data['ID_NUM']='8');
		// set($data['PRODUCT_NAME']='DOUBLE DECKER ');
        // $data['NGANTUK'] = '123457';
        return $data;
    }

}