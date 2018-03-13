<?php

class integrasi_model extends CI_Model {


    // public $after_get = array('remove_sensitive_data');
    // public $before_create = array('prep_data');

    
    public function __construct()
	{
		parent::__construct();
    }
    
    public function process($id){    
        
        //check data
        $result = '';
        $this->load->model('nota_all2_model');
        $this->load->model('nota_all_model');
        $this->load->model('invheader_model');
        $this->load->model('invlines_model');
        $exist = $this->invheader_model->get(array('TRX_NUMBER'=>$id));
        if($exist ==''){
            // die('test123');
            // process insert header            
            $data1= $this->nota_all2_model->get(array('NO_NOTA'=>$id));  
            $data = $this->InsertItosTTH2($data1);

            $result = $this->invheader_model->insert($data);
            
            if ($result->status=='success'){
                // process insert detail
                $data2= $this->nota_all_model->get_all(array('KD_PERMINTAAN'=>$id));  
                        
                foreach ($data2 as $key->$value) {                                   
                    if($key=='LINE_NUMBER'){
                        $data2= $this->nota_all_model->get(array('LINE_NUMBER'=>$value));  
                        // $result = $this->invheader_model->insert($data);
                    }
                    // $result = $this->invheader_model->insert($data);  
                    echo($data2);  
                }
            }
        }
        return $result;
    }

    public function InsertItosTTH2($data){

       $InsertData = array(
            'BILLER_REQUEST_ID' => $data->NO_REQUEST,
            'ORG_ID' => $data->ORG_ID,
            'TRX_NUMBER' => $data->NO_NOTA,
            'TRX_NUMBER_ORIG' => '', 
            'TRX_NUMBER_PREV' => '',
            'TRX_TAX_NUMBER' => $data->NO_FAKTUR_PAJAK,
            'TRX_DATE' => $data->DATE_CREATED,  
            'TRX_CLASS' => '',  
            'TRX_TYPE_ID' => '',  
            'PAYMENT_REFERENCE_NUMBER' => '',  
            'REFERENCE_NUMBER' => '', 
            'CURRENCY_CODE' => $data->SIGN_CURRENCY,
            'CURRENCY_TYPE' => '',  
            'CURRENCY_RATE' => '',  
            'CURRENCY_DATE' => '', 
            'AMOUNT' => $data->TOTAL,
            'CUSTOMER_NUMBER' => $data->CUST_NO,
            'CUSTOMER_CLASS' => '',  
            'BILL_TO_CUSTOMER_ID' => '',  
            'BILL_TO_SITE_USE_ID' => '',  
            'TERM_ID' => '',  
            'STATUS' => '',  
            'HEADER_CONTEXT' => $data->KD_MODUL,
            'HEADER_SUB_CONTEXT' => $data->JENIS_MODUL,
            'START_DATE' => '',  
            'END_DATE' => '',  
            'TERMINAL' => '',  
            'VESSEL_NAME' => $data->VESSEL,  
            'BRANCH_CODE' => '',  
            'ERROR_MESSAGE' => '',  
            'API_MESSAGE' => '',  
            'CREATED_BY' => '',  
            'CREATION_DATE' => '',  
            'LAST_UPDATED_BY' => '',  
            'LAST_UPDATE_DATE' => '',  
            'LAST_UPDATE_LOGIN' => '',  
            'CUSTOMER_TRX_ID_OUT' => '',  
            'PROCESS_FLAG' => '',  
            'ATTRIBUTE1' => $data->NO_DO,
            'ATTRIBUTE2' => $data->NOMOR_BL_PEB,
            'ATTRIBUTE3' => $data->BONGKAR_MUAT,
            'ATTRIBUTE4' => $data->VESSEL,
            'ATTRIBUTE5' => $data->VOYAGE_IN.'-'.$data->VOYAGE_OUT,
            'ATTRIBUTE6' => $data->TANGGAL_TIBA,
            'ATTRIBUTE7' => $data->PENUMPUKAN_FROM,
            'ATTRIBUTE8' => $data->PENUMPUKAN_TO,
            'ATTRIBUTE9' => $data->NOTAPREV,
            'ATTRIBUTE10' => '',  
            'ATTRIBUTE11' => '',  
            'ATTRIBUTE12' => '',  
            'ATTRIBUTE13' => '',  
            'ATTRIBUTE14' => '',  
            'ATTRIBUTE15' => '',  
            'INTERFACE_HEADER_ATTRIBUTE1' => '',  
            'INTERFACE_HEADER_ATTRIBUTE2' => '',  
            'INTERFACE_HEADER_ATTRIBUTE3' => '',  
            'INTERFACE_HEADER_ATTRIBUTE4' => '',  
            'INTERFACE_HEADER_ATTRIBUTE5' => '',  
            'INTERFACE_HEADER_ATTRIBUTE6' => '',  
            'INTERFACE_HEADER_ATTRIBUTE7' => '',  
            'INTERFACE_HEADER_ATTRIBUTE8' => '',  
            'INTERFACE_HEADER_ATTRIBUTE9' => '',  
            'INTERFACE_HEADER_ATTRIBUTE10' => '',  
            'INTERFACE_HEADER_ATTRIBUTE11' => '',  
            'INTERFACE_HEADER_ATTRIBUTE12' => '',  
            'INTERFACE_HEADER_ATTRIBUTE13' => '',  
            'INTERFACE_HEADER_ATTRIBUTE14' => '',  
            'INTERFACE_HEADER_ATTRIBUTE15' => '', 
            'CUSTOMER_ADDRESS' => '', 
            'CUSTOMER_NAME' => '',  
            'SOURCE_SYSTEM' => '',  
            'AR_STATUS' => '',
            'CUSTOMER_NPWP' => '',
            'SOURCE_INVOICE' => '',
            'AR_MESSAGE' => ''
        );

        //mereplace data
        
        $orgid = $this->getOrgID();
        foreach($InsertData as $key=>$value){
            if($key=='ORG_ID'){
                $data[$key]=$orgid;
            }
        }
        
        return $InsertData;
    }
    
