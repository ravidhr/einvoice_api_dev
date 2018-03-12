<?php

class Nota_header_model extends MY_Model {

    
    public $_database_connection = 'itos';
    public $table = 'NOTA_RECEIVING_H';
    public $primary_key = 'ID_NOTA';

    // protected $return_type = 'array';   

    public function __construct()
	{
        // $this->_database_connection = 'itos';
        // $this->table = 'NOTA_RECEIVING_H';
        // $this->primary_key = 'ID_NOTA';
        
        // $this->before_create[] = 'prep_data';

		parent::__construct();
    }
    
    protected function prep_data($data){
        // $data['TOTAL'] = md5($data['TOTAL']);
        // $data['TOTAL'] = number_format($data['TOTAL']);
        
        // unset($data['ADM_NOTA']);
        // set($data['NGANTUK']='123');
        // $data['NGANTUK'] = '123457';
        return $data;
    }
    
	public function getQuery($where=null){
		$this->load->database();
		$this->db->select();
		$this->db->from($table);
		$this->db->where($where);
		$query = $this->db->get();
        $row = $query->row_array();
        return $row;
	}

}