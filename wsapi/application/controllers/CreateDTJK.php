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

class CreateDTJK extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }

  	function index_get() {
        $id = $this->uri->segment(2);
        $id2 = $this->uri->segment(3);

        $this->load->model('Simop_createDPJK_model');
        if ($id == '') {
                $result= $this->Simop_createDTJK_model->get_all();
        } else {
            if($id=='page' && $id2!==''){
                $total_posts = $this->Simop_createDTJK_model->count_rows(); // retrieve the total number of posts
                $result = $this->Simop_createDTJK_model->paginate(10,$total_posts);
            } else {           
                if($id!=='' && $id2==''){
                    $result= $this->Simop_createDTJK_model->get(array('NO_UKK'=>$id));  
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
		
        if($this->form_validation->run('simop_kapal_create_dtjk_post') != false){
            $this->load->model('Simop_createDTJK_model');
            $data = $this->post();				

            $safe_data = $this->Simop_createDTJK_model->get(array(
			'NO_UKK'=>$this->post('NO_UKK'),
			'FORM1A'=>$this->post('FORM1A')		
			));
			
			$parameters=array( 
				array('name'=>':P_NO_UKK','value'=>$this->post('NO_UKK'),'length'=>100,'type'=>SQLT_CHR),	
				array('name'=>':P_KD_PPKB','value'=>$this->post('FORM1A'),'length'=>100,'type'=>SQLT_CHR)
			);
			
			//print_r($parameters);
			//die();
						
		//call package db yg lain
		$this->kapal_cabang_db->stored_procedure('KAPAL_CABANG','REFILL_DTJK_DPJK',$parameters);
				
			
        } else {
            $this->response( array('status'=>'failure', 
            'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_BAD_REQUEST);
        }
		
		//close db yg lain
		$this->kapal_cabang_db->close();
		
    }
}