    public function InsertItosTTH($data){
        
               $InsertData = array(
                    'BILLER_REQUEST_ID' => $data->KD_PERMINTAAN,
                    'TRX_NUMBER' => $data->KD_PERMINTAAN,
                    'LINE_ID' => '', 
                    'LINE_NUMBER' => $data->LINE_NUMBER,
                    'DESCRIPTION' => $data->KETERANGAN,
                    'MEMO_LINE_ID' => '',  
                    'GL_REV_ID' => '',  
                    'LINE_CONTEXT' => '',  
                    'TAX_FLAG' => '',  
                    'SERVICE_TYPE' => '', 
                    'EAM_CODE' => '',
                    'LOCATION_TERMINAL' => '',  
                    'AMOUNT' =>  $data->TOTTARIF,
                    'TAX_AMOUNT' => '',
                    'START_DATE' => $data->TOTAL,
                    'END_DATE' => $data->CUST_NO,
                    'CREATED_BY' => '',  
                    'CREATION_DATE' => '',  
                    'LAST_UPDATED_BY' => '',  
                    'LAST_UPDATED_DATE' => '',  
                    'INTERFACE_LINE_ATTRIBUTE1' => '',  
                    'INTERFACE_LINE_ATTRIBUTE2' => $data->EI,
                    'INTERFACE_LINE_ATTRIBUTE3' => $data->OI,
                    'INTERFACE_LINE_ATTRIBUTE4' => $data->CRANE,
                    'INTERFACE_LINE_ATTRIBUTE5' => '',  
                    'INTERFACE_LINE_ATTRIBUTE6' => $data->SIZE_TYPE_STAT_HAZ, 
                    'INTERFACE_LINE_ATTRIBUTE7' => '',  
                    'INTERFACE_LINE_ATTRIBUTE8' => '',  
                    'INTERFACE_LINE_ATTRIBUTE9' => $data->TOTHARI,
                    'INTERFACE_LINE_ATTRIBUTE10' => '',  
                    'INTERFACE_LINE_ATTRIBUTE11' => '',  
                    'INTERFACE_LINE_ATTRIBUTE12' => '',  
                    'INTERFACE_LINE_ATTRIBUTE13' => '',  
                    'INTERFACE_LINE_ATTRIBUTE14' => '',  
                    'INTERFACE_LINE_ATTRIBUTE15' => '',  
                );
                
                //mereplace data
                $service = $this->getServiceType($data->KD_PERMINTAAN);
                foreach($InsertData as $key=>$value){
                    if($key=='SERVICE_TYPE'){
                        $data[$key]=$service;
                    }
                }
                return $InsertData;
            }
    
            
    public function InsertNotaH($data){
        
               $InsertData = array(
                    'BILLER_REQUEST_ID' => $data->ID_REQ,
                    'ORG_ID' => $data->ORG_ID, //belum
                    'TRX_NUMBER' => $data->ID_NOTA,
                    'TRX_NUMBER_ORIG' => '', 
                    'TRX_NUMBER_PREV' => '',
                    'TRX_TAX_NUMBER' => $data   ->NO_FAKTUR,
                    'TRX_DATE' => $data->TGL_SIMPAN,  
                    'TRX_CLASS' => '',  
                    'TRX_TYPE_ID' => '',  
                    'PAYMENT_REFERENCE_NUMBER' => '',  
                    'REFERENCE_NUMBER' => '', 
                    'CURRENCY_CODE' => $data->VAL,
                    'CURRENCY_TYPE' => '',  
                    'CURRENCY_RATE' => '',  
                    'CURRENCY_DATE' => '', 
                    'AMOUNT' => $data->TOTAL,
                    'CUSTOMER_NUMBER' => '',
                    'CUSTOMER_CLASS' =>'',  
                    'BILL_TO_CUSTOMER_ID' => '',  
                    'BILL_TO_SITE_USE_ID' => '',  
                    'TERM_ID' => '',  
                    'STATUS' => '',  
                    'HEADER_CONTEXT' => 'PTKM',
                    'HEADER_SUB_CONTEXT' => $data->KD_MODUL,
                    'START_DATE' => '',  
                    'END_DATE' => '',  
                    'TERMINAL' => '',  
                    'VESSEL_NAME' => $data->VESSEL,  
                    'BRANCH_CODE' => '',  
                    'ERROR_MESSAGE' => '',  
                    'API_MESSAGE' => '',  
                    'CREATED_BY' => '',  
                    'CREATION_DATE' => '',  
                    'LAST_UPDATED_BY' => '',  
                    'LAST_UPDATE_DATE' => '',  
                    'LAST_UPDATE_LOGIN' => '',  
                    'CUSTOMER_TRX_ID_OUT' => '',  
                    'PROCESS_FLAG' => '',  
                    'ATTRIBUTE1' => $data->NO_DO,
                    'ATTRIBUTE2' => $data->NOMOR_BL_PEB,
                    'ATTRIBUTE3' => $data->BONGKAR_MUAT,
                    'ATTRIBUTE4' => $data->VESSEL,
                    'ATTRIBUTE5' => $data->VOYAGE_IN.'-'.$data->VOYAGE_OUT,
                    'ATTRIBUTE6' => $data->TANGGAL_TIBA,
                    'ATTRIBUTE7' => $data->PENUMPUKAN_FROM,
                    'ATTRIBUTE8' => $data->PENUMPUKAN_TO,
                    'ATTRIBUTE9' => $data->NOTAPREV,
                    'ATTRIBUTE10' => '',  
                    'ATTRIBUTE11' => '',  
                    'ATTRIBUTE12' => '',  
                    'ATTRIBUTE13' => '',  
                    'ATTRIBUTE14' => '',  
                    'ATTRIBUTE15' => '',  
                    'INTERFACE_HEADER_ATTRIBUTE1' => '',  
                    'INTERFACE_HEADER_ATTRIBUTE2' => '',  
                    'INTERFACE_HEADER_ATTRIBUTE3' => '',  
                    'INTERFACE_HEADER_ATTRIBUTE4' => '',  
                    'INTERFACE_HEADER_ATTRIBUTE5' => '',  
                    'INTERFACE_HEADER_ATTRIBUTE6' => '',  
                    'INTERFACE_HEADER_ATTRIBUTE7' => '',  
                    'INTERFACE_HEADER_ATTRIBUTE8' => '',  
                    'INTERFACE_HEADER_ATTRIBUTE9' => '',  
                    'INTERFACE_HEADER_ATTRIBUTE10' => '',  
                    'INTERFACE_HEADER_ATTRIBUTE11' => '',  
                    'INTERFACE_HEADER_ATTRIBUTE12' => '',  
                    'INTERFACE_HEADER_ATTRIBUTE13' => '',  
                    'INTERFACE_HEADER_ATTRIBUTE14' => '',  
                    'INTERFACE_HEADER_ATTRIBUTE15' => '', 
                    'CUSTOMER_ADDRESS' =>  $data->ALAMAT, 
                    'CUSTOMER_NAME' =>  $data->EMKL,  
                    'SOURCE_SYSTEM' => 'ITOSJBI_NBM',  
                    'AR_STATUS' => '',
                    'CUSTOMER_NPWP' => '',
                    'SOURCE_INVOICE' => '',
                    'AR_MESSAGE' => ''
                );
        
                //mereplace data
                $orgid = $this->getOrgID();
                foreach($InsertData as $key=>$value){
                    if($key=='ORG_ID'){
                        $data[$key]=$orgid;
                    }
                }
        
                return $InsertData;
            }
            
