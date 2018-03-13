<?php
/***
Nama Controller 	: GetInvoiceBarangDetail.php
Ditulis oleh 		: Gagat Rahina
Tanggal Penulisan 	: 08 Februari 2018 
no hp 				: +628156237689
email 				: gagat.rahina@sigma.co.id
digunakan untuk mendapatkan data transaksi nota barang di SIMOP Barang 
yang akan ditransfer ke staging invoice konsolidasi
**/


defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class GetInvoiceBarangDetail extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }

  	function index_get() {
        $id = $this->uri->segment(2);
        $id2 = $this->uri->segment(3);
		$method = $_SERVER['REQUEST_METHOD'];		
		
        $this->load->model('Simop_GetInvoiceBarang_model');
        if ($id == '') {
                $result= $this->Simop_GetInvoiceBarang_model->get_all();
        } else {
            if($id=='page' && $id2!==''){
                $total_posts = $this->Simop_GetInvoiceBarang_model->count_rows(); // retrieve the total number of posts
                $result = $this->Simop_GetInvoiceBarang_model->paginate(10,$total_posts);
            } else {           
                if($id!=='' && $id2==''){
                    
					$result= $this->Simop_GetInvoiceBarang_model->get_all(array('TRX_NUMBER'=>$id));  
											
                }
				
				 
            }
        }        
        $this->response($result, 200);
    }
	
}