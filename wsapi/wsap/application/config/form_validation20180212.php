<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config = array(
    'all_put' => array(
    ),
    'all_post' => array(
    ),
    'entity_put' => array(
        array('field' => 'INV_ENTITY_ID', 'label'=> 'INV_ENTITY_ID', 'rules'=> 'trim|required'),
        array('field' => 'INV_ENTITY_NAME', 'label'=> 'INV_ENTITY_NAME', 'rules'=> 'trim|required'),
        array('field' => 'INV_ENTITY_ADDRESS', 'label'=> 'INV_ENTITY_ADDRESS', 'rules'=> 'trim|required'),
        array('field' => 'INV_ENTITY_NPWP', 'label'=> 'INV_ENTITY_NPWP', 'rules'=> 'trim|required'),
        array('field' => 'INV_ENTITY_FAKTUR_PAJAK', 'label'=> 'INV_ENTITY_FAKTUR_PAJAK', 'rules'=> 'trim|required'),
        // array('field' => 'INV_ENTITY_LOGO', 'label'=> 'INV_ENTITY_LOGO', 'rules'=> 'trim|required'),
        // array('field' => 'INV_ENTITY_MATERAI', 'label'=> 'INV_ENTITY_MATERAI', 'rules'=> 'trim|required'),
        // array('field' => 'INV_ENTITY_RDK_MATERAI', 'label'=> 'INV_ENTITY_RDK_MATERAI', 'rules'=> 'trim|required'),

    ),
    'entity_post' => array(
        array('field' => 'INV_ENTITY_ID', 'label'=> 'INV_ENTITY_ID', 'rules'=> 'trim|required'),
        // array('field' => 'INV_ENTITY_NAME', 'label'=> 'INV_ENTITY_NAME', 'rules'=> 'trim|required'),
        // array('field' => 'INV_ENTITY_ADDRESS', 'label'=> 'INV_ENTITY_ADDRESS', 'rules'=> 'trim|required'),
        // array('field' => 'INV_ENTITY_NPWP', 'label'=> 'INV_ENTITY_NPWP', 'rules'=> 'trim|required'),
        // array('field' => 'INV_ENTITY_FAKTUR_PAJAK', 'label'=> 'INV_ENTITY_FAKTUR_PAJAK', 'rules'=> 'trim|required'),
    ),
    'unit_put' => array(
        array('field' => 'ID_NUM', 'label'=> 'ID_NUM', 'rules'=> 'trim|required'),
        array('field' => 'PRODUCT_NAME', 'label'=> 'PRODUCT_NAME', 'rules'=> 'trim|required'),
        array('field' => 'PRICE', 'label'=> 'PRICE', 'rules'=> 'trim|required'),
        array('field' => 'QUANTITY', 'label'=> 'QUANTITY', 'rules'=> 'trim|required'),
        //array('field' => 'INV_UNIT_WILAYAH', 'label'=> 'INV_UNIT_WILAYAH', 'rules'=> 'trim|required'),
        // array('field' => 'INV_UNIT_ALAMAT', 'label'=> 'INV_UNIT_ALAMAT', 'rules'=> 'trim|required'),
        // array('field' => 'INV_UNIT_RDK_BAWAH', 'label'=> 'INV_UNIT_RDK_BAWAH', 'rules'=> 'trim|required'),
        // array('field' => 'INV_UNIT_FOOTER_NOTE', 'label'=> 'INV_UNIT_FOOTER_NOTE_', 'rules'=> 'trim|required'),
        // array('field' => 'INV_UNIT_PEJABAT', 'label'=> 'INV_UNIT_PEJABAT', 'rules'=> 'trim|required'),
        // array('field' => 'INV_UNIT_NIPP', 'label'=> 'INV_UNIT_NIPP', 'rules'=> 'trim|required'),
        // array('field' => 'INV_UNIT_TTD', 'label'=> 'INV_UNIT_TTD', 'rules'=> 'trim|required'),
        // array('field' => 'INV_UNIT_START_DATE', 'label'=> 'INV_UNIT_START_DATE', 'rules'=> 'trim|required'),
        // array('field' => 'INV_UNIT_END_DATE', 'label'=> 'INV_UNIT_END_DATE', 'rules'=> 'trim|required'),
        // array('field' => 'INV_UNIT_CETAK', 'label'=> 'INV_UNIT_CETAK', 'rules'=> 'trim|required'),
        // array('field' => 'INV_UNIT_NOTA_KAPAL', 'label'=> 'INV_UNIT_NOTA_KAPAL', 'rules'=> 'trim|required'),
        // array('field' => 'INV_UNIT_NOTA_PETIKEMAS', 'label'=> 'INV_UNIT_NOTA_PETIKEMAS', 'rules'=> 'trim|required'),
        // array('field' => 'INV_UNIT_NOTA_BARANG', 'label'=> 'INV_UNIT_NOTA_BARANG', 'rules'=> 'trim|required'),
        // array('field' => 'INV_UNIT_NOTA_RUPA', 'label'=> 'INV_UNIT_NOTA_RUPA', 'rules'=> 'trim|required'),
        // array('field' => 'INV_UNIT_BANK', 'label'=> 'INV_UNIT_BANK', 'rules'=> 'trim|required'),
    ),
    'unit_post' => array(
        array('field' => 'TRX_NUMBER', 'label'=> 'TRX_NUMBER', 'rules'=> 'trim|required'),
    ),
    
    'wilayah_put' => array(
        array('field' => 'INV_WILAYAH_ID', 'label'=> 'INV_WILAYAH_ID', 'rules'=> 'trim|required'),
        array('field' => 'INV_WILAYAH_CODE', 'label'=> 'INV_WILAYAH_CODE', 'rules'=> 'trim|required'),
        array('field' => 'INV_WILAYAH_NAME', 'label'=> 'INV_WILAYAH_NAME', 'rules'=> 'trim|required'),
        array('field' => 'INV_WILAYAH_CABANG', 'label'=> 'INV_WILAYAH_CABANG', 'rules'=> 'trim|required'),
        array('field' => 'INV_WILAYAH_ALAMAT', 'label'=> 'INV_WILAYAH_ALAMAT', 'rules'=> 'trim|required'),
    ),

    'wilayah_post' => array(
        array('field' => 'INV_WILAYAH_ID', 'label'=> 'INV_WILAYAH_ID', 'rules'=> 'trim|required'),
    ),

    'nota_put' => array(
        array('field' => 'INV_NOTA_ID', 'label'=> 'INV_NOTA_ID', 'rules'=> 'trim|required'),
        array('field' => 'INV_NOTA_LAYANAN', 'label'=> 'INV_NOTA_LAYANAN', 'rules'=> 'trim|required'),
        array('field' => 'INV_NOTA_CODE', 'label'=> 'INV_NOTA_CODE', 'rules'=> 'trim|required'),
        array('field' => 'INV_NOTA_JENIS', 'label'=> 'INV_NOTA_JENIS', 'rules'=> 'trim|required'),
        array('field' => 'INV_NOTA_REDAKSI', 'label'=> 'INV_NOTA_REDAKSI', 'rules'=> 'trim|required'),

    ),
    'nota_post' => array(
        array('field' => 'INV_NOTA_ID', 'label'=> 'INV_NOTA_ID', 'rules'=> 'trim|required'),
    ),

    'bank_put' =>array(
        array('field'=>'INV_BANK_ID', 'label'=>'INV_BANK_ID', 'rules'=> 'trim|required'),
        array('field'=>'INV_BANK_NAME', 'label'=>'INV_BANK_NAME', 'rules'=> 'trim|required'),
        array('field'=>'INV_BANK_REK', 'label'=>'INV_BANK_REK', 'rules'=> 'trim|required'),
    ),

    'bank_post'=>array(
        array('field'=>'INV_BANK_ID', 'label'=>'INV_BANK_ID', 'rules'=> 'trim|required'),
    ),
	
	'notah_put' => array(
        array('field' => 'BILLER_REQUEST_ID', 'label'=> 'BILLER_REQUEST_ID', 'rules'=> 'trim|required'),
        // array('field' => 'INV_ENTITY_NAME', 'label'=> 'INV_ENTITY_NAME', 'rules'=> 'trim|required'),
        // array('field' => 'INV_ENTITY_ADDRESS', 'label'=> 'INV_ENTITY_ADDRESS', 'rules'=> 'trim|required'),
        // array('field' => 'INV_ENTITY_NPWP', 'label'=> 'INV_ENTITY_NPWP', 'rules'=> 'trim|required'),
        // array('field' => 'INV_ENTITY_FAKTUR_PAJAK', 'label'=> 'INV_ENTITY_FAKTUR_PAJAK', 'rules'=> 'trim|required'),
    ),	
	'notah_post' => array(
        array('field' => 'BILLER_REQUEST_ID', 'label'=> 'BILLER_REQUEST_ID', 'rules'=> 'trim|required'),
        // array('field' => 'INV_ENTITY_NAME', 'label'=> 'INV_ENTITY_NAME', 'rules'=> 'trim|required'),
        // array('field' => 'INV_ENTITY_ADDRESS', 'label'=> 'INV_ENTITY_ADDRESS', 'rules'=> 'trim|required'),
        // array('field' => 'INV_ENTITY_NPWP', 'label'=> 'INV_ENTITY_NPWP', 'rules'=> 'trim|required'),
        // array('field' => 'INV_ENTITY_FAKTUR_PAJAK', 'label'=> 'INV_ENTITY_FAKTUR_PAJAK', 'rules'=> 'trim|required'),
    ),
	//start gagat 23 jan 2018 
    'simop_header_post' => array(
        array('field' => 'BILLER_REQUEST_ID', 'label'=> 'BILLER_REQUEST_ID', 'rules'=> 'trim|required'),
        array('field' => 'TRX_NUMBER', 'label'=> 'TRX_NUMBER', 'rules'=> 'trim|required'),
        array('field' => 'ORG_ID', 'label'=> 'ORG_ID', 'rules'=> 'trim|required'),
        array('field' => 'CUSTOMER_NUMBER', 'label'=> 'CUSTOMER_NUMBER', 'rules'=> 'trim|required'),
        array('field' => 'CUSTOMER_NAME', 'label'=> 'CUSTOMER_NAME', 'rules'=> 'trim|required'),
    ), 
	'simop_header_put' => array(
        array('field' => 'BILLER_REQUEST_ID', 'label'=> 'BILLER_REQUEST_ID', 'rules'=> 'trim|required'),
        array('field' => 'TRX_NUMBER', 'label'=> 'TRX_NUMBER', 'rules'=> 'trim|required'),
        array('field' => 'ORG_ID', 'label'=> 'ORG_ID', 'rules'=> 'trim|required'),
        array('field' => 'CUSTOMER_NUMBER', 'label'=> 'CUSTOMER_NUMBER', 'rules'=> 'trim|required'),
        array('field' => 'CUSTOMER_NAME', 'label'=> 'CUSTOMER_NAME', 'rules'=> 'trim|required'),
    ),
	'simop_detail_post' => array(
        array('field' => 'BILLER_REQUEST_ID', 'label'=> 'BILLER_REQUEST_ID', 'rules'=> 'trim|required'),
        array('field' => 'TRX_NUMBER', 'label'=> 'TRX_NUMBER', 'rules'=> 'trim|required'),
    ),
	'simop_uper_header_post' => array(
		array('field' => 'IN_SOURCE_INVOICE', 'label'=> 'IN_SOURCE_INVOICE', 'rules'=> 'trim|required'),
        array('field' => 'ORG_ID', 'label'=> 'ORG_ID', 'rules'=> 'trim|required'),
        array('field' => 'RECEIPT_NUMBER', 'label'=> 'RECEIPT_NUMBER', 'rules'=> 'trim|required'),
        array('field' => 'RECEIPT_ACCOUNT', 'label'=> 'RECEIPT_ACCOUNT', 'rules'=> 'trim|required'),
        array('field' => 'CUSTOMER_NUMBER', 'label'=> 'CUSTOMER_NUMBER', 'rules'=> 'trim|required'),
        array('field' => 'CURRENCY_CODE', 'label'=> 'CURRENCY_CODE', 'rules'=> 'trim|required'),
    ),
	'simop_kapal_create_invoice_post' => array(
		array('field' => 'TRX_NUMBER', 'label'=> 'TRX_NUMBER', 'rules'=> 'trim|required'),
        array('field' => 'ORG_ID', 'label'=> 'ORG_ID', 'rules'=> 'trim|required'),
        array('field' => 'JENIS_NOTA', 'label'=> 'JENIS_NOTA', 'rules'=> 'trim|required'),
    ),
	'simop_barang_create_invoice_post' => array(
		array('field' => 'TRX_NUMBER', 'label'=> 'TRX_NUMBER', 'rules'=> 'trim|required'),
        array('field' => 'ORG_ID', 'label'=> 'ORG_ID', 'rules'=> 'trim|required'),
        array('field' => 'JENIS_NOTA', 'label'=> 'JENIS_NOTA', 'rules'=> 'trim|required'),
    ),
	'simop_rupa_create_invoice_post' => array(
		array('field' => 'TRX_NUMBER', 'label'=> 'TRX_NUMBER', 'rules'=> 'trim|required'),
        array('field' => 'ORG_ID', 'label'=> 'ORG_ID', 'rules'=> 'trim|required'),
        array('field' => 'JENIS_NOTA', 'label'=> 'JENIS_NOTA', 'rules'=> 'trim|required'),
    ),	
	'simop_invoice_header_post' => array(
		array('field' => 'SOURCE_INVOICE', 'label'=> 'SOURCE_INVOICE', 'rules'=> 'trim|required'),
		array('field' => 'BILLER_REQUEST_ID', 'label'=> 'BILLER_REQUEST_ID', 'rules'=> 'trim|required'),
        array('field' => 'ORG_ID', 'label'=> 'ORG_ID', 'rules'=> 'trim|required'),
        array('field' => 'TRX_NUMBER', 'label'=> 'TRX_NUMBER', 'rules'=> 'trim|required'),
		array('field' => 'TRX_DATE', 'label'=> 'TRX_DATE', 'rules'=> 'trim|required'),
		array('field' => 'TRX_CLASS', 'label'=> 'TRX_CLASS', 'rules'=> 'trim|required'),
		array('field' => 'CURRENCY_CODE', 'label'=> 'CURRENCY_CODE', 'rules'=> 'trim|required'),
		array('field' => 'CUSTOMER_NUMBER', 'label'=> 'CUSTOMER_NUMBER', 'rules'=> 'trim|required'),
		array('field' => 'STATUS', 'label'=> 'STATUS', 'rules'=> 'trim|required'),
		array('field' => 'HEADER_CONTEXT', 'label'=> 'HEADER_CONTEXT', 'rules'=> 'trim|required'),
		array('field' => 'HEADER_SUB_CONTEXT', 'label'=> 'HEADER_SUB_CONTEXT', 'rules'=> 'trim|required'),
		array('field' => 'TERMINAL', 'label'=> 'TERMINAL', 'rules'=> 'trim|required'),		
    ),	
	'simop_invoice_detail_post' => array(
		array('field' => 'BILLER_REQUEST_ID', 'label'=> 'BILLER_REQUEST_ID', 'rules'=> 'trim|required'),
        array('field' => 'TRX_NUMBER', 'label'=> 'TRX_NUMBER', 'rules'=> 'trim|required'),
		array('field' => 'LINE_NUMBER', 'label'=> 'LINE_NUMBER', 'rules'=> 'trim|required'),
		array('field' => 'TAX_FLAG', 'label'=> 'TAX_FLAG', 'rules'=> 'trim|required'),
		array('field' => 'SERVICE_TYPE', 'label'=> 'SERVICE_TYPE', 'rules'=> 'trim|required'),		
    ),
	//end gagat 23 jan 2018 
    'user_put' => array(
        array('field' => 'USERNAME', 'label'=> 'USERNAME', 'rules'=> 'trim|required|alpha_dash'),
        array('field' => 'PASSWORD', 'label'=> 'PASSWORD', 'rules'=> 'trim|required|min_length[8]|max_length[16]'),
        array('field' => 'NAME', 'label'=> 'NAME', 'rules'=> 'trim|required|alpha_dash'),
        array('field' => 'EMAIL', 'label'=> 'EMAIL', 'rules'=> 'trim|required|valid_email'),
        array('field' => 'CUSTOMER_ID', 'label'=> 'CUSTOMER_ID', 'rules'=> 'trim|alpha_dash'),
        array('field' => 'HANDPHONE', 'label'=> 'HANDPHONE', 'rules'=> 'trim|alpha_dash'),
        array('field' => 'ID_GROUP', 'label'=> 'ID_GROUP', 'rules'=> 'trim|alpha_dash'),
        array('field' => 'USER_ID_SIMOP', 'label'=> 'USER_ID_SIMOP', 'rules'=> 'trim|alpha_dash'),
        array('field' => 'EXTERNAL_ID', 'label'=> 'EXTERNAL_ID', 'rules'=> 'trim|alpha_dash'),
        array('field' => 'BRANCH_ID', 'label'=> 'BRANCH_ID', 'rules'=> 'trim|alpha_dash'),
        array('field' => 'REGISTRATION_COMPANY_ID', 'label'=> 'REGISTRATION_COMPANY_ID', 'rules'=> 'trim|alpha_dash'),
        array('field' => 'IS_PPJK', 'label'=> 'IS_PPJK', 'rules'=> 'trim|alpha_dash'),
        array('field' => 'EXTERNAL_ID', 'label'=> 'NAME', 'rules'=> 'trim|alpha_dash'),
    ),
    'user_post' => array(
        array('field' => 'USERNAME', 'label'=> 'USERNAME', 'rules'=> 'trim|alpha_dash'),
        array('field' => 'NAME', 'label'=> 'NAME'),
        array('field' => 'EMAIL', 'label'=> 'EMAIL', 'rules'=> 'trim|valid_email'),
        array('field' => 'CUSTOMER_ID', 'label'=> 'CUSTOMER_ID', 'rules'=> 'trim|alpha_dash'),
        array('field' => 'HANDPHONE', 'label'=> 'HANDPHONE', 'rules'=> 'trim|alpha_dash'),
        array('field' => 'ID_GROUP', 'label'=> 'ID_GROUP', 'rules'=> 'trim|alpha_dash'),
        array('field' => 'USER_ID_SIMOP', 'label'=> 'USER_ID_SIMOP', 'rules'=> 'trim|alpha_dash'),
        array('field' => 'EXTERNAL_ID', 'label'=> 'EXTERNAL_ID', 'rules'=> 'trim|alpha_dash'),
        array('field' => 'BRANCH_ID', 'label'=> 'BRANCH_ID', 'rules'=> 'trim|alpha_dash'),
        array('field' => 'REGISTRATION_COMPANY_ID', 'label'=> 'REGISTRATION_COMPANY_ID', 'rules'=> 'trim|alpha_dash'),
        array('field' => 'IS_PPJK', 'label'=> 'IS_PPJK', 'rules'=> 'trim|alpha_dash'),
        array('field' => 'EXTERNAL_ID', 'label'=> 'NAME', 'rules'=> 'trim|alpha_dash'),
    ),
    'password_post' => array(
        array('field' => 'USERNAME', 'label'=> 'USERNAME', 'rules'=> 'trim|required|alpha_dash'),
        array('field' => 'PASSWORD', 'label'=> 'PASSWORD', 'rules'=> 'trim|required|min_length[8]|max_length[16]'),
    ),
);

        // array('field' => 'email_address', 'label'=> 'email address', 'rules'=> 'trim|required|valid_email'),
        // array('field' => 'password', 'label'=> 'password', 'rules'=> 'trim|required|min_length[8]|max_length[16]'),
?>