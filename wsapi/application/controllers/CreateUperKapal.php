<?php
/***
Nama Controller 	: CreateUperKapal.php
Ditulis oleh 		: Gagat Rahina
Tanggal Penulisan 	: 22 Februari 2018 
no hp 				: +628156237689
email 				: gagat.rahina@sigma.co.id


**/


defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class CreateUperKapal extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }

  	function index_get() {
        $kd_ppkb = $this->uri->segment(2);
        $ppkb_ke = $this->uri->segment(3);
        //echo "kd ppkb ".$kd_ppkb."<br>";
		//echo "ppkb ke ".$ppkb_ke."<br>";
		//die();
        $this->load->model('Simop_createUperKapal_model');
        if ($kd_ppkb == '') {
                $result= $this->Simop_createUperKapal_model->get_all();
        } else {
            if($kd_ppkb=='page' && $ppkb_ke!==''){
                $total_posts = $this->Simop_createUperKapal_model->count_rows(); // retrieve the total number of posts
                $result = $this->Simop_createUperKapal_model->paginate(10,$total_posts);
            } else {           
                if($kd_ppkb!=='' /*&& $ppkb_ke!==''*/){
                    $result= $this->Simop_createUperKapal_model->get(array('KD_PPKB'=>$kd_ppkb));  
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
		
		$this->kapal_cabang_db = $this->load->database('invoice_kapal_cabang',true);
		//---------------------------------------		 
		
        if($this->form_validation->run('simop_kapal_create_uper_post') != false){
            $this->load->model('Simop_createUperKapal_model');
            $data = $this->post();	

			$get_kd_ppkb= $this->post('KD_PPKB');
			$amount_update_uper= $this->post('AMOUNT_UPDATE_UPER');
			//echo "amount uper ".$amount_update_uper;
			//die();	
				$url = base_url().'CreateUperKapal/'.$get_kd_ppkb.'/';
				$data = array(
					"KD_PPKB" => "'".$get_kd_ppkb."'"
				);
				//echo $data;
				
				$query_url = sprintf("%s?%s", $url, http_build_query($data));
				// remark sementara header('Content-type: application/json');
				$postdata=file_get_contents($query_url);
				//echo file_get_contents($query_url(1));
				
				$objectData = json_decode($postdata);
				
				
				//call procedure sp uper
				$parameters_sp_uper=array( 
				array('name'=>':IN_NO_UKK','value'=>$objectData->{'NO_UKK'},'length'=>100,'type'=>SQLT_CHR),
				array('name'=>':IN_KD_PPKB','value'=>$objectData->{'KD_PPKB'},'length'=>100,'type'=>SQLT_CHR),
				array('name'=>':IN_PPKB_KE','value'=>$objectData->{'PPKB_KE'},'length'=>100,'type'=>SQLT_INT),				
				array('name'=>':out_status','value'=>&$out_status,'length'=>100,'type'=>SQLT_CHR),
				array('name'=>':out_messages','value'=>&$out_messages,'length'=>1000,'type'=>SQLT_CHR)
				);
				
								
				$this->kapal_cabang_db->stored_procedure('KAPAL_CABANG.XEINVC_KAPAL_PKG','CALL_SP_UPER',$parameters_sp_uper); 
				//menampilkan data dari simkeu_data_nota_tmp
				
				//check procedure call uper SP 
				//echo "check procedure call uper SP : ".$out_status;
				//die();
				
				if ($out_status=="S"){
			
					$parameters_bayar_uper=array( 
						array('name'=>':IN_KD_PPKB','value'=>$objectData->{'KD_PPKB'},'length'=>100,'type'=>SQLT_CHR),
						array('name'=>':IN_PPKB_KE','value'=>$objectData->{'PPKB_KE'},'length'=>100,'type'=>SQLT_INT),				
						array('name'=>':IN_NM_BANK','value'=>'JBI MANDIRI 273822.098','length'=>100,'type'=>SQLT_CHR),	
						array('name'=>':IN_NO_TRANSAKSI','value'=>'23-02-2018-0001','length'=>100,'type'=>SQLT_CHR),	
						array('name'=>':IN_TGL_PEMBAYARAN','value'=>'23-FEB-18','length'=>100,'type'=>SQLT_CHR),	
						array('name'=>':IN_DITERIMA_OLEH','value'=>'PETUGAS JAMBI','length'=>100,'type'=>SQLT_CHR),	
						array('name'=>':IN_URAIAN','value'=>'UPER KAPAL','length'=>100,'type'=>SQLT_CHR),	
						array('name'=>':IN_BANK_ID','value'=>11290,'length'=>100,'type'=>SQLT_INT),	
						array('name'=>':IN_ORG_ID','value'=>89,'length'=>100,'type'=>SQLT_CHR),	
						array('name'=>':IN_KD_CABANG','value'=>$objectData->{'KD_CABANG'},'length'=>100,'type'=>SQLT_CHR),	
						array('name'=>':out_status','value'=>&$out_status,'length'=>100,'type'=>SQLT_CHR),
						array('name'=>':out_messages','value'=>&$out_messages,'length'=>1000,'type'=>SQLT_CHR)
					);
							
					//call package db yg lain
					$this->kapal_cabang_db->stored_procedure('KAPAL_CABANG.XEINVC_KAPAL_PKG','CREATE_BAYAR_UPER_KAPAL',$parameters_bayar_uper);	
				}
							
				
		if ($out_status=='S'){	
			//insert ke ITPK UPER KAPAL				
					
					$this->kapal_cabang_db->select('ORG_ID,NO_UPER,NO_PPKB,NO_PKK,
								NO_PPKB_KE,JENIS_MODUL,CURRENCY_CODE,CUSTOMER_NUMBER,JENIS_UPER,RECEIPT_DATE,BANK_ID');
					//$this->db->select("DATE_FORMAT( date, '%d.%m.%Y' ) as date_human",  FALSE );					
					$this->kapal_cabang_db->from('XEINVC_UPER_KAPAL_TMP');
					$this->kapal_cabang_db->where('NO_PPKB', ''.$objectData->{'KD_PPKB'}.'' );
					$this->kapal_cabang_db->where('NO_PPKB_KE', ''.$objectData->{'PPKB_KE'}.'' );
					$query = $this->kapal_cabang_db->get();
					if ( $query->num_rows() > 0 )
					{
						$row = $query->row_array();							
						$parameters_itpk_uper_kapal=array( 
								array('name'=>':IN_ORG_ID','value'=>$row['ORG_ID'],'length'=>100,'type'=>SQLT_INT),
								array('name'=>':IN_NO_UPER','value'=>$row['NO_UPER'],'length'=>100,'type'=>SQLT_CHR),				
								array('name'=>':IN_PPKB','value'=>$row['NO_PPKB'],'length'=>100,'type'=>SQLT_CHR),	
								array('name'=>':IN_PPKB_KE','value'=>$row['NO_PPKB_KE'],'length'=>100,'type'=>SQLT_INT),	
								array('name'=>':IN_CUSTOMER_NUMBER','value'=>$row['CUSTOMER_NUMBER'],'length'=>100,'type'=>SQLT_CHR),	
								array('name'=>':IN_JENIS_MODUL','value'=>$row['JENIS_MODUL'],'length'=>100,'type'=>SQLT_CHR),
								array('name'=>':IN_JENIS_UPER','value'=>$row['JENIS_UPER'],'length'=>100,'type'=>SQLT_CHR),
								array('name'=>':IN_CURRENCY_CODE','value'=>$row['CURRENCY_CODE'],'length'=>100,'type'=>SQLT_CHR),	
								array('name'=>':IN_AMOUNT','value'=>$amount_update_uper,'length'=>100,'type'=>SQLT_INT),	
								array('name'=>':IN_RECEIPT_DATE','value'=>$row['RECEIPT_DATE'],'length'=>100,'type'=>SQLT_CHR),	
								array('name'=>':IN_BANK_ID','value'=>$row['BANK_ID'],'length'=>100,'type'=>SQLT_INT),	
								array('name'=>':IN_STATUS','value'=>1,'length'=>100,'type'=>SQLT_INT),	
								array('name'=>':IN_URAIAN','value'=>'UPER KAPAL','length'=>100,'type'=>SQLT_CHR),	
								array('name'=>':IN_ERROR_MSG','value'=>'TES','length'=>100,'type'=>SQLT_CHR),						
								array('name'=>':out_status','value'=>&$out_status,'length'=>100,'type'=>SQLT_CHR),
								array('name'=>':out_messages','value'=>&$out_messages,'length'=>1000,'type'=>SQLT_CHR)
							);	
						
						
					//call package db yg lain
					$this->kapal_cabang_db->stored_procedure('KAPAL_CABANG.XEINVC_KAPAL_PKG','CREATE_ITPK_UPER_KAPAL',$parameters_itpk_uper_kapal);	
					
					
					if($out_status=='S'){
										
					$service_url = base_url().'SimopReceiptHeader/';
					$curl = curl_init($service_url);
					 
					$curl_post_data = array(
					'IN_SOURCE_INVOICE'=>'KPL_UPER',
					'ORG_ID'=>$row['ORG_ID'],
					'RECEIPT_NUMBER'=>$row['NO_UPER'],
					'RECEIPT_METHOD'=>'JBI BANK',
					'RECEIPT_ACCOUNT'=>'JAMBI BNI IDR 00.698.76002',///$bank_receipt_account,
					'BANK_ID'=>$row['BANK_ID'],///$rs_uper['BANK_ID'],
					'CUSTOMER_NUMBER'=>$row['CUSTOMER_NUMBER'],
					'RECEIPT_DATE'=>$row['RECEIPT_DATE'],
					'CURRENCY_CODE'=>$row['CURRENCY_CODE'],
					'STATUS'=>'P',
					'AMOUNT'=>$amount_update_uper,
					'ATTRIBUTE_CATEGORY'=>'UPER',
					'ATTRIBUTE1'=>$row['NO_UPER'],
					'ATTRIBUTE2'=>'',
					'ATTRIBUTE3'=>'',
					'ATTRIBUTE4'=>'',
					'ATTRIBUTE5'=>'',
					'ATTRIBUTE6'=>'23-FEB-18',//INVOICE DATE
					'ATTRIBUTE7'=>'',// UPER CURRENCY ; UPER AMOUNT
					'ATTRIBUTE8'=>'marthin',//NAMA KAPAL
					'ATTRIBUTE9'=>'30-JAN-18 S/D 30-JAN-18',//PERIODE KUNJUNGAN 
					'ATTRIBUTE10'=>$row['NO_PKK'],//NO UKK
					'ATTRIBUTE11'=>$row['NO_PPKB'], //NO PPKB
					'ATTRIBUTE12'=>$row['NO_PPKB_KE'], // PPKB KE 
					'ATTRIBUTE13'=>'ID-001',
					'ATTRIBUTE14'=>'KPL01',
					'ATTRIBUTE15'=>''
						);
						
					curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($curl, CURLOPT_POST, true);
					curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data);
					$curl_response = curl_exec($curl);
					echo "curl response ". $curl_response;
					//die();
					curl_close($curl);	
					//echo "no uper : ".$rs_uper['NO_UPER'];
					//die();
					/**
					INI HARUS DIUBAH !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
					*/
					$insert_konsolidasi_uper='S';
							
						//23 FEB 2018 start gagat modify run concurrent UPER di simkeu
						//run web service untuk menjalankan concurrent uper ke simkeu	
					 
						$service_url_uper = base_url().'RunConcUperKapalSimkeu/';
						$curl_uper = curl_init($service_url_uper);
					
						$curl_post_uper = array(				
							'IN_ORG_ID'=>$row['ORG_ID'],
							'IN_SOURCE'=>'KPL_UPER',
							'IN_RECEIPT_NUMBER'=>$objectData->{'KD_PPKB'}.'-'.$objectData->{'PPKB_KE'}
						);
						//echo $curl_post_uper;	
						curl_setopt($curl_uper, CURLOPT_RETURNTRANSFER, true);
						curl_setopt($curl_uper, CURLOPT_POST, true);
						curl_setopt($curl_uper, CURLOPT_POSTFIELDS, $curl_post_uper);
						$curl_response = curl_exec($curl_uper);
						curl_close($curl_uper);	
						//end modify run concurrent UPER disimkeu 
					
					};
					};
			
		}
		die();
	    /*
		memanggil web service SimopInvoiceHeader dan SimopInvoiceDetail
		*/		
			if ($out_status=='S'){								
				
				
				
				
								
				
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
		$this->kapal_cabang_db->close();
		
    }
}