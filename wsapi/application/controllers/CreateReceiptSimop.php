<?php
/***
Nama Controller 	: CreateReceiptSimop.php
Ditulis oleh 		: Gagat Rahina
Tanggal Penulisan 	: 07 Maret 2018 
no hp 				: +628156237689
email 				: gagat.rahina@sigma.co.id

Digunakan untuk pelunasan Nota Barang Dermaga Penumpukan
**/


defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class CreateReceiptSimop extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }

  	function index_get() {
        $id = $this->uri->segment(2);
        $id2 = $this->uri->segment(3);

        $this->load->model('simop_createReceipt_model');
        if ($id == '') {
                $result= $this->simop_createReceipt_model->get_all();
        } else {
            if($id=='page' && $id2!==''){
                $total_posts = $this->simop_createReceipt_model->count_rows(); // retrieve the total number of posts
                $result = $this->simop_createReceipt_model->paginate(10,$total_posts);
            } else {           
                if($id!=='' && $id2==''){
                    $result= $this->simop_createReceipt_model->get(array('TRX_NUMBER'=>$id));  
                }
            }
        }        
        $this->response($result, 200);
    }
	function index_post() {
		
		$id = $this->uri->segment(2);
	
        $this->load->library('form_validation');
        $this->form_validation->set_data($this->put());
		
		//call db lain
		
		$this->invoice_consolidasi_db = $this->load->database('invoice_consolidasi',true);
		//---------------------------------------		 
		
        if($this->form_validation->run('simop_create_receipt_post') != false){
            $this->load->model('simop_createReceipt_model');
            $data = $this->post();				

            $safe_data = $this->simop_createReceipt_model->get(array(
			'RECEIPT_NUMBER'=>$this->post('RECEIPT_NUMBER'),
			'ORG_ID'=>$this->post('ORG_ID'),			
			'BANK_ID'=>$this->post('BANK_ID'),
			'RECEIPT_METHOD'=>$this->post('RECEIPT_METHOD'),
			'RECEIPT_ACCOUNT'=>$this->post('RECEIPT_ACCOUNT')			
			));
			
			$parameters=array( 
				array('name'=>':RECEIPT_NUMBER','value'=>$this->post('RECEIPT_NUMBER'),'length'=>100,'type'=>SQLT_CHR),
				array('name'=>':ORG_ID','value'=>$this->post('ORG_ID'),'length'=>100,'type'=>SQLT_INT),				
				array('name'=>':BANK_ID','value'=>$this->post('BANK_ID'),'length'=>100,'type'=>SQLT_INT),				
				array('name'=>':RECEIPT_METHOD','value'=>$this->post('RECEIPT_METHOD'),'length'=>100,'type'=>SQLT_CHR),				
				array('name'=>':RECEIPT_ACCOUNT','value'=>$this->post('RECEIPT_ACCOUNT'),'length'=>100,'type'=>SQLT_CHR),				
				
				array('name'=>':out_status','value'=>&$out_status,'length'=>100,'type'=>SQLT_CHR),
				array('name'=>':out_messages','value'=>&$out_messages,'length'=>1000,'type'=>SQLT_CHR)
			);
			
			//print_r($parameters);
			//die();
						
		//call package db yg lain
		$this->invoice_consolidasi_db->stored_procedure('INVOICE.XEINVC_API_KONSOLIDASI_PKG','CREATE_RECEIPT_FROM_INVOICE',$parameters);
		
		$this->response( array('status'=>$out_status, 
            'message'=>$out_messages));
	    /*
		memanggil web service SimopInvoiceHeader dan SimopInvoiceDetail
		*/	
		
				
			
        } else {
            $this->response( array('status'=>'failure', 
            'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_BAD_REQUEST);
        }
		
		//close db yg lain
		$this->invoice_consolidasi_db->close();
		
    }
}