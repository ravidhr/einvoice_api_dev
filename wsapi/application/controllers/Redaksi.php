<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Redaksi extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }

    function index_get() {
        $id = $this->uri->segment(2);
        $id2 = $this->uri->segment(3);
        // die('123');
        $this->load->model('redaksi_model');
        if ($id == '') {
                $result= $this->redaksi_model->get_all();
        } else {
            if($id=='page' && $id2!==''){
                $total_posts = $this->redaksi_model->count_rows(); // retrieve the total number of posts
                $result = $this->redaksi_model->paginate(10,$total_posts);
            } else {           
                if($id!=='' && $id2==''){
                    $result= $this->redaksi_model->get(array('INV_REDAKSI_ID'=>$id));  
                }
            }
        }        
        $this->response($result, 200);
    }
        
    function index_put() {
        $this->load->library('form_validation');
        $this->form_validation->set_data($this->put());
        
        if($this->form_validation->run('redaksi_put') != false){
            $this->load->model('redaksi_model');
            $exist = $this->redaksi_model->get(array('INV_NOTA_JENIS'=> $this->put('INV_NOTA_JENIS')));
            if(!isset($exist)){
                $this->response( array('status'=>'failure', 
                'message'=>'the specified data already exists',REST_Controller::HTTP_CONFLICT));
                die;
            }
            $user = $this->put();
            $user_id = $this->redaksi_model->insert($user); 
            if (!$user_id){
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

        if($this->form_validation->run('redaksi_post') != false){
            $this->load->model('redaksi_model');
            $data = $this->post();

            $safe_data = $this->redaksi_model->get(array('INV_REDAKSI_ID'=>$this->post('INV_REDAKSI_ID')));
            if(!isset($safe_data)){
                $this->response( array('status'=>'failure', 
                'message'=>'the specified no data to update',REST_Controller::HTTP_CONFLICT));
            }

            $data_id = $this->redaksi_model->update( $data,array('INV_REDAKSI_ID'=>$this->post('INV_REDAKSI_ID')));            
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
        $this->load->model('redaksi_model');
        $data = $this->redaksi_model->get(array('INV_PEJABAT_ID'=>$this->delete('INV_PEJABAT_ID')));
        if (isset($data)){
            $deleted = $this->redaksi_model->force_delete(array('INV_UNIT_ID'=>$this->delete('INV_UNIT_ID')));
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

    function search_post() {
        $postdata = ($_POST);
        // print_r($postdata);die;
        $this->load->model('redaksi_model');
        if (isset($postdata)) {
                $result= $this->redaksi_model->getData($postdata);
        } else {               
            $result= $this->redaksi_model->get_all();
        }      
        $this->response($result, 200);  
    }
    
}