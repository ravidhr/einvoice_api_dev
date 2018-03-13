<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Group extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    
    function index_get() {
        $id = $this->uri->segment(2);
        // die($id);
        $this->load->model('group_model');
        if ($id == '') {
                $group= $this->group_model->get_all();
                $this->response($group, 200);
                // $this->response(array('status'=>'success','message'=>$user));
        } else {
                $group= $this->group_model->get($id);
                if (isset($group['ID_GROUP'])) {
                    $this->response($group, 200);
                } else {
                    $this->response(array('status' => 'failure', 'message'=>'the spesify id could not be f0und',404));
                }
        }        
        $this->response($group, 200);
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
        $user = $this->user_model->get_by(array('USERNAME'=>$id));
        if (isset($user['USERNAME'])){
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