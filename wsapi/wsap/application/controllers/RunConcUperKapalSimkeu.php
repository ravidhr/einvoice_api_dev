<?php
/***
Nama Controller 	: RunConcUperKapalSimkeu.php
Ditulis oleh 		: Gagat Rahina
Tanggal Penulisan 	: 08 Februari 2018 
no hp 				: +628156237689
email 				: gagat.rahina@sigma.co.id


**/


defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class RunConcUperKapalSimkeu extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }

  	function index_get() {
        $id = $this->uri->segment(2);
        $id2 = $this->uri->segment(3);

        $this->load->model('Ebs_run_uper_model');
        if ($id == '') {
                $result= $this->Ebs_run_uper_model->get_all();
        } else {
            if($id=='page' && $id2!==''){
                $total_posts = $this->Ebs_run_uper_model->count_rows(); // retrieve the total number of posts
                $result = $this->Ebs_run_uper_model->paginate(10,$total_posts);
            } else {           
                if($id!=='' && $id2==''){
                    $result= $this->Ebs_run_uper_model->get(array('RECEIPT_NUMBER'=>$id));  
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
		$this->simkeu_db = $this->load->database('ebs_simkeu_prod',true);
		//---------------------------------------		 
		
        if($this->form_validation->run('Ebs_run_uper_post') != false){
            $this->load->model('Ebs_run_uper_model');
            $data = $this->post();				

            $safe_data = $this->Ebs_run_uper_model->get(array(			
			'IN_ORG_ID'=>$this->post('IN_ORG_ID'),			
			'IN_SOURCE'=>$this->post('IN_SOURCE'),
			'IN_RECEIPT_NUMBER'=>$this->post('IN_RECEIPT_NUMBER')			
			));
			
			$parameters=array( 
				array('name'=>':out_errbuf','value'=>&$out_errbuf,'length'=>100,'type'=>SQLT_CHR),
				array('name'=>':out_retcode','value'=>&$out_retcode,'length'=>1000,'type'=>SQLT_INT),
				array('name'=>':IN_ORG_ID','value'=>$this->post('IN_ORG_ID'),'length'=>100,'type'=>SQLT_INT),				
				array('name'=>':IN_SOURCE','value'=>$this->post('IN_SOURCE'),'length'=>100,'type'=>SQLT_CHR),
                array('name'=>':IN_RECEIPT_NUMBER','value'=>$this->post('IN_RECEIPT_NUMBER'),'length'=>100,'type'=>SQLT_CHR)				
			);
			
			//print_r($parameters);
			//die();
			
		//call package db yg lain
		$this->simkeu_db->stored_procedure('APPS.XEINVC_AR_RECEIPT_PKG','GENERATE_UPER_BILLING',$parameters);
		
        //echo "out errbuf ".$out_errbuf;
        //echo "out retcode ".$out_retcode;
        //die();		
	   			
			
        } else {
            $this->response( array('status'=>'failure', 
            'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_BAD_REQUEST);
        }
		
		//close db yg lain
		$this->simkeu_db->close();
		
    }
}