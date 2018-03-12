<?php
class Other_model extends CI_Model{

	private $db1;

	public function getdata($connect,$table,$where = NULL,$field = NULL)
	{
		$this->db1 = $this->load->database($connect,TRUE);
		if(isset($where) && $where!=='') 
			$this->db1->where($where);
		if(isset($field) && $field!=='')
			$this->db1->select($field);
        $sql =  $this->db1->get($table);
		$result = $sql->result_array();
		return $result;
	}

	public function getQuery($select){
		// $his->load->database();
		$this->db1 = $this->load->database('itos',true);
		$query = $this->db1->query($select);
		$row = $query->row_array();
		return $result;
	}
	
	public function getTerbilang($amount){
		$this->load->database();
		$sql =    'select terbilang ('.$amount.') as nilai from dual';
		
		$sql = $this->db->query($sql);
		$result = $sql->result();
		return $result;
	}

}