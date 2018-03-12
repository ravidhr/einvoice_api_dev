<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Entity extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }

    function index_get() {
        $id = $this->uri->segment(2);
        $id2 = $this->uri->segment(3);

        $this->load->model('entity_model');
        if ($id == '') {
                $result= $this->entity_model->get_all();
        } else {
            if($id=='page' && $id2!==''){
                $total_posts = $this->entity_model->count_rows(); // retrieve the total number of posts
                $result = $this->entity_model->paginate(10,$total_posts);
            } else {           
                if($id!=='' && $id2==''){
                    $result= $this->entity_model->get(array('INV_ENTITY_ID'=>$id));  
                }
            }
        }        
        $this->response($result, 200);
    }
    function index_put() {
        $this->load->library('form_validation');
        $this->form_validation->set_data($this->put());
        
        if($this->form_validation->run('entity_put') != false){
            $this->load->model('entity_model');
            $exist = $this->entity_model->get(array('INV_ENTITY_ID'=> $this->put('INV_ENTITY_ID')));
            // print_r($exist);
            // die;
            if(($exist==null)){                
                $data = $this->put();
                $data_id = $this->entity_model->insert($data); 
                $lastId = 0;
                $lastId = $this->entity_model->getLastId($data); 
                if (!$data_id){
                    $this->response( array('status'=>'failure', 
                    'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
                } else {
                    $this->response(array(
                                            'status'=>'success',
                                            'message'=>'Created',
                                            'lastId' => $lastId
                                        ));
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
        $data = $this->entity_model->get(array('INV_ENTITY_ID'=>$this->delete('INV_ENTITY_ID')));
        if (isset($data)){
            $deleted = $this->entity_model->force_delete(array('INV_ENTITY_ID'=>$this->delete('INV_ENTITY_ID')));
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

    function search_post() {
        $postdata = ($_POST);
        // print_r($postdata);die;
        $this->load->model('entity_model');
        if (isset($postdata)) {
                $result= $this->entity_model->getData($postdata);
        } else {               
            $result= $this->entity_model->get_all();
        }      
        $this->response($result, 200);  
    }

}