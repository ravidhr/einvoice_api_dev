<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class GetInvoiceRupaDetail extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }

  	function index_get() {
        $id = $this->uri->segment(2);
        $id2 = $this->uri->segment(3);

        $this->load->model('simop_GetInvoiceRupa_model');
        if ($id == '') {
                $result= $this->simop_GetInvoiceRupa_model->get_all();
        } else {
            if($id=='page' && $id2!==''){
                $total_posts = $this->simop_GetInvoiceRupa_model->count_rows(); // retrieve the total number of posts
                $result = $this->simop_GetInvoiceRupa_model->paginate(10,$total_posts);
            } else {           
                if($id!=='' && $id2==''){
                    $result= $this->simop_GetInvoiceRupa_model->get_all(array('TRX_NUMBER'=>$id));  
                }
            }
        }        
        $this->response($result, 200);
    }
	
}