<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Receipts extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }

    function index_get() {
        $id = $this->uri->segment(2);
        // die($id);
        $this->load->model('receipts_model');
        if ($id == '') {
                $rcp= $this->receipts_model->get_all();
                $this->response($rcp, 200);
        } else {
                $rcp= $this->receipts_model->get($id);
                if (isset($rcp['TRX_NUMBER'])) {
                    $this->response($rcp, 200);
                } else {
                    $this->response(array('status' => 'failure', 'message'=>'the spesify id could not be f0und',404));
                }
        }        
        $this->response($rcp, 200);
    }
}

