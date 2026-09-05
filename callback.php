<?php
$data=file_get_contents('php://input');
file_put_contents('mpesa_logs.txt',$data.PHP_EOL,FILE_APPEND);
echo '{"ResultCode":0,"ResultDesc":"Accepted"}';
