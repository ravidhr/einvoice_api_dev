<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Integrasi extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }

    function index_get() {
        $id = $this->uri->segment(2);
        $id2 = $this->uri->segment(3);
        // die($id2);
        $this->load->model('integrasi_model');
        if ($id == '') {
                $data= $this->integrasi_model->get_all();
        } else {
            if($id=='search' && $id2==''){
                $total_posts = $this->integrasi_model->count_rows(); // retrieve the total number of posts
                $data = $this->integrasi_model->paginate(10,$total_posts);
            } else {           
                // $data1= $this->integrasi_model->get(array('NO_NOTA'=>$id2));                
                $data = $this->integrasi_model->process($id2);
            }
        }        
        $this->response($data, 200);
    }
        
    function index_put() {
        $this->load->library('form_validation');
        $this->form_validation->set_data($this->put());
        
        if($this->form_validation->run('entity_put') != false){
            $this->load->model('entity_model');
            $exist = $this->entity_model->get(array('INV_ENTITY_ID'=> $this->put('INV_ENTITY_ID')));
            if(!isset($exist)){
                $this->response( array('status'=>'failure', 
                'message'=>'the specified data already exists',REST_Controller::HTTP_CONFLICT));
                die;
            }
            $user = $this->put();
            $user_id = $this->entity_model->insert($user); 
            if ($user_id){
                $this->response( array('status'=>'failure', 
                'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            } else {
                $this->response(array('status'=>'success','message'=>'Created'));
            }
        } else {
            $this->response( array('status'=>'failure', 
            'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    function index_post() {
        $id = $this->uri->segment(2);
		
        $this->load->library('form_validation');
        $this->form_validation->set_data($this->put());
        
        if($this->form_validation->run('entity_post') != false){
            $this->load->model('entity_model');
            $data = $this->post();

            $safe_data = $this->entity_model->get(array('INV_ENTITY_ID'=>$this->post('INV_ENTITY_ID')));
            if(!isset($safe_data)){
                $this->response( array('status'=>'failure', 
                'message'=>'the specified no data to update',REST_Controller::HTTP_CONFLICT));
            }

            $data_id = $this->entity_model->update( $data,array('INV_ENTITY_ID'=>$this->post('INV_ENTITY_ID')));            
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
        $this->load->model('entity_model');
        $data = $this->entity_model->get(array('INV_ENTITY_ID'=>$this->put('INV_ENTITY_ID')));
        if (isset($data)){
            $deleted = $this->entity_model->force_delete(array('INV_ENTITY_ID'=>$this->put('INV_ENTITY_ID')));
            if (!$deleted){
                $this->response( array('status'=>'failure', 
                'message'=>'an expected error trying to delete '),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            } else {
                $this->response(array('status'=>'success','message'=>'deleted'));
            }
        } else {            
            $this->response( array('status'=>'failure', 
            'message'=>'the specified data already exists',REST_Controller::HTTP_CONFLICT));
        }
    }

}