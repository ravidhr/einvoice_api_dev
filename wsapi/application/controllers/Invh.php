<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Invh extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }

    function index_get() {
        $id = $this->uri->segment(2);
        $id2 = $this->uri->segment(3);

        $this->load->model('invheader_model');
        //----
        if ($id == '') {
                $result= $this->invheader_model->get_all();
        } else {
            if($id=='page' && $id2!==''){
                $total_posts = $this->invheader_model->count_rows(); // retrieve the total number of posts
                $result = $this->invheader_model->paginate(10,$total_posts);
            } else {           
                if($id!=='' && $id2==''){
                    $result= $this->invheader_model->get(array('TRX_NUMBER'=>$id));  
                }
            }
        }        
        $this->response($result, 200);
    }
    
    function search1_get() {
        $id = $this->uri->segment(3);
        // die($id);
        // $data = $this->get();
        $this->load->model('invheader_model');
        if ($isset(sdata)) {
                $result= $this->invheader_model->get(array('TRX_NUMBER'=>''));
        } else {               
                $this->response(array('status'=>'failure'), 404);
                // $total_posts = $this->invheader_model->count_rows(); // retrieve the total number of posts
                // $result = $this->invheader_model->paginate(10,$total_posts);
        }        
    }
    

    function index_put() {
        $this->load->library('form_validation');
        $this->form_validation->set_data($this->put());
        
        if($this->form_validation->run('all_put') != false){
            $this->load->model('invheader_model');
            $exist = $this->invheader_model->get_by(array('TRX_NUMBER'=> $this->put('TRX_NUMBER')));
            if($exist){
                $this->response( array('status'=>'failure', 
                'message'=>'the specified user already exists',REST_Controller::HTTP_CONFLICT));
                die;
            }
            $data = $this->put();
            $data_id = $this->invheader_model->insert($data);            
            if (!$data_id){
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
        
        if($this->form_validation->run('all_put') != true){
            $this->load->model('invheader_model');
            $data = $this->post();

            $safe_data = !isset($data['USERNAME']) || !$this->invheader_model->get_by(array('TRX_NUMBER'=> $data['TRX_NUMBER']));
            if(!$safe_data){
                $this->response( array('status'=>'failure', 
                'message'=>'the specified user already in used',REST_Controller::HTTP_CONFLICT));
                die;
            }
			//echo "TRX NUMBER  ".$id."<br>";
			
            $data_id = $this->invheader_model->update( $id, $data);            
            if (!$data_id){
                $this->response( array('status'=>'failure', 
                'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            } else {
                $this->response(array('status'=>'success','message'=>'updated'));
            }
        } else {
            $this->response( array('ELS status'=>'failure', 
            'ELS message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    function index_delete() {
        $id = $this->uri->segment(2);
        $this->load->model('invheader_model');
        $data = $this->invheader_model->get_by(array('TRX_NUMBER'=>$id));
        if (isset($data['TRX_NUMBER'])){
            $deleted = $this->invheader_model->delete($data);
            if (!$deleted){
                $this->response( array('status'=>'failure', 
                'message'=>'an expected error trying to update '),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            } else {
                $this->response(array('status'=>'success','message'=>'deleted'));
            }
        }
    }

}

