<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config = array(
    'all_put' => array(
    ),
    'all_post' => array(
    ),
    'redaksi_put' => array(
        array('field' => 'INV_NOTA_LAYANAN', 'label'=> 'INV_NOTA_LAYANAN', 'rules'=> 'trim|required'),
    ),
    'redaksi_post' => array(
        array('field' => 'INV_REDAKSI_ID', 'label'=> 'INV_REDAKSI_ID', 'rules'=> 'trim|required'),
    ),
    'pejabat_put' => array(
        array('field' => 'INV_PEJABAT_NAME', 'label'=> 'INV_PEJABAT_NAME', 'rules'=> 'trim|required'),
    ),
    'pejabat_post' => array(
        array('field' => 'INV_PEJABAT_ID', 'label'=> 'INV_PEJABAT_ID', 'rules'=> 'trim|required'),
    ),
    'user_put' => array(
        array('field' => 'INV_USER_NAME', 'label'=> 'INV_USER_NAME', 'rules'=> 'trim|required'),
    ),
    'user_post' => array(
        array('field' => 'INV_USER_NAME', 'label'=> 'INV_USER_NAME', 'rules'=> 'trim|required'),
    ),
    'faktur_put' => array(
        array('field' => 'INV_FAKTUR_NOTE', 'label'=> 'INV_FAKTUR_NOTE', 'rules'=> 'trim|required'),
    ),
    'faktur_post' => array(
        array('field' => 'INV_FAKTUR_NOTE', 'label'=> 'INV_FAKTUR_NOTE', 'rules'=> 'trim|required'),
    ),
    'nota_put' => array(
        array('field' => 'INV_NOTA_CODE', 'label'=> 'INV_NOTA_CODE', 'rules'=> 'trim|required'),
    ),
    'nota_post' => array(
        array('field' => 'INV_NOTA_CODE', 'label'=> 'INV_NOTA_CODE', 'rules'=> 'trim|required'),
    ),
    'role_put' => array(
        array('field' => 'INV_ROLE_NAME', 'label'=> 'INV_ROLE_NAME', 'rules'=> 'trim|required'),
    ),
    'role_post' => array(
        array('field' => 'INV_ROLE_NAME', 'label'=> 'INV_ROLE_NAME', 'rules'=> 'trim|required'),
    ),
    'uper_put' => array(
        array('field' => 'NO_UPER', 'label'=> 'NO_UPER', 'rules'=> 'trim|required'),
        array('field' => 'RECEIPT_METHOD', 'label'=> 'RECEIPT_METHOD', 'rules'=> 'trim|required'),
        array('field' => 'RECEIPT_ACCOUNT', 'label'=> 'RECEIPT_ACCOUNT', 'rules'=> 'trim|required'),
    ),
    'bank_put' => array(
        array('field' => 'INV_BANK_REKENING', 'label'=> 'INV_BANK_REKENING', 'rules'=> 'trim|required'),
        array('field' => 'INV_BANK_NAME', 'label'=> 'INV_BANK_NAME', 'rules'=> 'trim|required'),
    ),
    'bank_post' => array(
        array('field' => 'INV_BANK_REKENING', 'label'=> 'INV_BANK_REKENING', 'rules'=> 'trim|required'),
        array('field' => 'INV_BANK_NAME', 'label'=> 'INV_BANK_NAME', 'rules'=> 'trim|required'),
    ),
    'payment_put' => array(
        array('field' => 'ID_NOTA', 'label'=> 'ID_NOTA', 'rules'=> 'trim|required'),
        array('field' => 'RECEIPT_METHOD', 'label'=> 'RECEIPT_METHOD', 'rules'=> 'trim|required'),
        array('field' => 'RECEIPT_ACCOUNT', 'label'=> 'RECEIPT_ACCOUNT', 'rules'=> 'trim|required'),
    ),
    'notah_put' => array(
        array('field' => 'ID_NOTA', 'label'=> 'ID_NOTA', 'rules'=> 'trim|required'),
        array('field' => 'ID_REQ', 'label'=> 'ID_REQ', 'rules'=> 'trim|required'),
    ),
    'notah_post' => array(
        array('field' => 'ID_NOTA', 'label'=> 'ID_NOTA', 'rules'=> 'trim|required'),
    ),
    'unit_put' => array(
        // array('field' => 'INV_UNIT_ID', 'label'=> 'INV_UNIT_ID', 'rules'=> 'trim|required'),
        array('field' => 'INV_UNIT_ORGID', 'label'=> 'INV_UNIT_ORGID', 'rules'=> 'trim|required'),
        array('field' => 'INV_UNIT_CODE', 'label'=> 'INV_UNIT_CODE', 'rules'=> 'trim|required'),
        array('field' => 'INV_UNIT_NAME', 'label'=> 'INV_UNIT_NAME', 'rules'=> 'trim|required'),
    ),
    'unit_post' => array(
        array('field' => 'INV_UNIT_ID', 'label'=> 'INV_UNIT_ID', 'rules'=> 'trim|required'),
    ),
    'entity_put' => array(
        // array('field' => 'INV_ENTITY_ID', 'label'=> 'INV_ENTITY_ID', 'rules'=> 'trim|required'),
        array('field' => 'INV_ENTITY_CODE', 'label'=> 'INV_ENTITY_CODE', 'rules'=> 'trim|required'),
        array('field' => 'INV_ENTITY_NAME', 'label'=> 'INV_ENTITY_NAME', 'rules'=> 'trim|required'),
    ),
    'entity_post' => array(
        array('field' => 'INV_ENTITY_CODE', 'label'=> 'INV_ENTITY_CODE', 'rules'=> 'trim|required'),
    ),
    'materai_put' => array(
        // array('field' => 'INV_EMATERAI_ID', 'label'=> 'INV_EMATERAI_ID', 'rules'=> 'trim|required'),
        array('field' => 'INV_EMATERAI_NUMBER', 'label'=> 'INV_EMATERAI_NUMBER', 'rules'=> 'trim|required'),
        array('field' => 'INV_ENTITY_ID', 'label'=> 'INV_ENTITY_ID', 'rules'=> 'trim|required'),
    ),
    'materai_post' => array(
        array('field' => 'INV_EMATERAI_NUMBER', 'label'=> 'INV_EMATERAI_NUMBER', 'rules'=> 'trim|required'),
    ),
    'user1_put' => array(
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
    'user1_post' => array(
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
	//start gagat 23 jan 2018 
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
	'Ebs_run_uper_post' => array(
		array('field' => 'IN_RECEIPT_NUMBER', 'label'=> 'IN_RECEIPT_NUMBER', 'rules'=> 'trim|required'),
        array('field' => 'IN_ORG_ID', 'label'=> 'IN_ORG_ID', 'rules'=> 'trim|required'),
		array('field' => 'IN_SOURCE', 'label'=> 'IN_SOURCE', 'rules'=> 'trim|required'),
	),
	'simop_receipt_header_post' => array(
		array('field' => 'RECEIPT_NUMBER', 'label'=> 'RECEIPT_NUMBER', 'rules'=> 'trim|required'),
    ),
	'simop_update_lunas_konsolidasi_post' => array(
		array('field' => 'STATUS_LUNAS', 'label'=> 'STATUS_LUNAS', 'rules'=> 'trim|required'),
    ),
	//end gagat 23 jan 2018 
);

        // array('field' => 'email_address', 'label'=> 'email address', 'rules'=> 'trim|required|valid_email'),
        // array('field' => 'password', 'label'=> 'password', 'rules'=> 'trim|required|min_length[8]|max_length[16]'),
?>