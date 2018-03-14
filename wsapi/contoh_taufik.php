<?php
$parameters = array(
  'IN_ORG_ID' =>  $czczcz ,
  'IN_RECEIPT_NUMBER' => $caca,
   'OUT_STATUS' => null,
   'OUT_MESSAGE' => null;
)

$result = $this->db->stored_procedure('INVOICE','XEINVC_API_KONSOLIDASI_PKG.INSERT_AR_RECEIPT_CONSOLE',$parameters);

print_r($parameters);
?>