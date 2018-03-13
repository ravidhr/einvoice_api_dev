<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Notah extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }

    function index_get() {
        $id = $this->uri->segment(2);
        $id2 = $this->uri->segment(3);

        $this->load->model('nota_header_model');
        if ($id == '') {
                $result= $this->nota_header_model->get_all();
        } else {
            if($id=='page' && $id2!==''){
                $total_posts = $this->nota_header_model->count_rows(); // retrieve the total number of posts
                $result = $this->nota_header_model->paginate(10,$total_posts);
            } else {           
                if($id!=='' && $id2==''){
                    $result= $this->nota_header_model->get(array('ID_NUM'=>$id));  
                }
            }
        }        
        $this->response($result, 200);
    }
    function index_put() {
        $this->load->library('form_validation');
        $this->form_validation->set_data($this->put());
			
        if($this->form_validation->run('notah_put') != false){
			
            $this->load->model('nota_header_model');
            $exist = $this->nota_header_model->get(array('ID_NUM'=> $this->put('ID_NUM')));
            //print_r("APAKAH ADA DITES DULU EXISTS : ".$exist);
            //die;
            if(($exist==null)){                
                $data = $this->put();
                $data_id = $this->nota_header_model->insert($data); 
                if ($data_id){
                    $this->response( array('status'=>'failure', 
                    'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
                } else {
                    $this->response(array('status'=>'success','message'=>'Created'));
                }
            } else {
                $this->response( array('status'=>'failure', 
                'message'=>'the specified data already exists',REST_Controller::HTTP_CONFLICT));
                die;
            }
        } else {
            $this->response( array('ELS status'=>'failure', 
            'ELS message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    function index_post() {
        $id = $this->uri->segment(2);
        $this->load->library('form_validation');
        $this->form_validation->set_data($this->put());
				
        
        if($this->form_validation->run('notah_post') != false){
            $this->load->model('nota_header_model');
            $data = $this->post();	

			/*echo "count data ". count($data);
			echo $data['ID_NUM']."<br>";
			echo $data['PRODUCT_NAME']."<br>";
			echo $data['PRICE']."<br>";
			die();*/	
		

            $safe_data = $this->nota_header_model->get(array(
			'BILLER_REQUEST_ID'=>$this->post('BILLER_REQUEST_ID'),
			'TRX_NUMBER'=>$this->post('TRX_NUMBER'),
			'ORG_ID'=>$this->post('ORG_ID'),
			'TRX_DATE'=>$this->post('TRX_DATE'),
			'TRX_CLASS'=>$this->post('TRX_CLASS'),
			'CURRENCY_CODE'=>$this->post('CURRENCY_CODE'),
			'CUSTOMER_NUMBER'=>$this->post('CUSTOMER_NUMBER'),
			'STATUS'=>$this->post('STATUS'),
			'HEADER_CONTEXT'=>$this->post('HEADER_CONTEXT')
			));
			
            if(!isset($safe_data)){
                $this->response( array('status'=>'failure', 
                'message'=>'the specified no data to update',REST_Controller::HTTP_CONFLICT));
            }

            $data_id = $this->nota_header_model->insert($data,array(
			'BILLER_REQUEST_ID'=>$_POST['BILLER_REQUEST_ID'],
			'TRX_NUMBER'=>$_POST['TRX_NUMBER'],
			'ORG_ID'=>$_POST['ORG_ID'],
			'TRX_DATE'=>'sysdate',//$_POST['TRX_DATE'],
			'TRX_CLASS'=>$_POST['TRX_CLASS'],
			'CURRENCY_CODE'=>$_POST['CURRENCY_CODE'],
			'CUSTOMER_NUMBER'=>$_POST['CUSTOMER_NUMBER'],
			'STATUS'=>$_POST['STATUS'],
			'HEADER_CONTEXT'=>$_POST['HEADER_CONTEXT']
			));            
            			
			if (!$data_id){
                $this->response( array('status'=>'failure', 
                'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            } else {
				
                $this->response(array('status'=>'success','message'=>'updated'));
            }
        } else {
            $this->response( array('ELS status'=>'failure', 
            'ELS message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    function index_delete() {
        $id = $this->uri->segment(2);
        $this->load->model('nota_header_model');
        $data = $this->nota_header_model->get(array('ID_NUM'=>$this->delete('ID_NUM')));
        if (isset($data)){
			
            $deleted = $this->nota_header_model->force_delete(array('ID_NUM'=>$this->delete('ID_NUM')));
            if (!$deleted){
                $this->response( array('status'=>'failure', 
                'message'=>'an expected error trying to delete '),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            } else {
                $this->response(array('status'=>'success','message'=>'deleted'));
            }
        } else {            
            $this->response( array('status'=>'failure', 
            'message'=>'no data found ',REST_Controller::HTTP_CONFLICT));
        }
    }

}