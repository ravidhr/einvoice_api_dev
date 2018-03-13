<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class IntegrasiSimopUperDetail extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }

    function index_get() {
        $id = $this->uri->segment(2);
        $id2 = $this->uri->segment(3);

        $this->load->model('simop_header_model');
        if ($id == '') {
                $result= $this->simop_uper_detail_model->get_all();
        } else {
            if($id=='page' && $id2!==''){
                $total_posts = $this->simop_uper_detail_model->count_rows(); // retrieve the total number of posts
                $result = $this->simop_uper_detail_model->paginate(10,$total_posts);
            } else {           
                if($id!=='' && $id2==''){
                    $result= $this->simop_uper_detail_model->get(array('ID_NUM'=>$id));  
                }
            }
        }        
        $this->response($result, 200);
    }
    function index_put() {
        $this->load->library('form_validation');
        $this->form_validation->set_data($this->put());
			
        if($this->form_validation->run('simop_uper_header_put') != false){
			
            $this->load->model('simop_uper_detail_model');
            $exist = $this->simop_uper_detail_model->get(array('ID_NUM'=> $this->put('ID_NUM')));
            //print_r("APAKAH ADA DITES DULU EXISTS : ".$exist);
            //die;
            if(($exist==null)){                
                $data = $this->put();
                $data_id = $this->simop_uper_detail_model->insert($data); 
                if ($data_id){
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
            $this->response( array('ELS status'=>'failure', 
            'ELS message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    function index_post() {
        $id = $this->uri->segment(2);
        $this->load->library('form_validation');
        $this->form_validation->set_data($this->put());
								
        
        if($this->form_validation->run('simop_detail_post') != false){
            $this->load->model('simop_detail_model');
            $data = $this->post();				

            $safe_data = $this->simop_uper_detail_model->get(array(
			'BILLER_REQUEST_ID'=>$this->post('BILLER_REQUEST_ID'),
			'TRX_NUMBER'=>$this->post('TRX_NUMBER'),
			'LINE_NUMBER'=>$this->post('LINE_NUMBER'),
			'DESCRIPTION'=>$this->post('DESCRIPTION'),
			'LINE_CONTEXT'=>$this->post('LINE_CONTEXT'),
			'TAX_FLAG'=>$this->post('TAX_FLAG'),
			'SERVICE_TYPE'=>$this->post('SERVICE_TYPE'),
			'AMOUNT'=>$this->post('AMOUNT'),
			'TAX_AMOUNT'=>$this->post('TAX_AMOUNT'),
			'INTERFACE_LINE_ATTRIBUTE1'=>$this->post('INTERFACE_LINE_ATTRIBUTE1'),
			'INTERFACE_LINE_ATTRIBUTE2'=>$this->post('INTERFACE_LINE_ATTRIBUTE2'),
			'INTERFACE_LINE_ATTRIBUTE3'=>$this->post('INTERFACE_LINE_ATTRIBUTE3'),
			'INTERFACE_LINE_ATTRIBUTE4'=>$this->post('INTERFACE_LINE_ATTRIBUTE4'),
			'INTERFACE_LINE_ATTRIBUTE5'=>$this->post('INTERFACE_LINE_ATTRIBUTE5'),
			'INTERFACE_LINE_ATTRIBUTE6'=>$this->post('INTERFACE_LINE_ATTRIBUTE6'),
			'INTERFACE_LINE_ATTRIBUTE7'=>$this->post('INTERFACE_LINE_ATTRIBUTE7'),
			'INTERFACE_LINE_ATTRIBUTE8'=>$this->post('INTERFACE_LINE_ATTRIBUTE8'),
			'INTERFACE_LINE_ATTRIBUTE9'=>$this->post('INTERFACE_LINE_ATTRIBUTE9'),
			'INTERFACE_LINE_ATTRIBUTE10'=>$this->post('INTERFACE_LINE_ATTRIBUTE10'),
			'INTERFACE_LINE_ATTRIBUTE11'=>$this->post('INTERFACE_LINE_ATTRIBUTE11'),
			'INTERFACE_LINE_ATTRIBUTE12'=>$this->post('INTERFACE_LINE_ATTRIBUTE12'),
			'INTERFACE_LINE_ATTRIBUTE13'=>$this->post('INTERFACE_LINE_ATTRIBUTE13'),
			'INTERFACE_LINE_ATTRIBUTE14'=>$this->post('INTERFACE_LINE_ATTRIBUTE14'),
			'INTERFACE_LINE_ATTRIBUTE15'=>$this->post('INTERFACE_LINE_ATTRIBUTE15')
			));
			
            if(!isset($safe_data)){
                $this->response( array('status'=>'failure', 
                'message'=>'the specified no data to update',REST_Controller::HTTP_CONFLICT));
            }

            $data_id = $this->simop_uper_detail_model->insert($data,array(
			'BILLER_REQUEST_ID'=>$data['BILLER_REQUEST_ID'],
			'TRX_NUMBER'=>$data['TRX_NUMBER'],
			'LINE_NUMBER'=>$data['LINE_NUMBER'],
			'DESCRIPTION'=>$data['DESCRIPTION'],
			'LINE_CONTEXT'=>$data['LINE_CONTEXT'],
			'TAX_FLAG'=>$data['TAX_FLAG'],
			'SERVICE_TYPE'=>$data['SERVICE_TYPE'],
			'AMOUNT'=>$data['AMOUNT'],
			'TAX_AMOUNT'=>$data['TAX_AMOUNT'],
			'INTERFACE_LINE_ATTRIBUTE1'=>$data['INTERFACE_LINE_ATTRIBUTE1'],
			'INTERFACE_LINE_ATTRIBUTE2'=>$data['INTERFACE_LINE_ATTRIBUTE2'],
			'INTERFACE_LINE_ATTRIBUTE3'=>$data['INTERFACE_LINE_ATTRIBUTE3'],
			'INTERFACE_LINE_ATTRIBUTE4'=>$data['INTERFACE_LINE_ATTRIBUTE4'],
			'INTERFACE_LINE_ATTRIBUTE5'=>$data['INTERFACE_LINE_ATTRIBUTE5'],
			'INTERFACE_LINE_ATTRIBUTE6'=>$data['INTERFACE_LINE_ATTRIBUTE6'],
			'INTERFACE_LINE_ATTRIBUTE7'=>$data['INTERFACE_LINE_ATTRIBUTE7'],
			'INTERFACE_LINE_ATTRIBUTE8'=>$data['INTERFACE_LINE_ATTRIBUTE8'],
			'INTERFACE_LINE_ATTRIBUTE9'=>$data['INTERFACE_LINE_ATTRIBUTE9'],
			'INTERFACE_LINE_ATTRIBUTE10'=>$data['INTERFACE_LINE_ATTRIBUTE10'],
			'INTERFACE_LINE_ATTRIBUTE11'=>$data['INTERFACE_LINE_ATTRIBUTE11'],
			'INTERFACE_LINE_ATTRIBUTE12'=>$data['INTERFACE_LINE_ATTRIBUTE12'],
			'INTERFACE_LINE_ATTRIBUTE13'=>$data['INTERFACE_LINE_ATTRIBUTE13'],
			'INTERFACE_LINE_ATTRIBUTE14'=>$data['INTERFACE_LINE_ATTRIBUTE14'],
			'INTERFACE_LINE_ATTRIBUTE15'=>$data['INTERFACE_LINE_ATTRIBUTE15']
			));            
            			
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
        $this->load->model('nota_uper_header_model');
        $data = $this->nota_header_model->get(array('ID_NUM'=>$this->delete('ID_NUM')));
        if (isset($data)){
			
            $deleted = $this->nota_header_model->force_delete(array('ID_NUM'=>$this->delete('ID_NUM')));
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