<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Others extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }

    function index_get() {
        echo('ok');
    }
    
    function terbilang_get() {        
        $id = $this->uri->segment(3);
        // die($id);
        $this->load->model('other_model');
        //----
        if ($id != '') {
                $result= $this->other_model->getTerbilang($id);
        }

        $this->response($result, 200);

    }
}