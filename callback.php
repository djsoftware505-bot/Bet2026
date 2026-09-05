<?php
$data = file_get_contents('php://input');
file_put_contents('transactions.txt', $data . PHP_EOL, FILE_APPEND);
$json = json_decode($data, true);
if(isset($json['Body']['stkCallback']['ResultCode']) && $json['Body']['stkCallback']['ResultCode']==0){
 // Hapa ndio uta-update balance ya user DB
}
echo "OK";
?>
