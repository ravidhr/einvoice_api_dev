<?php

class Nota_all_model extends MY_Model {

    public $_database_connection = 'itos';
    public $table = 'TTH_NOTA_ALL';
    public $primary_key = 'NO_NOTA';
    public $fillable = array();
    public $protected = array();

    // public $after_get = array('remove_sensitive_data');
    // public $before_create = array('prep_data');

    
    public function __construct()
	{
        // $this->after_get[] = 'remove_sensitive_data';
        // $this->before_create[] = 'prep_data';
		parent::__construct();
    }
}