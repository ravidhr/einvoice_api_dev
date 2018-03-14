<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Userrole extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }

    function index_get() {
        $id = $this->uri->segment(2);
        $id2 = $this->uri->segment(3);
        // die('123');
        $this->load->model('userrole_model');
        if ($id == '') {
                $result= $this->userrole_model->get_all();
        } else {
            if($id=='page' && $id2!==''){
                $total_posts = $this->userrole_model->count_rows(); // retrieve the total number of posts
                $result = $this->userrole_model->paginate(10,$total_posts);
            } else {           
                if($id!=='' && $id2==''){
                    $result= $this->userrole_model->get(array('INV_USERROLE_ID'=>$id));  
                }
            }
        }        
        $this->response($result, 200);
    }
        
    function index_put() {
        $this->load->library('form_validation');
        $this->form_validation->set_data($this->put());
        
        if($this->form_validation->run('userrole_put') != false){
            $this->load->model('userrole_model');
            $exist = $this->userrole_model->get(array('INV_USER_ID'=> $this->put('INV_USER_ID')));
            if(!isset($exist)){
                $this->response( array('status'=>'failure', 
                'message'=>'the specified data already exists',REST_Controller::HTTP_CONFLICT));
                die;
            }
            $user = $this->put();
            $user_id = $this->userrole_model->insert($user); 
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

        if($this->form_validation->run('userrole_post') != false){
            $this->load->model('userrole_model');
            $data = $this->post();

            $safe_data = $this->userrole_model->get(array('INV_USERROLE_ID'=>$this->post('INV_USERROLE_ID')));
            if(!isset($safe_data)){
                $this->response( array('status'=>'failure', 
                'message'=>'the specified no data to update',REST_Controller::HTTP_CONFLICT));
            }

            $data_id = $this->userrole_model->update( $data,array('INV_USERROLE_ID'=>$this->post('INV_USERROLE_ID')));            
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
        $this->load->model('userrole_model');
        $data = $this->userrole_model->get(array('INV_USERROLE_ID'=>$this->delete('INV_USERROLE_ID')));
        if (isset($data)){
            $deleted = $this->userrole_model->force_delete(array('INV_USERROLE_ID'=>$this->delete('INV_USERROLE_ID')));
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
        $this->load->model('userrole_model');
        if (isset($postdata)) {
                $result= $this->userrole_model->getData($postdata);
        } else {               
            $result= $this->userrole_model->get_all();
        }      
        $this->response($result, 200);  
    }
    
}