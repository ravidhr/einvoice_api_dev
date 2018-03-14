<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Email extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }

    function index_get() {
        /*$id = $this->uri->segment(2);
        $id2 = $this->uri->segment(3);

        $this->load->library('encrypt');
		$this->encrypt->set_cipher(MCRYPT_DES);
        $this->encrypt->set_mode(MCRYPT_MODE_CBC);*/
        
        $this->load->model('sendmail_model');
        
        $result= $this->sendmail_model->get_all();
        /*if ($id == '') {

        } else {
            if($id=='page' && $id2!==''){
                $total_posts = $this->sendmail->count_rows(); // retrieve the total number of posts
                $result = $this->sendmail->paginate(10,$total_posts);
            } else {           
                if($id!=='' && $id2==''){
                    $result= $this->sendmail->get(array('NO_NOTA'=>$id));  
                }
            }
        }     */   
        $this->response($result, 200);
    }
    
    function index_put() {
        $this->load->library('form_validation');
        $this->form_validation->set_data($this->put());
        
        if($this->form_validation->run('all_put') != false){
            $this->load->model('sendmail_model');
            $exist = $this->sendmail_model->get_by(array('NO_NOTA'=> $this->put('NO_NOTA')));
            if($exist){
                $this->response( array('status'=>'failure', 
                'message'=>'the specified user already exists',REST_Controller::HTTP_CONFLICT));
                die;
            }
            $data = $this->put();
            $data_id = $this->sendmail_model->insert($data);            
            if (!$data_id){
                $this->response( array('status'=>'failure', 
                'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            } else {
                $this->response(array('status'=>'success','message'=>'Created'));
            }
        }
    }
    
    function index_post() {
        $id = $this->uri->segment(2);
        $this->load->library('form_validation');
        $this->form_validation->set_data($this->put());
        
        if($this->form_validation->run('email_post') != false){
            $this->load->model('sendmail_model');
            $data = $this->post();

            $safe_data = $this->sendmail_model->get(array('NO_NOTA'=>$this->post('NO_NOTA')));
            if(!isset($safe_data)){
                $this->response( array('status'=>'failure', 
                'message'=>'the specified no data to update',REST_Controller::HTTP_CONFLICT));
            }

            $data_id = $this->sendmail_model->update( $data,array('NO_NOTA'=>$this->post('NO_NOTA')));            
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

    /*function index_delete() {
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
    }*/

    function search_post() {
        // $id = $this->uri->segment(3);
        $postdata = ($_POST);
        // $data = $this->get();
        // print_r('123');die;
        $this->load->model('sendmail_model');
        if (isset($postdata)) {
            $result= $this->sendmail_model->getData($postdata);
        } else {               
            $result= $this->sendmail_model->getData();
                // $total_posts = $this->invheader_model->count_rows(); // retrieve the total number of posts
                // $result = $this->invheader_model->paginate(10,$total_posts);
        }      

        $this->response($result, 200);  
    }
    
}

