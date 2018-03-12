<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Test extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }

    function index_get() {

        $this->load->model('other_model');
        $data = $this->other_model->getdata('consolidasi','INV_MST_ENTITY','','*');
        die;

    }
}