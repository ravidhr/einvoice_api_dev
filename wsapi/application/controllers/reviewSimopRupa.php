<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;


class reviewSimopRupa extends REST_Controller  {
	
	function index_get() {
        $kd_cabang = $this->uri->segment(2);
        $id2 = $this->uri->segment(3);

        $this->load->model('simop_rupa_list_transaksi_model');
        if ($kd_cabang == '') {
                $result= $this->simop_rupa_list_transaksi_model->get_all();
        } else {
            if($kd_cabang=='page' && $id2!==''){
                $total_posts = $this->simop_rupa_list_transaksi_model->count_rows(); // retrieve the total number of posts
                $result = $this->simop_rupa_list_transaksi_model->paginate(10,$total_posts);
            } else {           
                if($kd_cabang!=='' && $id2==''){
                    $result= $this->simop_rupa_list_transaksi_model->get_all(array('KD_CABANG'=>$kd_cabang));  
                }
            }
        }        
        $this->response($result, 200);
    }

    function index_post() {
		
		/*$object[0] = array("NUM_ID" => 1,"TRX_NUMBER"=>'9289323829', 12 => true);
		$object[1] = array("NUM_ID" => 2,"TRX_NUMBER"=>'928932382DS9', 12 => true);

		$encoded_object = json_encode($object); 
		echo $encoded_object;
		die();*/
		
		$id = $this->uri->segment(2);
	
        $this->load->library('form_validation');
        $this->form_validation->set_data($this->put());
		
		//call db rupa2	
        $this->rupa2_prod_db = $this->load->database('invoice_rupa2_prod',true);
		
        if($this->form_validation->run('simop_rupa_list_transaksi_post') != false){
            $this->load->model('simop_rupa_list_transaksi_model');
            $data = $this->post();				

            $safe_data = $this->simop_rupa_list_transaksi_model->get(array(
			'KD_CABANG'=>$this->post('KD_CABANG'),
			'TRX_NUMBER'=>$this->post('TRX_NUMBER')
			));
			
			$this->rupa2_prod_db->select('NUM_ID,KD_CABANG,TRX_NUMBER,CUSTOMER_NUMBER,CUSTOMER_NAME,KODE_LAYANAN,AMOUNT_TOTAL,STATUS');
			//$this->db->select("DATE_FORMAT( date, '%d.%m.%Y' ) as date_human",  FALSE );					
			$this->rupa2_prod_db->from('XEINVC_NOTA_RUPA');
			$this->rupa2_prod_db->where('KD_CABANG=', ''.$this->post('KD_CABANG').'' );
			if ($this->post('TRX_NUMBER')!=''){
				$this->rupa2_prod_db->where('TRX_NUMBER LIKE', '%'.$this->post('TRX_NUMBER').'%' );
			}
			$query = $this->rupa2_prod_db->get();
							
			print json_encode($query->result());
			
			
          
        } else {
            $this->response( array('status'=>'failure', 
            'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_BAD_REQUEST);
        }
		
		//close db 
		$this->rupa2_prod_db->close();
    }

 

}