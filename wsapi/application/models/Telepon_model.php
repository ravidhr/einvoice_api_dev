<?php

class telepon_model extends MY_Model {

    public $table = 'TELEPON';
    public $primary_key = 'ID';
    protected $return_type = 'array';

    // public $after_get = array('remove_sensitive_data');
    // public $before_create = array('prep_data');

    
    public function __construct()
	{
        $this->after_get[] = 'remove_sensitive_data';
        $this->before_create[] = 'prep_data';
		parent::__construct();
    }
    
    protected function remove_sensitive_data($telepon){
        // unset($telepon['NAMA']);
        // unset($telepon['HASH']);
        return $telepon;
    }

    protected function prep_data($user){
        $user['NAMA'] = md5($user['NAMA']);
        return $user;
    }

}