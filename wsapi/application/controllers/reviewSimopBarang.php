<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class reviewSimopBarang extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }

	function index_get() {
        $id = $this->uri->segment(2);
        $id2 = $this->uri->segment(3);
		//echo $id."<br>";
		//echo $id2;
		//die();

        $this->load->model('simop_barang_list_transaksi_model');
        if ($id == '') {
                $result= $this->simop_barang_list_transaksi_model->get_all();
        } else {
            if($id=='page' && $id2!==''){
                $total_posts = $this->simop_barang_list_transaksi_model->count_rows(); // retrieve the total number of posts
                $result = $this->simop_barang_list_transaksi_model->paginate(10,$total_posts);
            } else {           
                if($id!=='' && $id2!==''){
					//echo "seharusnya disini ";
					
                    $result= $this->simop_barang_list_transaksi_model->get_all(array('KD_CABANG'=>$id,'TRX_NUMBER'=>$id2));  
                } 
				if($id!=='' && $id2==''){
					//echo "seharusnya disini ";
					
                    $result= $this->simop_barang_list_transaksi_model->get_all(array('KD_CABANG'=>$id));  
                }
            }
        }        
        $this->response($result, 200);
    }

    function index_post() {
		
		$id = $this->uri->segment(2);
	
        $this->load->library('form_validation');
        $this->form_validation->set_data($this->put());
		//---------------------------------------
		 
		//call db rupa2	
        $this->barang_prod_db = $this->load->database('invoice_barang_prod',true);
		$this->barang_cabang_db = $this->load->database('invoice_barang_cabang',true);
		
        
        if($this->form_validation->run('simop_barang_list_transaksi_post') != false){
            $this->load->model('simop_barang_list_transaksi_model');
            $data = $this->post();				
    						
            $safe_data = $this->simop_barang_list_transaksi_model->get(array(
			'KD_CABANG'=>$this->post('KD_CABANG'),
			'TRX_NUMBER'=>$this->post('TRX_NUMBER')
			));
			
			$this->barang_cabang_db->select('NUM_ID,KD_CABANG,TRX_NUMBER,CUSTOMER_NUMBER,CUSTOMER_NAME,KODE_LAYANAN,AMOUNT_TOTAL,STATUS');
			//$this->db->select("DATE_FORMAT( date, '%d.%m.%Y' ) as date_human",  FALSE );					
			$this->barang_cabang_db->from('XEINVC_NOTA_BARANG');
			$this->barang_cabang_db->where('KD_CABANG=', ''.$this->post('KD_CABANG').'' );
			if ($this->post('TRX_NUMBER')!=''){
				$this->barang_cabang_db->where('TRX_NUMBER LIKE', '%'.$this->post('TRX_NUMBER').'%' );
			}
			$query = $this->barang_cabang_db->get();
							
			print json_encode($query->result());	
			
          
        } else {
            $this->response( array('status'=>'failure', 
            'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_BAD_REQUEST);
        }
		
		//close db 
		$this->barang_prod_db->close();
		$this->barang_cabang_db->close();
    }

 

}