<?php
/***
Nama Controller 	: CreateInvoiceRupa.php
Ditulis oleh 		: Gagat Rahina
Tanggal Penulisan 	: 08 Februari 2018 
no hp 				: +628156237689
email 				: gagat.rahina@sigma.co.id


**/


defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class CreateInvoiceRupa extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }

  	function index_get() {
        $id = $this->uri->segment(2);
        $id2 = $this->uri->segment(3);

        $this->load->model('simop_createInvoiceRupa_model');
        if ($id == '') {
                $result= $this->simop_createInvoiceRupa_model->get_all();
        } else {
            if($id=='page' && $id2!==''){
                $total_posts = $this->simop_createInvoiceRupa_model->count_rows(); // retrieve the total number of posts
                $result = $this->simop_createInvoiceRupa_model->paginate(10,$total_posts);
            } else {           
                if($id!=='' && $id2==''){
                    $result= $this->simop_createInvoiceRupa_model->get(array('TRX_NUMBER'=>$id));  
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
		$this->rupa_db = $this->load->database('invoice_rupa2_prod',true);
		//---------------------------------------		 
		
        if($this->form_validation->run('simop_rupa_create_invoice_post') != false){
            $this->load->model('simop_createInvoiceRupa_model');
            $data = $this->post();				

            $safe_data = $this->simop_createInvoiceRupa_model->get(array(
			'TRX_NUMBER'=>$this->post('TRX_NUMBER'),
			'ORG_ID'=>$this->post('ORG_ID'),			
			'JENIS_NOTA'=>$this->post('JENIS_NOTA')		
			));
			
			$parameters=array( 
				array('name'=>':TRX_NUMBER','value'=>$this->post('TRX_NUMBER'),'length'=>100,'type'=>SQLT_CHR),
				array('name'=>':ORG_ID','value'=>$this->post('ORG_ID'),'length'=>100,'type'=>SQLT_INT),				
				array('name'=>':JENIS_NOTA','value'=>$this->post('JENIS_NOTA'),'length'=>100,'type'=>SQLT_CHR),				
				array('name'=>':out_status','value'=>&$out_status,'length'=>100,'type'=>SQLT_CHR),
				array('name'=>':out_messages','value'=>&$out_messages,'length'=>1000,'type'=>SQLT_CHR)
			);
			
			//print_r($parameters);
			//die();
			
			
		//$this->db->stored_procedure('RUPA2_PROD.XEINVC_RUPA_PKG','CREATE_INVOICE_RUPA',$parameters);
		
		//call package db yg lain
		$this->rupa_db->stored_procedure('RUPA2_PROD.XEINVC_RUPA_PKG','CREATE_INVOICE_RUPA',$parameters);
			
	    /*
		memanggil web service SimopInvoiceHeader dan SimopInvoiceDetail
		*/
			if ($out_status=='S'){								
				/*
				AMBIL DATA 
				*/
				//echo "apakah sukses insert populate data ipctpk header ";
				//die();
				//---------------------
				$get_trx_number= $this->post('TRX_NUMBER');
				
				$url = 'http://localhost/wsap/CreateInvoiceRupa/'.$get_trx_number.'/';
				$data = array(
					"TRX_NUMBER" => "'".$get_trx_number."'"
				);
				$query_url = sprintf("%s?%s", $url, http_build_query($data));
				// remark sementara header('Content-type: application/json');
				$postdata=file_get_contents($query_url);
				//echo file_get_contents($query_url(1));
				
				$objectData = json_decode($postdata);
				//echo "trx number : ".$objectData->{'TRX_NUMBER'}; 
				//die();

								
				//---------------------
				$service_url = 'http://localhost/wsap/SimopInvoiceHeader/';
				$curl = curl_init($service_url);
				$curl_post_data = array(
					"SOURCE_INVOICE"=>$objectData->{'JENIS_MODUL'},
					"BILLER_REQUEST_ID" => $objectData->{'TRX_NUMBER'},
					"TRX_NUMBER" => $objectData->{'TRX_NUMBER'},
					"ORG_ID" => $objectData->{'ORG_ID'},
					"CUSTOMER_NUMBER"=> $objectData->{'CUSTOMER_NUMBER'},
					"CUSTOMER_NAME"=>$objectData->{'CUSTOMER_NAME'},
					"TRX_DATE"=>$objectData->{'TRX_DATE'},
					"TRX_CLASS"=>'INV',//'INV',
					"CURRENCY_CODE"=>$objectData->{'CURRENCY_CODE'},
					'STATUS'=>'P',
					'HEADER_CONTEXT'=> 'RP2',//$objectData->{'JENIS_MODUL'},
					'HEADER_SUB_CONTEXT'=> $objectData->{'JENIS_NOTA'},
					'TERMINAL'=>'02',
					'ATTRIBUTE1'=>'',//$objectData->{'ATTRIBUTE1'},
					'ATTRIBUTE2'=>'',//$objectData->{'ATTRIBUTE2'},
					'ATTRIBUTE3'=>'',//$objectData->{'ATTRIBUTE3'},
					'ATTRIBUTE4'=>'',//$objectData->{'ATTRIBUTE4'},
					'ATTRIBUTE5'=>'',//$objectData->{'ATTRIBUTE5'},
					'ATTRIBUTE6'=>'',//$objectData->{'ATTRIBUTE6'},
					'ATTRIBUTE7'=>'',//$objectData->{'ATTRIBUTE7'},
					'ATTRIBUTE8'=>'',//$objectData->{'ATTRIBUTE8'},
					'ATTRIBUTE9'=>'',//$objectData->{'ATTRIBUTE9'},
					'ATTRIBUTE10'=>'',//$objectData->{'ATTRIBUTE10'},
					'ATTRIBUTE11'=>'',//$objectData->{'ATTRIBUTE11'},
					'ATTRIBUTE12'=>'',//$objectData->{'ATTRIBUTE12'},
					'ATTRIBUTE13'=>'',//$objectData->{'ATTRIBUTE13'},
					'ATTRIBUTE14'=>'',//$objectData->{'ATTRIBUTE14'},
					'ATTRIBUTE15'=>''//$objectData->{'ATTRIBUTE15'}
					);
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($curl, CURLOPT_POST, true);
				curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data);
				$curl_response = curl_exec($curl);
				
				curl_close($curl);
				//2. START INSER DETAIL 
				//echo "object data detail : ".$objectData->{'TRX_NUMBER'};
				//die();
				$url = 'http://localhost/wsap/GetInvoiceRupaDetail/'.$objectData->{'TRX_NUMBER'}.'/';
				$data = array(
					"TRX_NUMBER" => "'".$objectData->{'TRX_NUMBER'}."'"
				);
				$query_url = sprintf("%s?%s", $url, http_build_query($data));
				// remark sementara header('Content-type: application/json');
				$postdata=file_get_contents($query_url);
								
				$dataDetail = (array) json_decode($postdata,true);
				
				foreach ($dataDetail as $objectDetail){					
					//-------------------------------------------
					$service_url = 'http://localhost/wsap/SimopInvoiceDetail/';
					$curl = curl_init($service_url);
					$curl_post_data = array(
						"BILLER_REQUEST_ID" => $objectDetail['TRX_NUMBER'],
						"TRX_NUMBER" => $objectDetail['TRX_NUMBER'],
						"LINE_NUMBER" => $objectDetail['LINE_NUMBER'],
						"TAX_FLAG"=> $objectDetail['TAX_FLAG'],
						"SERVICE_TYPE"=>$objectDetail['TIPE_LAYANAN'],
						"AMOUNT"=>$objectDetail['AMOUNT'],
						"CREATION_DATE"=>'08-FEB-18',
						"LAST_UPDATED_DATE"=>'08-FEB-18'
						);
					curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($curl, CURLOPT_POST, true);
					curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data);
					$curl_response = curl_exec($curl);	
					//echo "detail ".$curl_response;
					//die();
					curl_close($curl);				
					//-------------------------------------------
				}
				
			}			
			
        } else {
            $this->response( array('status'=>'failure', 
            'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_BAD_REQUEST);
        }
		
		//close db yg lain
		$this->rupa_db->close();
		
    }
}