<?php

class Mst_user_model extends MY_Model {
	
    // public $_database_connection = 'invoice';
    public $table = 'INV_MST_USER';
    public $primary_key = 'INV_USER_ID';
    protected $return_type = 'array';
	
    public function __construct()
	{
		// $this->load->library('REST_Controller')
		parent::__construct();
    }
    

	public function check_user($headers){
		// print_r($headers['Authorization']);die;
        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
			// $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            $decodedToken = AUTHORIZATION::validateTimestamp($headers['Authorization']);
			// print_r($decodedToken);die;
            if ($decodedToken != false) {
                return;
            }
		}
		$response = array('status' => 'Unauthorised');

		$this->output
				->set_status_header(403)
				->set_content_type('application/json', 'utf-8')
				->set_output(json_encode($response))
				->_display();
		die;
	}

	public function token_user($username, $pass)
	{
		$this->load->database();
		$this->db->select();
		$this->db->from('INV_MST_USER');
		$this->db->where_in('INV_USER_ID',$username);
		$query = $this->db->get();
		$row = $query->row_array();
		
		if($query->num_rows() > 0)
		{			
			$md5_string = md5($pass.$row['INV_USER_ID']);

			if($row['INV_USER_PASSWORD']==$md5_string){
				$tokenData = array();
				$tokenData['id'] = $username; //TODO: Replace with data for token
				$tokenData['timestamp'] = now();
				$output['token'] = AUTHORIZATION::generateToken($tokenData);
				// print_r($output);die;
                return $output;	
			}
		}
		
		return '';	
	}

}