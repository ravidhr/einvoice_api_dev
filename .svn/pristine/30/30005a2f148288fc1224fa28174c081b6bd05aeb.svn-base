<?php
/**
nama Controller : SimopInvoiceDetail.php
Dibuat Oleh     : Gagat Rahina 
tgl             : 5 Februari 2018 
no telp         : +628156237689
email           : gagat.rahina@sigma.co.id

web service ini digunakan untuk memasukkan data ke table staging konsolidasi XEINVC_AR_INVOICE_LINES
dengan menggunakan package di database konsolidasi xeinvc_api_konsolidasi_pkg
**/

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class SimopInvoiceDetail extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }

  

    function index_post() {
		
		$id = $this->uri->segment(2);
	
        $this->load->library('form_validation');
        $this->form_validation->set_data($this->put());
		//---------------------------------------	
		$this->konsolidasi_db = $this->load->database('invoice_consolidasi',true);	
		
        if($this->form_validation->run('simop_invoice_detail_post') != false){
            $this->load->model('simop_invoice_detail_model');
            $data = $this->post();				

            $safe_data = $this->simop_invoice_detail_model->get(array(
			'BILLER_REQUEST_ID'=>$this->post('BILLER_REQUEST_ID'),
			'TRX_NUMBER'=>$this->post('TRX_NUMBER'),
			'LINE_NUMBER'=>$this->post('LINE_NUMBER'),
			'DESCRIPTION'=>$this->post('DESCRIPTION'),
			'TAX_FLAG'=>$this->post('TAX_FLAG'),
			'SERVICE_TYPE'=>$this->post('SERVICE_TYPE'),
			'AMOUNT'=>$this->post('AMOUNT'),
			'CREATED_BY'=>$this->post('CREATED_BY'),
			'CREATION_DATE'=>$this->post('CREATION_DATE'),
			'LAST_UPDATED_BY'=>$this->post('LAST_UPDATED_BY'),
			'LAST_UPDATED_DATE'=>$this->post('LAST_UPDATED_DATE'),
			'INTERFACE_LINE_ATTRIBUTE1'=>$this->post('INTERFACE_LINE_ATTRIBUTE1'),
			'INTERFACE_LINE_ATTRIBUTE2'=>$this->post('INTERFACE_LINE_ATTRIBUTE2'),
			'INTERFACE_LINE_ATTRIBUTE3'=>$this->post('INTERFACE_LINE_ATTRIBUTE3'),
			'INTERFACE_LINE_ATTRIBUTE4'=>$this->post('INTERFACE_LINE_ATTRIBUTE4'),
			'INTERFACE_LINE_ATTRIBUTE5'=>$this->post('INTERFACE_LINE_ATTRIBUTE5'),
			'INTERFACE_LINE_ATTRIBUTE6'=>$this->post('INTERFACE_LINE_ATTRIBUTE6'),
			'INTERFACE_LINE_ATTRIBUTE7'=>$this->post('INTERFACE_LINE_ATTRIBUTE7'),
			'INTERFACE_LINE_ATTRIBUTE8'=>$this->post('INTERFACE_LINE_ATTRIBUTE8'),
			'INTERFACE_LINE_ATTRIBUTE9'=>$this->post('INTERFACE_LINE_ATTRIBUTE9'),
			'INTERFACE_LINE_ATTRIBUTE10'=>$this->post('INTERFACE_LINE_ATTRIBUTE10'),
			'INTERFACE_LINE_ATTRIBUTE11'=>$this->post('INTERFACE_LINE_ATTRIBUTE11'),
			'INTERFACE_LINE_ATTRIBUTE12'=>$this->post('INTERFACE_LINE_ATTRIBUTE12'),
			'INTERFACE_LINE_ATTRIBUTE13'=>$this->post('INTERFACE_LINE_ATTRIBUTE13'),
			'INTERFACE_LINE_ATTRIBUTE14'=>$this->post('INTERFACE_LINE_ATTRIBUTE14'),
			'INTERFACE_LINE_ATTRIBUTE15'=>$this->post('INTERFACE_LINE_ATTRIBUTE15'),
			'LINE_DOC'=>$this->post('LINE_DOC')
			));
			
			$parameters=array( 
				array('name'=>':BILLER_REQUEST_ID','value'=>$this->post('BILLER_REQUEST_ID'),'length'=>100,'type'=>SQLT_CHR),
				array('name'=>':TRX_NUMBER','value'=>$this->post('TRX_NUMBER'),'length'=>100,'type'=>SQLT_CHR),
				array('name'=>':LINE_NUMBER','value'=>$this->post('LINE_NUMBER'),'length'=>100,'type'=>SQLT_INT),
				array('name'=>':DESCRIPTION','value'=>$this->post('DESCRIPTION'),'length'=>100,'type'=>SQLT_CHR),				
				array('name'=>':TAX_FLAG','value'=>$this->post('TAX_FLAG'),'length'=>100,'type'=>SQLT_CHR),
				array('name'=>':SERVICE_TYPE','value'=>$this->post('SERVICE_TYPE'),'length'=>100,'type'=>SQLT_CHR),
				array('name'=>':AMOUNT','value'=>$this->post('AMOUNT'),'length'=>100,'type'=>SQLT_INT),
				array('name'=>':CREATED_BY','value'=>$this->post('CREATED_BY'),'length'=>100,'type'=>SQLT_INT),
				array('name'=>':CREATION_DATE','value'=>$this->post('CREATION_DATE'),'length'=>100,'type'=>SQLT_CHR),
				array('name'=>':LAST_UPDATED_BY','value'=>$this->post('LAST_UPDATED_BY'),'length'=>100,'type'=>SQLT_INT),
				array('name'=>':LAST_UPDATED_DATE','value'=>$this->post('LAST_UPDATED_DATE'),'length'=>100,'type'=>SQLT_CHR),
				array('name'=>':INTERFACE_LINE_ATTRIBUTE1','value'=>$this->post('INTERFACE_LINE_ATTRIBUTE1'),'length'=>100,'type'=>SQLT_CHR),
				array('name'=>':INTERFACE_LINE_ATTRIBUTE2','value'=>$this->post('INTERFACE_LINE_ATTRIBUTE2'),'length'=>100,'type'=>SQLT_CHR),
				array('name'=>':INTERFACE_LINE_ATTRIBUTE3','value'=>$this->post('INTERFACE_LINE_ATTRIBUTE3'),'length'=>100,'type'=>SQLT_CHR),
				array('name'=>':INTERFACE_LINE_ATTRIBUTE4','value'=>$this->post('INTERFACE_LINE_ATTRIBUTE4'),'length'=>100,'type'=>SQLT_CHR),
				array('name'=>':INTERFACE_LINE_ATTRIBUTE5','value'=>$this->post('INTERFACE_LINE_ATTRIBUTE5'),'length'=>100,'type'=>SQLT_CHR),
				array('name'=>':INTERFACE_LINE_ATTRIBUTE6','value'=>$this->post('INTERFACE_LINE_ATTRIBUTE6'),'length'=>100,'type'=>SQLT_CHR),
				array('name'=>':INTERFACE_LINE_ATTRIBUTE7','value'=>$this->post('INTERFACE_LINE_ATTRIBUTE7'),'length'=>100,'type'=>SQLT_CHR),
				array('name'=>':INTERFACE_LINE_ATTRIBUTE8','value'=>$this->post('INTERFACE_LINE_ATTRIBUTE8'),'length'=>100,'type'=>SQLT_CHR),
				array('name'=>':INTERFACE_LINE_ATTRIBUTE9','value'=>$this->post('INTERFACE_LINE_ATTRIBUTE9'),'length'=>100,'type'=>SQLT_CHR),
				array('name'=>':INTERFACE_LINE_ATTRIBUTE10','value'=>$this->post('INTERFACE_LINE_ATTRIBUTE10'),'length'=>100,'type'=>SQLT_CHR),
				array('name'=>':INTERFACE_LINE_ATTRIBUTE11','value'=>$this->post('INTERFACE_LINE_ATTRIBUTE11'),'length'=>100,'type'=>SQLT_CHR),
				array('name'=>':INTERFACE_LINE_ATTRIBUTE12','value'=>$this->post('INTERFACE_LINE_ATTRIBUTE12'),'length'=>100,'type'=>SQLT_CHR),
				array('name'=>':INTERFACE_LINE_ATTRIBUTE13','value'=>$this->post('INTERFACE_LINE_ATTRIBUTE13'),'length'=>100,'type'=>SQLT_CHR),
				array('name'=>':INTERFACE_LINE_ATTRIBUTE14','value'=>$this->post('INTERFACE_LINE_ATTRIBUTE14'),'length'=>100,'type'=>SQLT_CHR),
				array('name'=>':INTERFACE_LINE_ATTRIBUTE15','value'=>$this->post('INTERFACE_LINE_ATTRIBUTE15'),'length'=>100,'type'=>SQLT_CHR),
				array('name'=>':LINE_DOC','value'=>$this->post('LINE_DOC'),'length'=>100,'type'=>SQLT_CHR),	
				array('name'=>':out_status','value'=>&$out_status,'length'=>100,'type'=>SQLT_CHR),
				array('name'=>':out_messages','value'=>&$out_messages,'length'=>1000,'type'=>SQLT_CHR)
			);
			
		//print_r($parameters);
        //die();		
		$this->konsolidasi_db->stored_procedure('invoice.xeinvc_api_konsolidasi_pkg','insert_ar_invoice_lines',$parameters);
		echo $out_status;
		echo $out_messages;
		//die();
		
			
        } else {
            $this->response( array('status'=>'failure', 
            'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_BAD_REQUEST);
        }
    }

 

}