<?php
/***
Nama Controller 	: CreateInvoiceKapal.php
Ditulis oleh 		: Gagat Rahina
Tanggal Penulisan 	: 08 Februari 2018 
no hp 				: +628156237689
email 				: gagat.rahina@sigma.co.id


**/


defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class CreateInvoiceKapal extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }

  	function index_get() {
        $id = $this->uri->segment(2);
        $id2 = $this->uri->segment(3);

        $this->load->model('simop_createInvoiceKapal_model');
        if ($id == '') {
                $result= $this->simop_createInvoiceKapal_model->get_all();
        } else {
            if($id=='page' && $id2!==''){
                $total_posts = $this->simop_createInvoiceKapal_model->count_rows(); // retrieve the total number of posts
                $result = $this->simop_createInvoiceKapal_model->paginate(10,$total_posts);
            } else {           
                if($id!=='' && $id2==''){
                    $result= $this->simop_createInvoiceKapal_model->get(array('TRX_NUMBER'=>$id));  
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
		
		$this->kapal_db = $this->load->database('invoice_kapal_prod',true);
		//---------------------------------------		 
		
        if($this->form_validation->run('simop_kapal_create_invoice_post') != false){
            $this->load->model('Simop_createInvoiceKapal_model');
            $data = $this->post();				

            $safe_data = $this->Simop_createInvoiceKapal_model->get(array(
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
						
		//call package db yg lain
		$this->kapal_db->stored_procedure('KAPAL_PROD.XEINVC_KAPAL_PKG','CREATE_INVOICE_KAPAL',$parameters);
			
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
				
				$url = 'http://localhost/wsap/CreateInvoiceKapal/'.$get_trx_number.'/';
				$data = array(
					"TRX_NUMBER" => "'".$get_trx_number."'"
				);
				//echo $data;
				
				$query_url = sprintf("%s?%s", $url, http_build_query($data));
				// remark sementara header('Content-type: application/json');
				$postdata=file_get_contents($query_url);
				//echo file_get_contents($query_url(1));
				
				$objectData = json_decode($postdata);
				echo "trx number : ".$objectData->{'TRX_NUMBER'}; 
				
								
				//---------------------
				$service_url = 'http://localhost/wsap/SimopInvoiceHeader/';
				$curl = curl_init($service_url);
				$curl_post_data = array(
					"SOURCE_INVOICE"=>$objectData->{'JENIS_MODUL'},
					"BILLER_REQUEST_ID" => $objectData->{'TRX_NUMBER'},
					"TRX_NUMBER" => $objectData->{'TRX_NUMBER'},
					"ORG_ID" => $objectData->{'ORG_ID'},
					"CUSTOMER_NUMBER"=> $objectData->{'CUSTOMER_NUMBER'},
					"CUSTOMER_NAME"=>'',///belum dibuat data $objectData->{'CUSTOMER_NAME'},
					"TRX_DATE"=>$objectData->{'TRX_DATE'},
					"TRX_CLASS"=>'INV',//'INV',
					"CURRENCY_CODE"=>$objectData->{'CURRENCY_CODE'},
					'STATUS'=>'P',
					'HEADER_CONTEXT'=>$objectData->{'JENIS_MODUL'},
					'HEADER_SUB_CONTEXT'=>$objectData->{'JENIS_NOTA'},
					'TERMINAL'=>'001 SWAS',
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
				echo $curl_response;
				
				curl_close($curl);
				//2. START INSER DETAIL 
				//echo "object data detail : ".$objectData->{'TRX_NUMBER'};
				//die();
				$url = base_url().'GetInvoiceKapalDetail/'.$objectData->{'TRX_NUMBER'}.'/';
				$data = array(
					"TRX_NUMBER" => "'".$objectData->{'TRX_NUMBER'}."'"
				);
				$query_url = sprintf("%s?%s", $url, http_build_query($data));
				// remark sementara header('Content-type: application/json');
				$postdata=file_get_contents($query_url);
								
				$dataDetail = (array) json_decode($postdata,true);
				
				foreach ($dataDetail as $objectDetail){					
					//-------------------------------------------
					echo "TRX NUMBER ".$objectDetail['TRX_NUMBER']."<br>";
					echo "LINE NUMBER ".$objectDetail['LINE_NUMBER']."<br>";
					$service_url = base_url().'SimopInvoiceDetail/';
					$curl = curl_init($service_url);
					$curl_post_data = array(
						"BILLER_REQUEST_ID" => $objectDetail['TRX_NUMBER'],
						"TRX_NUMBER" => $objectDetail['TRX_NUMBER'],
						"LINE_NUMBER" => $objectDetail['LINE_NUMBER'],
						"TAX_FLAG"=> $objectDetail['TAX_FLAG'],
						"SERVICE_TYPE"=>$objectDetail['TIPE_LAYANAN'].' '.$objectDetail['TIPE_PELABUHAN'],
						"AMOUNT"=>$objectDetail['AMOUNT'],
						"CREATION_DATE"=>'19-FEB-18',//HARUS DIGANTI HATI HATI MASIH HARDCODE
						"LAST_UPDATED_DATE"=>'19-FEB-18'///HARUS DIGANTI HATI HATI MASIH HARDCODE
						);
					curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($curl, CURLOPT_POST, true);
					curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data);
					$curl_response = curl_exec($curl);	
					echo "detail ".$curl_response."<br>";
					curl_close($curl);				
					//-------------------------------------------
				}
				
				
			}
			///die();
			/**update status PKK di SIMOP KAPAL
			mennjadi 4
			call procedure 
			*/
			
		$parameters=array( 
			array('name'=>':IN_NO_UKK','value'=>$objectData->{'NO_UKK'},'length'=>100,'type'=>SQLT_CHR),
			array('name'=>':IN_KODE_PROSES','value'=>'4','length'=>100,'type'=>SQLT_CHR),
			array('name'=>':out_status','value'=>&$out_status,'length'=>100,'type'=>SQLT_CHR),
			array('name'=>':out_messages','value'=>&$out_messages,'length'=>1000,'type'=>SQLT_CHR)
		);
			
		//print_r($parameters);
        		
		$this->kapal_db->stored_procedure('kapal_prod.xeinvc_kapal_pkg','update_status_pkk',$parameters);
		//echo "status update PKK ".$out_status;	
		//echo "message update pkk ".$out_messages;
		//start run procedure JAI
		$parameters_jai=array( 
			array('name'=>':NO_UKK','value'=>$objectData->{'NO_UKK'},'length'=>100,'type'=>SQLT_CHR),
			array('name'=>':PARAM_NOTA','value'=>$out_status,'length'=>100,'type'=>SQLT_CHR),			
			array('name'=>':OUT_ERRORMESSAGE','value'=>&$out_errormesage,'length'=>1000,'type'=>SQLT_CHR)
		);
		$this->kapal_db->stored_procedure('kapal_prod.nota_jai_pkg','insert_nota_jai',$parameters_jai);	
		echo "insert JAI : ".$out_errormesage;
		//die();	
		//END run procedure JAI 
				
			
        } else {
            $this->response( array('status'=>'failure', 
            'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_BAD_REQUEST);
        }
		
		//close db yg lain
		$this->kapal_db->close();
		
    }
}