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

class CreateInvoiceBarang extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }

  	function index_get() {
        $id = $this->uri->segment(2);
        $id2 = $this->uri->segment(3);

        $this->load->model('Simop_createInvoiceBarang_model');
        if ($id == '') {
                $result= $this->Simop_createInvoiceBarang_model->get_all();
        } else {
            if($id=='page' && $id2!==''){
                $total_posts = $this->Simop_createInvoiceBarang_model->count_rows(); // retrieve the total number of posts
                $result = $this->Simop_createInvoiceBarang_model->paginate(10,$total_posts);
            } else {           
                if($id!=='' && $id2==''){
                    $result= $this->Simop_createInvoiceBarang_model->get(array('TRX_NUMBER'=>$id));  
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
		$this->kapal_prod_db = $this->load->database('invoice_kapal_prod',true);
		$this->barang_prod_db = $this->load->database('invoice_barang_prod',true);
		$this->barang_cabang_db = $this->load->database('invoice_barang_cabang',true);
		//---------------------------------------		 
		
        if($this->form_validation->run('simop_barang_create_invoice_post') != false){
            $this->load->model('simop_createInvoiceBarang_model');
            $data = $this->post();				

            $safe_data = $this->simop_createInvoiceBarang_model->get(array(
			'TRX_NUMBER'=>$this->post('TRX_NUMBER'),
			'ORG_ID'=>$this->post('ORG_ID'),			
			'JENIS_NOTA'=>$this->post('JENIS_NOTA')		
			));
			
			$this->invoice_consolidasi_db->select('KODE_UNIT');
			//$this->db->select("DATE_FORMAT( date, '%d.%m.%Y' ) as date_human",  FALSE );					
			$this->invoice_consolidasi_db->from('XEINVC_MST_CABANG');
			$this->invoice_consolidasi_db->where('ORG_ID', ''.$this->post('ORG_ID').'' );
			$query = $this->invoice_consolidasi_db->get();
			if ( $query->num_rows() > 0 )
				{
					$row = $query->row_array();	
					$kode_cabang_3digit= $row['KODE_UNIT'];						
				
			}
			$this->kapal_prod_db->select('KD_CABANG');
			//$this->db->select("DATE_FORMAT( date, '%d.%m.%Y' ) as date_human",  FALSE );					
			$this->kapal_prod_db->from('KAPAL_PROD.MST_CABANG');
			$this->kapal_prod_db->where('NM_CABANG_3DIGIT', ''.$kode_cabang_3digit.'' );
			$query = $this->kapal_prod_db->get();
			if ( $query->num_rows() > 0 )
				{
					$row = $query->row_array();	
					$kode_cabang= $row['KD_CABANG'];						
				
				}
			
							
			$modul_name='BARANG';	
			$tgl_kegiatan=date('d-M-y');
            //echo $tgl_kegiatan;
           // die();			
			$this->kapal_prod_db->select("KAPAL_PROD.ALL_GENERAL_PKG.GET_SUBSIDIARY_BRANCH_ACCOUNT ('BARANG','".$kode_cabang."',sysdate) AS BRANCH_ACCOUNT ");
			$this->kapal_prod_db->from("DUAL");
			$this->kapal_prod_db->where("1=1");
			$query = $this->kapal_prod_db->get();
			if ( $query->num_rows() > 0 )
				{
					$row = $query->row_array();	
					$branch_account= $row['BRANCH_ACCOUNT'];						
				
				}
			
			$parameters=array( 
				array('name'=>':TRX_NUMBER','value'=>$this->post('TRX_NUMBER'),'length'=>100,'type'=>SQLT_CHR),
				//array('name'=>':ORG_ID','value'=>$this->post('ORG_ID'),'length'=>100,'type'=>SQLT_INT),
				array('name'=>':ORG_ID','value'=>$branch_account,'length'=>100,'type'=>SQLT_INT),	
				array('name'=>':JENIS_NOTA','value'=>$this->post('JENIS_NOTA'),'length'=>100,'type'=>SQLT_CHR),				
				array('name'=>':out_status','value'=>&$out_status,'length'=>100,'type'=>SQLT_CHR),
				array('name'=>':out_messages','value'=>&$out_messages,'length'=>1000,'type'=>SQLT_CHR)
			);
			
			//print_r($parameters);
			
				
				
		//call package db yg lain
		$this->barang_cabang_db->stored_procedure('BARANG_CABANG.XEINVC_BARANG_PKG','CREATE_INVOICE_BARANG',$parameters);
			
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
				
				//start calculate amount total table lines
				$this->barang_prod_db->select('SUM(AMOUNT) AMOUNT_TOTAL');
				$this->barang_prod_db->from('IPCTPK_NOTA_DETAIL');
				$this->barang_prod_db->where('TRX_NUMBER=', ''.$this->post('TRX_NUMBER').'' );
				$query = $this->barang_prod_db->get();
				$row_amount = $query->row_array();	
				
				//end calculate amount total table lines 
				
				$get_trx_number= $this->post('TRX_NUMBER');
				
				$url = base_url().'CreateInvoiceBarang/'.$get_trx_number.'/';
				//echo $url;
				//die();	
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
				$service_url = base_url().'SimopInvoiceHeader/';
				$curl = curl_init($service_url);
				$curl_post_data = array(
					"SOURCE_INVOICE"=>$objectData->{'JENIS_MODUL'},
					"BILLER_REQUEST_ID" => $objectData->{'TRX_NUMBER'},
					"TRX_NUMBER" => $objectData->{'TRX_NUMBER'},
					"ORG_ID" => $objectData->{'ORG_ID'},
					"CUSTOMER_NUMBER"=> $objectData->{'CUSTOMER_NUMBER'},
					"CUSTOMER_NAME"=>$objectData->{'SIMOP_CUSTOMER_NAME'},
					"TRX_DATE"=>$objectData->{'TRX_DATE'},
					"TRX_CLASS"=>'INV',
					"CURRENCY_CODE"=>$objectData->{'CURRENCY_CODE'},
					"AMOUNT"=>$row_amount['AMOUNT_TOTAL'],
					'STATUS'=>'P',
					'HEADER_CONTEXT'=> $objectData->{'JENIS_MODUL'},
					'HEADER_SUB_CONTEXT'=> $objectData->{'JENIS_NOTA'},
					'TERMINAL'=>'-',
					'ATTRIBUTE1'=>$objectData->{'JENIS_NOTA'},//jenis nota
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
					'ATTRIBUTE14'=>$objectData->{'NO_FAKTUR'},//no faktur
					'ATTRIBUTE15'=>'',//$objectData->{'ATTRIBUTE15'}
					'INTERFACE_HEADER_ATTRIBUTE1'=>'',
					'INTERFACE_HEADER_ATTRIBUTE2'=>$objectData->{'NAMA_KAPAL'},//nama kapal
					'INTERFACE_HEADER_ATTRIBUTE3'=>'',
					'INTERFACE_HEADER_ATTRIBUTE4'=>'',
					'INTERFACE_HEADER_ATTRIBUTE5'=>$objectData->{'KADE'},//kade dermaga
					'INTERFACE_HEADER_ATTRIBUTE6'=>'',
					'INTERFACE_HEADER_ATTRIBUTE7'=>$objectData->{'BL_NO'},//no BL
					'INTERFACE_HEADER_ATTRIBUTE8'=>$objectData->{'NO_DO'},//no DO
					'INTERFACE_HEADER_ATTRIBUTE9'=>'',
					'INTERFACE_HEADER_ATTRIBUTE10'=>'',
					'INTERFACE_HEADER_ATTRIBUTE11'=>'',
					'INTERFACE_HEADER_ATTRIBUTE12'=>'',
					'INTERFACE_HEADER_ATTRIBUTE13'=>'',
					'INTERFACE_HEADER_ATTRIBUTE14'=>'',
					'INTERFACE_HEADER_ATTRIBUTE15'=>''
					
					);
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($curl, CURLOPT_POST, true);
				curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data);
				$curl_response = curl_exec($curl);				
				$get_status_header=json_decode($curl_response);
								
				curl_close($curl);
				
				if($get_status_header->{'status'}=='S'){			
					
					//2. START INSER DETAIL 
				    //-------------------------------
					/*$this->barang_prod_db->select('TRX_NUMBER');
					$this->barang_prod_db->from('BARANG_PROD.XEINVC_NOTA_BARANG_DETAIL_V');
					$this->barang_prod_db->where('TRX_NUMBER', ''.$objectData->{'TRX_NUMBER'}.'' );
					$query = $this->barang_prod_db->get();
					if ( $query->num_rows() > 0 )
						{
							$row_detail = $query->row_array();	
							foreach ($row_detail as $objectDetail){
								echo "detail data ".$objectDetail['LINE_NUMBER']." ".$objectDetail['TRX_NUMBER'];
							}							
						
						}
						
					die();*/
					//-------------------------------	
					$url = base_url().'GetInvoiceBarangDetail/'.$objectData->{'TRX_NUMBER'}.'/';
					
					$data = array(
						"TRX_NUMBER" => "'".$objectData->{'TRX_NUMBER'}."'"
					);
					$query_url = sprintf("%s?%s", $url, http_build_query($data));
					
					$postdata=file_get_contents($query_url);									
					$dataDetail = (array) json_decode($postdata,true);
					
					foreach ($dataDetail as $objectDetail){
						
						$service_url = base_url().'SimopInvoiceDetail/';
						$curl = curl_init($service_url);
						$curl_post_data = array(
							"BILLER_REQUEST_ID" => $objectDetail['TRX_NUMBER'],
							"TRX_NUMBER" => $objectDetail['TRX_NUMBER'],
							"LINE_NUMBER" => $objectDetail['LINE_NUMBER'],
							"TAX_FLAG"=> $objectDetail['TAX_FLAG'],
							"SERVICE_TYPE"=>$objectDetail['TIPE_LAYANAN'],
							"AMOUNT"=>$objectDetail['AMOUNT'],
							"CREATION_DATE"=>$objectData->{'TRX_DATE'},
							"LAST_UPDATED_DATE"=>$objectData->{'TRX_DATE'}
							);
						curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
						curl_setopt($curl, CURLOPT_POST, true);
						curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data);
						$curl_response = curl_exec($curl);	
						$get_status_detail=json_decode($curl_response);
						curl_close($curl);
						//echo $get_status_detail->{'status'};
						//echo $get_status_detail->{'message'};
													
					}
					//die();
					
					
				}elseif(($get_status_header->{'status'}=='F')){
					echo $get_status_header->{'status'}.' err message '.$get_status_header->{'message'};
					die();
					
				}
				
				//update status transaksi simop barang
				$parameters=array( 
				array('name'=>':TRX_NUMBER','value'=>$this->post('TRX_NUMBER'),'length'=>100,'type'=>SQLT_CHR),
				array('name'=>':ORG_ID','value'=>$this->post('ORG_ID'),'length'=>100,'type'=>SQLT_INT),				
				array('name'=>':JENIS_NOTA','value'=>$this->post('JENIS_NOTA'),'length'=>100,'type'=>SQLT_CHR),				
				array('name'=>':out_status','value'=>&$out_status,'length'=>100,'type'=>SQLT_CHR),
				array('name'=>':out_messages','value'=>&$out_messages,'length'=>1000,'type'=>SQLT_CHR)
				);			
										
				//call package db yg lain
				$this->barang_cabang_db->stored_procedure('BARANG_CABANG.XEINVC_BARANG_PKG','UPDATE_INVOICE_BARANG',$parameters);
				echo $out_status."<br>";
				echo $out_messages;
				
			}			
			
        } else {
            $this->response( array('status'=>'failure', 
            'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_BAD_REQUEST);
        }
		
		//close db yg lain
		
		$this->invoice_consolidasi_db->close();
		$this->kapal_prod_db->close();
		$this->barang_prod_db->close();
		$this->barang_cabang_db->close();
		
    }
}