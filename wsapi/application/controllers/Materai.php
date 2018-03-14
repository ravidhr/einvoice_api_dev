<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Materai extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }

    function index_get() {
        $id = $this->uri->segment(2);
        $id2 = $this->uri->segment(3);

        $this->load->model('materai_model');
        if ($id == '') {
                $result= $this->materai_model->get_all();
        } else {
            if($id=='page' && $id2!==''){
                $total_posts = $this->materai_model->count_rows(); // retrieve the total number of posts
                $result = $this->materai_model->paginate(10,$total_posts);
            } else {           
                if($id!=='' && $id2==''){
                    $result= $this->materai_model->get(array('INV_EMATERAI_ID'=>$id));  
                }
            }
        }        
        $this->response($result, 200);
    }
    function index_put() {
        $this->load->library('form_validation');
        $this->form_validation->set_data($this->put());
        
        // die('123');
        if($this->form_validation->run('materai_put') != false){
            $this->load->model('materai_model');
            $exist = $this->materai_model->get(array('INV_EMATERAI_ID'=> $this->put('INV_EMATERAI_ID')));
            // print_r($data); die;
            if(($exist==null)){         
                $data = $this->put();
                $data_id = $this->materai_model->insert($data); 
                if (!$data_id){
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
        $this->form_validation->set_data($this->post());
        
        if($this->form_validation->run('materai_post') != false){
            $this->load->model('materai_model');
            $data = $this->post();

            $safe_data = $this->materai_model->get(array('INV_EMATERAI_ID'=>$this->post('INV_EMATERAI_ID')));
            if(!isset($safe_data)){
                $this->response( array('status'=>'failure', 
                'message'=>'the specified no data to update',REST_Controller::HTTP_CONFLICT));
            }

            $data_id = $this->materai_model->update( $data,array('INV_EMATERAI_ID'=>$this->post('INV_EMATERAI_ID')));            
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
        $this->load->model('materai_model');
        $data = $this->materai_model->get(array('INV_EMATERAI_ID'=>$this->delete('INV_EMATERAI_ID')));
        if (isset($data)){
            $deleted = $this->materai_model->force_delete(array('INV_EMATERAI_ID'=>$this->delete('INV_EMATERAI_ID')));
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
        $this->load->model('materai_model');
        if (isset($postdata)) {
                $result= $this->materai_model->getData($postdata);
        } else {               
            $result= $this->materai_model->get_all();
        }      
        $this->response($result, 200);  
    }

}