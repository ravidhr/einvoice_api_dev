<?php

/**
nama Controller : SimopInvoiceHeader.php
Dibuat Oleh     : Gagat Rahina 
tgl             : 5 Februari 2018 
no telp         : +628156237689
email           : gagat.rahina@sigma.co.id


web service ini digunakan untuk memasukkan data ke table staging konsolidasi XEINVC_AR_RECEIPTS_HEADER
dengan menggunakan package di database konsolidasi xeinvc_api_konsolidasi_pkg
**/

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class SimopReceiptHeader extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }

  

    function index_post() {
		
		$id = $this->uri->segment(2);
	
        $this->load->library('form_validation');
        $this->form_validation->set_data($this->put());
		//---------------------------------------	
        //call db 		
		$this->invoice_consolidasi_db = $this->load->database('invoice_consolidasi',true);
        if($this->form_validation->run('simop_receipt_header_post') != false){
            $this->load->model('Simop_receipt_header_model');
            $data = $this->post();				

            $safe_data = $this->Simop_receipt_header_model->get(array(
			'IN_SOURCE_INVOICE'=>$this->post('IN_SOURCE_INVOICE'),
			'ORG_ID'=>$this->post('ORG_ID'),
			'RECEIPT_NUMBER'=>$this->post('RECEIPT_NUMBER'),
			'RECEIPT_METHOD'=>$this->post('RECEIPT_METHOD'),
			'RECEIPT_ACCOUNT'=>$this->post('RECEIPT_ACCOUNT'),
			'BANK_ID'=>$this->post('BANK_ID'),
			'CUSTOMER_NUMBER'=>$this->post('CUSTOMER_NUMBER'),
			'RECEIPT_DATE'=>$this->post('RECEIPT_DATE'),
			'CURRENCY_CODE'=>$this->post('CURRENCY_CODE'),
			'STATUS'=>$this->post('STATUS'),
			'AMOUNT'=>$this->post('AMOUNT'),
			'ATTRIBUTE_CATEGORY'=>$this->post('ATTRIBUTE_CATEGORY'),
			'REFERENCE_NUM'=>$this->post('REFERENCE_NUM'),
			'RECEIPT_TYPE'=>$this->post('RECEIPT_TYPE'),
			'TERMINAL'=>$this->post('TERMINAL'),
			'ATTRIBUTE1'=>$this->post('ATTRIBUTE1'),
			'ATTRIBUTE2'=>$this->post('ATTRIBUTE2'),
			'ATTRIBUTE3'=>$this->post('ATTRIBUTE3'),
			'ATTRIBUTE4'=>$this->post('ATTRIBUTE4'),
			'ATTRIBUTE5'=>$this->post('ATTRIBUTE5'),
			'ATTRIBUTE6'=>$this->post('ATTRIBUTE6'),
			'ATTRIBUTE7'=>$this->post('ATTRIBUTE7'),
			'ATTRIBUTE8'=>$this->post('ATTRIBUTE8'),
			'ATTRIBUTE9'=>$this->post('ATTRIBUTE9'),
			'ATTRIBUTE10'=>$this->post('ATTRIBUTE10'),
			'ATTRIBUTE11'=>$this->post('ATTRIBUTE11'),
			'ATTRIBUTE12'=>$this->post('ATTRIBUTE12'),
			'ATTRIBUTE13'=>$this->post('ATTRIBUTE13'),
			'ATTRIBUTE14'=>$this->post('ATTRIBUTE14'),
			'ATTRIBUTE15'=>$this->post('ATTRIBUTE15'),
			'INVOICE_NUM'=>$this->post('INVOICE_NUM')
			));
			
			$parameters=array( 
				array('name'=>':IN_SOURCE_INVOICE','value'=>$this->post('IN_SOURCE_INVOICE'),'length'=>100,'type'=>SQLT_CHR),
				array('name'=>':ORG_ID','value'=>$this->post('ORG_ID'),'length'=>10,'type'=>SQLT_INT),
				array('name'=>':RECEIPT_NUMBER','value'=>$this->post('RECEIPT_NUMBER'),'length'=>100,'type'=>SQLT_CHR),
				array('name'=>':RECEIPT_METHOD','value'=>$this->post('RECEIPT_METHOD'),'length'=>100,'type'=>SQLT_CHR),
				array('name'=>':RECEIPT_ACCOUNT','value'=>$this->post('RECEIPT_ACCOUNT'),'length'=>100,'type'=>SQLT_CHR),
				array('name'=>':BANK_ID','value'=>$this->post('BANK_ID'),'length'=>100,'type'=>SQLT_INT),
				array('name'=>':CUSTOMER_NUMBER','value'=>$this->post('CUSTOMER_NUMBER'),'length'=>100,'type'=>SQLT_CHR),
				array('name'=>':RECEIPT_DATE','value'=>$this->post('RECEIPT_DATE'),'length'=>100,'type'=>SQLT_CHR),
				array('name'=>':CURRENCY_CODE','value'=>$this->post('CURRENCY_CODE'),'length'=>100,'type'=>SQLT_CHR),
				array('name'=>':STATUS','value'=>$this->post('STATUS'),'length'=>100,'type'=>SQLT_CHR),
				array('name'=>':AMOUNT','value'=>$this->post('AMOUNT'),'length'=>100,'type'=>SQLT_INT),
				array('name'=>':ATTRIBUTE_CATEGORY','value'=>$this->post('ATTRIBUTE_CATEGORY'),'length'=>100,'type'=>SQLT_CHR),
				array('name'=>':REFERENCE_NUM','value'=>$this->post('REFERENCE_NUM'),'length'=>100,'type'=>SQLT_CHR),				
				array('name'=>':RECEIPT_TYPE','value'=>$this->post('RECEIPT_TYPE'),'length'=>100,'type'=>SQLT_CHR),
				array('name'=>':TERMINAL','value'=>$this->post('TERMINAL'),'length'=>100,'type'=>SQLT_CHR),
				array('name'=>':ATTRIBUTE1','value'=>$this->post('ATTRIBUTE1'),'length'=>100,'type'=>SQLT_CHR),
				array('name'=>':ATTRIBUTE2','value'=>$this->post('ATTRIBUTE2'),'length'=>100,'type'=>SQLT_CHR),
				array('name'=>':ATTRIBUTE3','value'=>$this->post('ATTRIBUTE3'),'length'=>100,'type'=>SQLT_CHR),
				array('name'=>':ATTRIBUTE4','value'=>$this->post('ATTRIBUTE4'),'length'=>100,'type'=>SQLT_CHR),
				array('name'=>':ATTRIBUTE5','value'=>$this->post('ATTRIBUTE5'),'length'=>100,'type'=>SQLT_CHR),
				array('name'=>':ATTRIBUTE6','value'=>$this->post('ATTRIBUTE6'),'length'=>100,'type'=>SQLT_CHR),
				array('name'=>':ATTRIBUTE7','value'=>$this->post('ATTRIBUTE7'),'length'=>100,'type'=>SQLT_CHR),
				array('name'=>':ATTRIBUTE8','value'=>$this->post('ATTRIBUTE8'),'length'=>100,'type'=>SQLT_CHR),
				array('name'=>':ATTRIBUTE9','value'=>$this->post('ATTRIBUTE9'),'length'=>100,'type'=>SQLT_CHR),
				array('name'=>':ATTRIBUTE10','value'=>$this->post('ATTRIBUTE10'),'length'=>100,'type'=>SQLT_CHR),
				array('name'=>':ATTRIBUTE11','value'=>$this->post('ATTRIBUTE11'),'length'=>100,'type'=>SQLT_CHR),
				array('name'=>':ATTRIBUTE12','value'=>$this->post('ATTRIBUTE12'),'length'=>100,'type'=>SQLT_CHR),
				array('name'=>':ATTRIBUTE13','value'=>$this->post('ATTRIBUTE13'),'length'=>100,'type'=>SQLT_CHR),
				array('name'=>':ATTRIBUTE14','value'=>$this->post('ATTRIBUTE14'),'length'=>100,'type'=>SQLT_CHR),
				array('name'=>':ATTRIBUTE15','value'=>$this->post('ATTRIBUTE15'),'length'=>100,'type'=>SQLT_CHR),
				array('name'=>':INVOICE_NUM','value'=>$this->post('INVOICE_NUM'),'length'=>100,'type'=>SQLT_CHR),
				array('name'=>':out_status','value'=>&$out_status,'length'=>100,'type'=>SQLT_CHR),
				array('name'=>':out_messages','value'=>&$out_messages,'length'=>1000,'type'=>SQLT_CHR)
			);
			
		//print_r($parameters);
        //die();		
		$this->invoice_consolidasi_db->stored_procedure('invoice.xeinvc_api_konsolidasi_pkg','insert_ar_receipt_header',$parameters);
		echo $out_status;
		echo $out_messages;
		//die();
					
			
        } else {
            $this->response( array('status'=>'failure', 
            'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_BAD_REQUEST);
        }
		$this->invoice_consolidasi_db->close();
    }

 

}