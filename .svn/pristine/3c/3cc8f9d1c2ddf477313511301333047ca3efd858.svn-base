<?php

/**
nama Controller : SimopInvoiceHeader.php
Dibuat Oleh     : Gagat Rahina 
tgl             : 5 Februari 2018 
no telp         : +628156237689
email           : gagat.rahina@sigma.co.id


web service ini digunakan untuk memasukkan data ke table staging konsolidasi XEINVC_AR_INVOICE_HEADER
dengan menggunakan package di database konsolidasi xeinvc_api_konsolidasi_pkg
**/

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class SimopInvoiceHeader extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }

  

    function index_post() {
		
		$id = $this->uri->segment(2);
	
        $this->load->library('form_validation');
        $this->form_validation->set_data($this->put());
		//---------------------------------------
		$this->konsolidasi_db = $this->load->database('invoice_consolidasi',true);	
		
        if($this->form_validation->run('simop_invoice_header_post') != false){
            $this->load->model('Simop_invoice_header_model');
            $data = $this->post();				

            $safe_data = $this->Simop_invoice_header_model->get(array(
			'SOURCE_INVOICE'=>$this->post('SOURCE_INVOICE'),
			'BILLER_REQUEST_ID'=>$this->post('BILLER_REQUEST_ID'),
			'ORG_ID'=>$this->post('ORG_ID'),
			'TRX_NUMBER'=>$this->post('TRX_NUMBER'),
			'TRX_NUMBER_PREV'=>$this->post('TRX_NUMBER_PREV'),
			'TRX_DATE'=>$this->post('TRX_DATE'),
			'TRX_CLASS'=>$this->post('TRX_CLASS'),
			'CURRENCY_CODE'=>$this->post('CURRENCY_CODE'),
			'CURRENCY_RATE'=>$this->post('CURRENCY_RATE'),
			'CURRENCY_DATE'=>$this->post('CURRENCY_DATE'),
			'CUSTOMER_NUMBER'=>$this->post('CUSTOMER_NUMBER'),
			'CUSTOMER_NAME'=>$this->post('CUSTOMER_NAME'),
			'CUSTOMER_NPWP'=>$this->post('CUSTOMER_NPWP'),
			'STATUS'=>$this->post('STATUS'),
			'HEADER_CONTEXT'=>$this->post('HEADER_CONTEXT'),
			'HEADER_SUB_CONTEXT'=>$this->post('HEADER_SUB_CONTEXT'),
			'TERMINAL'=>$this->post('TERMINAL'),
			'VESSEL_NAME'=>$this->post('VESSEL_NAME'),
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
			'INTERFACE_HEADER_ATTRIBUTE1'=>$this->post('INTERFACE_HEADER_ATTRIBUTE1'),
			'INTERFACE_HEADER_ATTRIBUTE2'=>$this->post('INTERFACE_HEADER_ATTRIBUTE2'),
			'INTERFACE_HEADER_ATTRIBUTE3'=>$this->post('INTERFACE_HEADER_ATTRIBUTE3'),
			'INTERFACE_HEADER_ATTRIBUTE4'=>$this->post('INTERFACE_HEADER_ATTRIBUTE4'),
			'INTERFACE_HEADER_ATTRIBUTE5'=>$this->post('INTERFACE_HEADER_ATTRIBUTE5'),
			'INTERFACE_HEADER_ATTRIBUTE6'=>$this->post('INTERFACE_HEADER_ATTRIBUTE6'),
			'INTERFACE_HEADER_ATTRIBUTE7'=>$this->post('INTERFACE_HEADER_ATTRIBUTE7'),
			'INTERFACE_HEADER_ATTRIBUTE8'=>$this->post('INTERFACE_HEADER_ATTRIBUTE8'),
			'INTERFACE_HEADER_ATTRIBUTE9'=>$this->post('INTERFACE_HEADER_ATTRIBUTE9'),
			'INTERFACE_HEADER_ATTRIBUTE10'=>$this->post('INTERFACE_HEADER_ATTRIBUTE10'),
			'INTERFACE_HEADER_ATTRIBUTE11'=>$this->post('INTERFACE_HEADER_ATTRIBUTE11'),
			'INTERFACE_HEADER_ATTRIBUTE12'=>$this->post('INTERFACE_HEADER_ATTRIBUTE12'),
			'INTERFACE_HEADER_ATTRIBUTE13'=>$this->post('INTERFACE_HEADER_ATTRIBUTE13'),
			'INTERFACE_HEADER_ATTRIBUTE14'=>$this->post('INTERFACE_HEADER_ATTRIBUTE14'),
			'INTERFACE_HEADER_ATTRIBUTE15'=>$this->post('INTERFACE_HEADER_ATTRIBUTE15'),
			'DOC_NUM'=>$this->post('DOC_NUM')			
			));
			
			$parameters=array( 
				array('name'=>':SOURCE_INVOICE','value'=>$this->post('SOURCE_INVOICE'),'length'=>100,'type'=>SQLT_CHR),
				array('name'=>':BILLER_REQUEST_ID','value'=>$this->post('BILLER_REQUEST_ID'),'length'=>100,'type'=>SQLT_CHR),
				array('name'=>':ORG_ID','value'=>$this->post('ORG_ID'),'length'=>10,'type'=>SQLT_INT),
				array('name'=>':TRX_NUMBER','value'=>$this->post('TRX_NUMBER'),'length'=>100,'type'=>SQLT_CHR),
				array('name'=>':TRX_NUMBER_PREV','value'=>$this->post('TRX_NUMBER_PREV'),'length'=>100,'type'=>SQLT_CHR),
				array('name'=>':TRX_DATE','value'=>$this->post('TRX_DATE'),'length'=>100,'type'=>SQLT_CHR),
				array('name'=>':TRX_CLASS','value'=>$this->post('TRX_CLASS'),'length'=>100,'type'=>SQLT_CHR),
				array('name'=>':CURRENCY_CODE','value'=>$this->post('CURRENCY_CODE'),'length'=>100,'type'=>SQLT_CHR),
				array('name'=>':CURRENCY_RATE','value'=>$this->post('CURRENCY_RATE'),'length'=>100,'type'=>SQLT_INT),
				array('name'=>':CURRENCY_DATE','value'=>$this->post('CURRENCY_DATE'),'length'=>100,'type'=>SQLT_CHR),
				array('name'=>':CUSTOMER_NUMBER','value'=>$this->post('CUSTOMER_NUMBER'),'length'=>100,'type'=>SQLT_CHR),
				array('name'=>':CUSTOMER_NAME','value'=>$this->post('CUSTOMER_NAME'),'length'=>100,'type'=>SQLT_CHR),
				array('name'=>':CUSTOMER_NPWP','value'=>$this->post('CUSTOMER_NPWP'),'length'=>100,'type'=>SQLT_CHR),
				array('name'=>':STATUS','value'=>$this->post('STATUS'),'length'=>100,'type'=>SQLT_CHR),
				array('name'=>':HEADER_CONTEXT','value'=>$this->post('HEADER_CONTEXT'),'length'=>100,'type'=>SQLT_CHR),
				array('name'=>':HEADER_SUB_CONTEXT','value'=>$this->post('HEADER_SUB_CONTEXT'),'length'=>100,'type'=>SQLT_CHR),
				array('name'=>':TERMINAL','value'=>$this->post('TERMINAL'),'length'=>100,'type'=>SQLT_CHR),				
				array('name'=>':VESSEL_NAME','value'=>$this->post('VESSEL_NAME'),'length'=>100,'type'=>SQLT_CHR),
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
				array('name'=>':INTERFACE_HEADER_ATTRIBUTE1','value'=>$this->post('INTERFACE_HEADER_ATTRIBUTE1'),'length'=>100,'type'=>SQLT_CHR),
				array('name'=>':INTERFACE_HEADER_ATTRIBUTE2','value'=>$this->post('INTERFACE_HEADER_ATTRIBUTE2'),'length'=>100,'type'=>SQLT_CHR),
				array('name'=>':INTERFACE_HEADER_ATTRIBUTE3','value'=>$this->post('INTERFACE_HEADER_ATTRIBUTE3'),'length'=>100,'type'=>SQLT_CHR),
				array('name'=>':INTERFACE_HEADER_ATTRIBUTE4','value'=>$this->post('INTERFACE_HEADER_ATTRIBUTE4'),'length'=>100,'type'=>SQLT_CHR),
				array('name'=>':INTERFACE_HEADER_ATTRIBUTE5','value'=>$this->post('INTERFACE_HEADER_ATTRIBUTE5'),'length'=>100,'type'=>SQLT_CHR),
				array('name'=>':INTERFACE_HEADER_ATTRIBUTE6','value'=>$this->post('INTERFACE_HEADER_ATTRIBUTE6'),'length'=>100,'type'=>SQLT_CHR),
				array('name'=>':INTERFACE_HEADER_ATTRIBUTE7','value'=>$this->post('INTERFACE_HEADER_ATTRIBUTE7'),'length'=>100,'type'=>SQLT_CHR),
				array('name'=>':INTERFACE_HEADER_ATTRIBUTE8','value'=>$this->post('INTERFACE_HEADER_ATTRIBUTE8'),'length'=>100,'type'=>SQLT_CHR),
				array('name'=>':INTERFACE_HEADER_ATTRIBUTE9','value'=>$this->post('INTERFACE_HEADER_ATTRIBUTE9'),'length'=>100,'type'=>SQLT_CHR),
				array('name'=>':INTERFACE_HEADER_ATTRIBUTE10','value'=>$this->post('INTERFACE_HEADER_ATTRIBUTE10'),'length'=>100,'type'=>SQLT_CHR),
				array('name'=>':INTERFACE_HEADER_ATTRIBUTE11','value'=>$this->post('INTERFACE_HEADER_ATTRIBUTE11'),'length'=>100,'type'=>SQLT_CHR),
				array('name'=>':INTERFACE_HEADER_ATTRIBUTE12','value'=>$this->post('INTERFACE_HEADER_ATTRIBUTE12'),'length'=>100,'type'=>SQLT_CHR),
				array('name'=>':INTERFACE_HEADER_ATTRIBUTE13','value'=>$this->post('INTERFACE_HEADER_ATTRIBUTE13'),'length'=>100,'type'=>SQLT_CHR),
				array('name'=>':INTERFACE_HEADER_ATTRIBUTE14','value'=>$this->post('INTERFACE_HEADER_ATTRIBUTE14'),'length'=>100,'type'=>SQLT_CHR),
				array('name'=>':INTERFACE_HEADER_ATTRIBUTE15','value'=>$this->post('INTERFACE_HEADER_ATTRIBUTE15'),'length'=>100,'type'=>SQLT_CHR),	
				array('name'=>':DOC_NUM','value'=>$this->post('DOC_NUM'),'length'=>100,'type'=>SQLT_CHR),	
				array('name'=>':out_status','value'=>&$out_status,'length'=>100,'type'=>SQLT_CHR),
				array('name'=>':out_messages','value'=>&$out_messages,'length'=>1000,'type'=>SQLT_CHR)
			);
			
		//print_r($parameters);
        //die();		
		$this->konsolidasi_db->stored_procedure('invoice.xeinvc_api_konsolidasi_pkg','insert_ar_invoice_header',$parameters);
		echo $out_status;
		echo $out_messages;
		//die();
					
			
        } else {
            $this->response( array('status'=>'failure', 
            'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_BAD_REQUEST);
        }
		//close db konsolidasi
		$this->konsolidasi_db->close();
    }

 

}