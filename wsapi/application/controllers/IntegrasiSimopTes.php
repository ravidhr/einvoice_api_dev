<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class IntegrasiSimopTes extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }

	function index_get() {
        $id = $this->uri->segment(2);
        $id2 = $this->uri->segment(3);

        $this->load->model('simop_header_tes_model');
        if ($id == '') {
                $result= $this->simop_header_tes_model->get_all();
        } else {
            if($id=='page' && $id2!==''){
                $total_posts = $this->simop_header_tes_model->count_rows(); // retrieve the total number of posts
                $result = $this->simop_header_tes_model->paginate(10,$total_posts);
            } else {           
                if($id!=='' && $id2==''){
                    $result= $this->simop_header_tes_model->get(array('TRX_NUMBER'=>$id));  
                }
            }
        }        
        $this->response($result, 200);
    }

    function index_post() {
		
		$id = $this->uri->segment(2);
	
        $this->load->library('form_validation');
        $this->form_validation->set_data($this->put());
		//---------------------------------------
		 
		

		//---------------------------------------	
        
        if($this->form_validation->run('simop_header_tes_post') != false){
            $this->load->model('simop_header_tes_model');
            $data = $this->post();				

            $safe_data = $this->simop_header_tes_model->get(array(
			'ORG_ID'=>$this->post('ORG_ID'),
			'RECEIPT_NUMBER'=>$this->post('RECEIPT_NUMBER'),
			'RECEIPT_METHOD'=>$this->post('RECEIPT_METHOD'),
			'RECEIPT_ACCOUNT'=>$this->post('RECEIPT_ACCOUNT')
			));
			
			$parameters=array( 
				array('name'=>':org_id','value'=>$this->post('ORG_ID'),'length'=>100,'type'=>SQLT_CHR),
				array('name'=>':receipt_number','value'=>$this->post('RECEIPT_NUMBER'),'length'=>100,'type'=>SQLT_CHR),
				array('name'=>':receipt_method','value'=>$this->post('RECEIPT_METHOD'),'length'=>100,'type'=>SQLT_CHR),
				array('name'=>':receipt_account','value'=>$this->post('RECEIPT_ACCOUNT'),'length'=>100,'type'=>SQLT_CHR),
				array('name'=>':out_status','value'=>&$out_status,'length'=>100,'type'=>SQLT_CHR)
			);
			
		//print_r($parameters);
        //die();		
		$this->db->stored_procedure('invoice.xeinvc_api_konsolidasi_pkg','insert_ar_receipt_console_tes',$parameters);
		
		echo $out_status;
		die();
			
			/*$parameters=array( 
				array('name'=>':org_id','value'=>'89','length'=>100,'type'=>SQLT_CHR),
				array('name'=>':receipt_number','value'=>'TES.RHN.2018.02.02.001','length'=>100,'type'=>SQLT_CHR),
				array('name'=>':receipt_method','value'=>'JBI BANK','length'=>100,'type'=>SQLT_CHR),
				array('name'=>':receipt_account','value'=>'IJBI MANDIRI 209.8329.32','length'=>100,'type'=>SQLT_CHR)
			);
			
						
			$this->db->stored_procedure('xeinvc_api_konsolidasi_pkg','insert_ar_receipt_console_tes',$parameters);
			*/
           /* if(!isset($safe_data)){
                $this->response( array('status'=>'failure', 
                'message'=>'the specified no data to update',REST_Controller::HTTP_CONFLICT));
            }		   
            			
			if (!$data_id){
                $this->response( array('status'=>'failure', 
                'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            } else {
				
                $this->response(array('status'=>'success','message'=>'updated'));
            }*/
        } else {
            $this->response( array('status'=>'failure', 
            'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_BAD_REQUEST);
        }
    }

 

}