<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Ematerai extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }

    function index_get() {
        // $id='';
        $id = $this->uri->segment(2);
        $id2 = $this->uri->segment(3);

        $this->load->model('ematerai_model');   
        if ($id=='') {
                $result= $this->ematerai_model->get_all();
        } else {
            if($id=='page' && $id2!==''){
                $total_posts = $this->ematerai_model->count_rows(); // retrieve the total number of posts
                $result = $this->ematerai_model->paginate(10,$total_posts);
            } else {           
                if($id!=='' && $id2==''){
                    $result= $this->ematerai_model->get(array('INV_EMATERAI_ID'=>$id));     
                }
            }
        }        
        $this->response($result, 200);
    }
    function index_put() {
        $this->load->library('form_validation');
        $this->form_validation->set_data($this->put());
        
        if($this->form_validation->run('ematerai_put') != false){
            $this->load->model('ematerai_model');
            $exist = $this->ematerai_model->get(array('INV_EMATERAI_ID'=> $this->put('INV_EMATERAI_ID')));
            // print_r($exist);
            // die;
            if(($exist==null)){                
                $data = $this->put();
                $data_id = $this->ematerai_model->insert($data); 
                if ($data_id){
                    $this->response(array('status'=>'success','message'=>'Created'));
                } else {
                    $this->response( array('status'=>'failure', 
                    'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
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
        
        if($this->form_validation->run('ematerai_post') != false){
            $this->load->model('ematerai_model');
            $data = $this->post();

            $safe_data = $this->ematerai_model->get(array('INV_EMATERAI_ID'=>$this->post('INV_EMATERAI_ID')));
            if(!isset($safe_data)){
                $this->response( array('status'=>'failure', 
                'message'=>'the specified no data to update',REST_Controller::HTTP_CONFLICT));
            }

            $data_id = $this->ematerai_model->update( $data,array('INV_EMATERAI_ID'=>$this->post('INV_EMATERAI_ID')));            
            if (!$data_id){
                $this->response(array('status'=>'success','message'=>'Created'));
            } else {
                $this->response( array('status'=>'failure', 
                'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            }
        } else {
            $this->response( array('status'=>'failure', 
            'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    function index_delete() {
        $id = $this->uri->segment(2);
        $this->load->model('ematerai_model');
        $data = $this->ematerai_model->get(array('INV_EMATERAI_ID'=>$this->delete('INV_EMATERAI_ID')));
        if (isset($data)){
            $deleted = $this->ematerai_model->force_delete(array('INV_EMATERAI_ID'=>$this->delete('INV_EMATERAI_ID')));
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