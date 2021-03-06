<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Nota extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }

    function index_get() {
        $id = $this->uri->segment(2);
        $id2 = $this->uri->segment(3);

        $this->load->model('nota_model');
        if ($id == '') {
                $result= $this->nota_model->get_all();
        } else {
            if($id=='page' && $id2!==''){
                $total_posts = $this->nota_model->count_rows(); // retrieve the total number of posts
                $result = $this->nota_model->paginate(10,$total_posts);
            } else {           
                if($id!=='' && $id2==''){
                    $result= $this->nota_model->get(array('INV_NOTA_ID'=>$id));  
                }
            }
        }        
        $this->response($result, 200);
    }
    function index_put() {
        $this->load->library('form_validation');
        $this->form_validation->set_data($this->put());
        
        if($this->form_validation->run('nota_put') != false){
			
			
            $this->load->model('nota_model');
            $exist = $this->nota_model->get(array('INV_NOTA_ID'=> $this->put('INV_NOTA_ID')));
            // print_r($exist);
            // die;
            if(($exist==null)){                
                $data = $this->put();
                $data_id = $this->nota_model->insert($data); 
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
            $this->response( array('status'=>'failure', 
            'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    function index_post() {
        $id = $this->uri->segment(2);
        $this->load->library('form_validation');
        $this->form_validation->set_data($this->put());
        
        if($this->form_validation->run('nota_post') != false){
            $this->load->model('nota_model');
            $data = $this->post();

            $safe_data = $this->nota_model->get(array('INV_NOTA_ID'=>$this->post('INV_NOTA_ID')));
            if(!isset($safe_data)){
                $this->response( array('status'=>'failure', 
                'message'=>'the specified no data to update',REST_Controller::HTTP_CONFLICT));
            }

            $data_id = $this->nota_model->update( $data,array('INV_NOTA_ID'=>$this->post('INV_NOTA_ID')));            
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
        $this->load->model('nota_model');
        $data = $this->nota_model->get(array('INV_NOTA_ID'=>$this->put('INV_NOTA_ID')));
        if (isset($data)){
            $deleted = $this->nota_model->force_delete(array('INV_NOTA_ID'=>$this->put('INV_NOTA_ID')));
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