<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Uper extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }

    function index_get() {
        $id = $this->uri->segment(2);
        $id2 = $this->uri->segment(3);
        // $id3 = $this->get();
        // print_r($id);die;    
        
        $this->load->model('integrasi_model');
        // $this->load->model('invheader_model');
        if ($id == '') {
            // die('123');
                // $where = 'STATUS=S';
            $where = array('NO_UPER'=>$id);
            $result= $this->integrasi_model->getUper($where);
        }     
        else {
            $where = array('NO_UPER'=>$id);
            $result= $this->integrasi_model->getUper( $where);
        }       
        $this->response($result, 200);
    }

    function index_put() {
        $this->load->library('form_validation');
        $this->form_validation->set_data($this->put());

        if($this->form_validation->run('uper_put') != false){
            $this->load->model('integrasi_model');
            $this->load->model('receipts_model');         
            $data = $this->put(); 
            $data_id = $this->integrasi_model->uperpay($data); 
                // print_r($data_id); die;
                if (!$data_id){
                    $this->response( array('status'=>'failure', 
                    'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
                } else {
                    $this->response(array('status'=>'success','message'=>'Created'));
                }
            // }
        } else {
            $this->response( array('status'=>'failure', 
            'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    function index_post() {
        $id = $this->uri->segment(2);
        $this->load->library('form_validation');
        $this->form_validation->set_data($this->put());
        
        if($this->form_validation->run('notah_post') != false){
            $this->load->model('nota_header_model');
            $data = $this->post();

            $safe_data = $this->nota_header_model->get(array('ID_NOTA'=>$this->post('ID_NOTA')));
            if(!isset($safe_data)){
                $this->response( array('status'=>'failure', 
                'message'=>'the specified no data to update',REST_Controller::HTTP_CONFLICT));
            }

            $data_id = $this->nota_header_model->update( $data,array('ID_NOTA'=>$this->post('ID_NOTA')));            
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
        $data = $this->nota_header_model->get(array('ID_NOTA'=>$this->delete('ID_NOTA')));
        if (isset($data)){
            $deleted = $this->nota_header_model->force_delete(array('ID_NOTA'=>$this->delete('ID_NOTA')));
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
        $this->load->model('integrasi_model');
        if (isset($postdata)) {
            $result= $this->integrasi_model->getUper($postdata);
        } else {               
            $where = array('NO_UPER'=>'');
            $result= $this->integrasi_model->getUper($where);
        }      
        $this->response($result, 200);  
    }

}