            public function InsertNotaD($data){
                
                       $InsertData = array(
                            'BILLER_REQUEST_ID' => $data->ID_REQ,
                            'TRX_NUMBER' => $data->ID_NOTA,
                            'LINE_ID' => '', 
                            'LINE_NUMBER' => $data->LINE_NUMBER,
                            'DESCRIPTION' => $data->KETERANGAN,
                            'MEMO_LINE_ID' => '',  
                            'GL_REV_ID' => '',  
                            'LINE_CONTEXT' => '',  
                            'TAX_FLAG' => '',  
                            'SERVICE_TYPE' => '', 
                            'EAM_CODE' => '',
                            'LOCATION_TERMINAL' => '',  
                            'AMOUNT' =>  $data->SUB_TOTAL,
                            'TAX_AMOUNT' => '',
                            'START_DATE' => $data->TOTAL,
                            'END_DATE' => $data->CUST_NO,
                            'CREATED_BY' => '',  
                            'CREATION_DATE' => '',  
                            'LAST_UPDATED_BY' => '',  
                            'LAST_UPDATED_DATE' => '',  
                            'INTERFACE_LINE_ATTRIBUTE1' => '',  
                            'INTERFACE_LINE_ATTRIBUTE2' => $data->EI,
                            'INTERFACE_LINE_ATTRIBUTE3' => $data->OI,
                            'INTERFACE_LINE_ATTRIBUTE4' => $data->CRANE,
                            'INTERFACE_LINE_ATTRIBUTE5' => '',  
                            'INTERFACE_LINE_ATTRIBUTE6' => $data->SIZE_TYPE_STAT_HAZ, 
                            'INTERFACE_LINE_ATTRIBUTE7' => '',  
                            'INTERFACE_LINE_ATTRIBUTE8' => '',  
                            'INTERFACE_LINE_ATTRIBUTE9' => $data->TOTHARI,
                            'INTERFACE_LINE_ATTRIBUTE10' => '',  
                            'INTERFACE_LINE_ATTRIBUTE11' => '',  
                            'INTERFACE_LINE_ATTRIBUTE12' => '',  
                            'INTERFACE_LINE_ATTRIBUTE13' => '',  
                            'INTERFACE_LINE_ATTRIBUTE14' => '',  
                            'INTERFACE_LINE_ATTRIBUTE15' => '',  
                        );
                        
                        //mereplace data
                        $service = $this->getServiceType($data->ID_NOTA)
                        foreach($InsertData as $key=>$value){
                            if($key=='SERVICE_TYPE'){
                                $data[$key]= $service;
                            }
                        }
                        return $InsertData;
                    }
    
                    
	public function getOrgID(){
        $this->load->model('other_model');
        $select='select ORG_ID from terminal_config where enable=\'Y\'';
        $result = $this->other_model->getQuery($select);
        return $result;
     }
              
	public function getServiceType($no_nota){
        $this->load->model('other_model');
        $select= 'SELECT CONCAT ('RECEIVING ', c.kd_tp_jasa) kd_tp_jasa 
            FROM nota_receiving_d a LEFT JOIN master_barang b
             ON TRIM (id_cont) = TRIM (kode_barang)
             LEFT JOIN mst_ebs_cfaccount c ON a.keterangan = c.uraian_tp_jasa
            WHERE TRIM (id_nota) ='.$no_nota.';
      
        $result = $this->other_model->getQuery($select);
        return $result;
     }
}