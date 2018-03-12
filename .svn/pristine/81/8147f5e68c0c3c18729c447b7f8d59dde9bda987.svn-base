<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Telepon extends REST_Controller {

    function __construct($config = 'rest') {        
        parent::__construct($config);
    }

    function index_get() {
        //secure token
        // $this->load->model('mst_user_model');
        // $headers = $this->input->request_headers();
        // print_r($headers);die;
        // $this->mst_user_model->check_user($headers);
        //-----------------------

        $id = $this->uri->segment(2);
        $id2 = $this->uri->segment(3);
        // die($id);
        $this->load->model('telepon_model');
        //----
        if ($id == '') {
                $result= $this->telepon_model->get_all();
        } else {
            if($id=='page' && $id2!==''){
                $total_posts = $this->telepon_model->count_rows(); // retrieve the total number of posts
                $result = $this->telepon_model->paginate(10,$total_posts);
            } else {           
                if($id!=='' && $id2==''){
                    $result= $this->telepon_model->get(array('ID'=>$id));  
                }
            }
        }        
        $this->response($result, 200);
    }
    
    function index_put() {
        $this->load->library('form_validation');
        $this->form_validation->set_data($this->put());
        
        if($this->form_validation->run('user_put') != false){
            $this->load->model('user_model');
            $exist = $this->user_model->get_by(array('USERNAME'=> $this->put('USERNAME')));
            if($exist){
                $this->response( array('status'=>'failure', 
                'message'=>'the specified user already exists',REST_Controller::HTTP_CONFLICT));
                die;
            }
            $user = $this->put();
            $user_id = $this->user_model->insert($user);            
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
        
        if($this->form_validation->run('user_post') != false){
            $this->load->model('user_model');
            $user = $this->post();

            $safe_user = !isset($user['USERNAME']) || !$this->user_model->get_by(array('USERNAME'=> $user['USERNAME']));
            if(!$safe_user){
                $this->response( array('status'=>'failure', 
                'message'=>'the specified user already in used',REST_Controller::HTTP_CONFLICT));
                die;
            }
            $user_id = $this->user_model->update( $id, $user);            
            if (!$user_id){
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
        $this->load->model('user_model');
        $data = $this->user_model->get_by(array('USERNAME'=>$id));
        if (isset($data['USERNAME'])){
            $data['ENABLED'] = '0';
            $deleted = $this->user_model->update($id,$data);
            if (!$deleted){
                $this->response( array('status'=>'failure', 
                'message'=>'an expected error trying to update '),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            } else {
                $this->response(array('status'=>'success','message'=>'deleted'));
            }
        }
    }

}