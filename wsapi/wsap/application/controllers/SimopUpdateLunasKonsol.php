<?php
/***
Nama Controller 	: SimopUpdateLunasKonsol.php
Ditulis oleh 		: Gagat Rahina
Tanggal Penulisan 	: 20 Februari 2018 
no hp 				: +628156237689
email 				: gagat.rahina@sigma.co.id


**/


defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class SimopUpdateLunasKonsol extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }

  	function index_get() {
        $id = $this->uri->segment(2);
        $id2 = $this->uri->segment(3);
		//$id='Y';
		//echo "id2 ".$id;
		//die();

        $this->load->model('simop_update_lunas_konsolidasi_model');
        if ($id == '') {
                $result= $this->simop_update_lunas_konsolidasi_model->get_all();
        } else {
            if($id=='page' && $id2!==''){
                $total_posts = $this->simop_update_lunas_konsolidasi_model->count_rows(); // retrieve the total number of posts
                $result = $this->simop_update_lunas_konsolidasi_model->paginate(10,$total_posts);
            } else {           
                if($id=='Y'){
                    $result= $this->simop_update_lunas_konsolidasi_model->get_all(array('STATUS_LUNAS'=>'Y'));  
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
		$this->konsolidasi_db = $this->load->database('invoice_consolidasi',true);
		$this->rupa_db = $this->load->database('invoice_rupa2_prod',true);
		//---------------------------------------		 
		
        if($this->form_validation->run('simop_update_lunas_konsolidasi_post') != false){
            $this->load->model('simop_update_lunas_konsolidasi_model');
            $data = $this->post();	
			$get_status_lunas='LUNAS';
			//echo $this->post('STATUS_LUNAS');
			//die();
			$url = base_url().'SimopUpdateLunasKonsol/Y/';
			//echo $url;
			//die();
						
				$data = array(
					"STATUS_LUNAS" => "'".$this->post('STATUS_LUNAS')."'"
				);
				$query_url = sprintf("%s?%s", $url, http_build_query($data));
				// remark sementara header('Content-type: application/json');
				$postdata=file_get_contents($query_url);
								
				$dataDetail = (array) json_decode($postdata,true);
				//echo $postdata;
				//die();	
				foreach ($dataDetail as $objectDetail){	
						//menampilkan data invoice 
						echo $objectDetail['TRX_NUMBER'].'status lunas '.$objectDetail['STATUS_LUNAS'].'TGL PELUNASAN '.$objectDetail['TGL_PELUNASAN']."<br>";
					$parameters=array( 
				array('name'=>':IN_TRX_NUMBER','value'=>$objectDetail['TRX_NUMBER'],'length'=>100,'type'=>SQLT_CHR),
				array('name'=>':IN_STATUS_LUNAS','value'=>$objectDetail['STATUS_LUNAS'],'length'=>100,'type'=>SQLT_CHR),				
				array('name'=>':IN_TGL_PELUNASAN','value'=>$objectDetail['TGL_PELUNASAN'],'length'=>100,'type'=>SQLT_CHR),				
				array('name'=>':out_status','value'=>&$out_status,'length'=>100,'type'=>SQLT_CHR),
				array('name'=>':out_messages','value'=>&$out_messages,'length'=>1000,'type'=>SQLT_CHR)
			);	
		
		//call package db yg lain
		$this->rupa_db->stored_procedure('RUPA2_PROD.XEINVC_RUPA_PKG','UPDATE_LUNAS_KONSOLIDASI',$parameters);
		echo "status ".$out_status;
        		
					//-------------------------------------------
							
					//-------------------------------------------
				}
			
			

            /*$safe_data = $this->simop_update_lunas_konsolidasi_model->get(array(
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
			);*/
			
			
			
			
		
		
		//call package db yg lain
		//this->rupa_db->stored_procedure('RUPA2_PROD.XEINVC_RUPA_PKG','CREATE_INVOICE_RUPA',$parameters);
			
	    /*
		memanggil web service SimopInvoiceHeader dan SimopInvoiceDetail
		*/
						
			
        } else {
            $this->response( array('status'=>'failure', 
            'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_BAD_REQUEST);
        }
		
		//close db yg lain
		$this->konsolidasi_db->close();
		$this->rupa_db->close();
		
    }
}