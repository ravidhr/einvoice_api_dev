<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class IntegrasiSimopUperHeader extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }

    function index_get() {
        $id = $this->uri->segment(2);
        $id2 = $this->uri->segment(3);

        $this->load->model('simop_header_model');
        if ($id == '') {
                $result= $this->simop_header_model->get_all();
        } else {
            if($id=='page' && $id2!==''){
                $total_posts = $this->simop_uper_header_model->count_rows(); // retrieve the total number of posts
                $result = $this->simop_uper_header_model->paginate(10,$total_posts);
            } else {           
                if($id!=='' && $id2==''){
                    $result= $this->simop_uper_header_model->get(array('ID_NUM'=>$id));  
                }
            }
        }        
        $this->response($result, 200);
    }
    function index_put() {
        $this->load->library('form_validation');
        $this->form_validation->set_data($this->put());
			
        if($this->form_validation->run('simop_uper_header_put') != false){
			
            $this->load->model('simop_uper_header_model');
            $exist = $this->simop_uper_header_model->get(array('ID_NUM'=> $this->put('ID_NUM')));
            //print_r("APAKAH ADA DITES DULU EXISTS : ".$exist);
            //die;
            if(($exist==null)){                
                $data = $this->put();
                $data_id = $this->simop_uper_header_model->insert($data); 
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
								
        
        if($this->form_validation->run('simop_uper_header_post') != false){
            $this->load->model('simop_uper_header_model');
            $data = $this->post();				

            $safe_data = $this->simop_uper_header_model->get(array(
			'IN_SOURCE_INVOICE'=>$this->post('IN_SOURCE_INVOICE'),
			'ORG_ID'=>$this->post('ORG_ID'),
			'RECEIPT_NUMBER'=>$this->post('RECEIPT_NUMBER'),
			'RECEIPT_METHOD'=>$this->post('RECEIPT_METHOD'),
			'RECEIPT_ACCOUNT'=>$this->post('RECEIPT_ACCOUNT'),
			'BANK_ID'=>$this->post('BANK_ID'),
			'CUSTOMER_NUMBER'=>$this->post('CUSTOMER_NUMBER'),
			'RECEIPT_DATE'=>$this->post('RECEIPT_DATE'),
			'CURRENCY_CODE'=>$this->post('CURRENCY_CODE'),
			'STATUS'=>$this->post('STATUS'),
			'AMOUNT'=>$this->post('AMOUNT'),
			'ATTRIBUTE_CATEGORY'=>$this->post('ATTRIBUTE_CATEGORY'),
			'ATTRIBUTE1'=>$this->post('ATTRIBUTE1'),
			'ATTRIBUTE2'=>$this->post('ATTRIBUTE2'),
			'ATTRIBUTE3'=>$this->post('ATTRIBUTE3'),
			'ATTRIBUTE4'=>$this->post('ATTRIBUTE4'),
			'ATTRIBUTE5'=>$this->post('ATTRIBUTE5'),
			'ATTRIBUTE6'=>$this->post('ATTRIBUTE6'),
			'ATTRIBUTE7'=>$this->post('ATTRIBUTE7'),
			'ATTRIBUTE8'=>$this->post('ATTRIBUTE8'),
			'ATTRIBUTE9'=>$this->post('ATTRIBUTE9'),
			'ATTRIBUTE10'=>$this->post('ATTRIBUTE10'),
			'ATTRIBUTE11'=>$this->post('ATTRIBUTE11'),
			'ATTRIBUTE12'=>$this->post('ATTRIBUTE12'),
			'ATTRIBUTE13'=>$this->post('ATTRIBUTE13'),
			'ATTRIBUTE14'=>$this->post('ATTRIBUTE14'),
			'ATTRIBUTE15'=>$this->post('ATTRIBUTE15')
			));
			
            if(!isset($safe_data)){
                $this->response( array('status'=>'failure', 
                'message'=>'the specified no data to update',REST_Controller::HTTP_CONFLICT));
            }

            $data_id = $this->simop_uper_header_model->insert($data,array(
			'ORG_ID'=>$data['ORG_ID'],
			'RECEIPT_NUMBER'=>$data['RECEIPT_NUMBER'],
			'RECEIPT_ACCOUNT'=>$data['RECEIPT_ACCOUNT'],
			'CUSTOMER_NUMBER'=>$data['CUSTOMER_NUMBER'],
			'RECEIPT_DATE'=>$data['RECEIPT_DATE'],
			'CURRENCY_CODE'=>$data['CURRENCY_CODE'],
			'STATUS'=>$data['STATUS'],
			'AMOUNT'=>$data['AMOUNT'],
			'ATTRIBUTE_CATEGORY'=>$data['ATTRIBUTE_CATEGORY']
			));            
            			
			if (!$data_id){
                $this->response( array('status'=>'failure', 
                'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            } else {
				
                $this->response(array('status'=>'success','message'=>'updated'));
            }
        } else {
            $this->response( array('status'=>'failure', 
            'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    function index_delete() {
        $id = $this->uri->segment(2);
        $this->load->model('nota_header_model');
        $data = $this->nota_header_model->get(array('RECEIPT_NUMBER'=>$this->delete('RECEIPT_NUMBER')));
        if (isset($data)){
			
            $deleted = $this->nota_header_model->force_delete(array('RECEIPT_NUMBER'=>$this->delete('RECEIPT_NUMBER')));
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