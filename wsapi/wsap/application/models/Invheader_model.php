<?php

class invheader_model extends MY_Model {
    
    
    public function __construct()
	{
        //$this->_database_connection = 'consolidasi';
        $this->_database_connection = 'invoice_consolidasi';
        $this->table = 'XEINVC_AR_INVOICE_HEADER';
        $this->primary_key = 'TRX_NUMBER';

        // $this->before_create = array( 'timestamps' );

		parent::__construct();
    }

    // protected function timestamps($data)
    // {
    //     // $data['created_at'] = $data['updated_at'] = date('Y-m-d H:i:s');
    //     $data['created_at'] = md5($data['updated_at']);
    //     return $book;
    // }
    
                
}