<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class reviewDKK extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }

	function index_get() {
        $id = $this->uri->segment(2);
        $id2 = $this->uri->segment(3);

        $this->load->model('simop_kapal_list_DKK_model');
        if ($id == '') {
                $result= $this->simop_kapal_list_DKK_model->get_all();
        } else {
            if($id=='page' && $id2!==''){
                $total_posts = $this->simop_kapal_list_DKK_model->count_rows(); // retrieve the total number of posts
                $result = $this->simop_kapal_list_DKK_model->paginate(10,$total_posts);
            } else {           
                if($id!=='' && $id2==''){
                    $result= $this->simop_kapal_list_DKK_model->get_all(array('NO_UKK'=>$id));  
                }
            }
        }        
        $this->response($result, 200);
    }

    function index_post() {
		
		$id = $this->uri->segment(2);
	
        $this->load->library('form_validation');
        $this->form_validation->set_data($this->put());
		//call db kapal prod	
        $this->kapal_prod_db = $this->load->database('invoice_kapal_prod',true);
		
        if($this->form_validation->run('simop_kapal_list_dkk_post') != false){
            $this->load->model('simop_kapal_list_DKK_model');
            $data = $this->post();				
        
        if($this->form_validation->run('simop_kapal_list_dkk_post') != false){
            $this->load->model('simop_kapal_list_DKK_model');
            $data = $this->post();				

            $this->load->model('simop_kapal_list_DKK_model');
            $data = $this->post();				

            $safe_data = $this->simop_kapal_list_DKK_model->get(array(
			'KD_CABANG'=>$this->post('KD_CABANG')
			));
			
			$this->kapal_prod_db->select('KD_CABANG,NO_UKK,KD_KAPAL,NM_KAPAL,KD_AGEN,NM_AGEN,TGL_JAM_TIBA,TGL_JAM_BERANGKAT');	
			$this->kapal_prod_db->from('XEINVC_DKK_V');
			//$this->kapal_prod_db->where('KD_CABANG', ''.$this->post('KD_CABANG').'' );
			if ($this->post('KD_CABANG')!=''){
				$this->kapal_prod_db->where('KD_CABANG=', ''.$this->post('KD_CABANG').'' );
			}
			$query = $this->kapal_prod_db->get();							
			print json_encode($query->result());		
			
			
        } else {
            $this->response( array('status'=>'failure', 
            'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_BAD_REQUEST);
        }
		$this->kapal_prod_db->close();	
    }

	

	}
}