<?php
$raw = file_get_contents('php://input');
file_put_contents('mpesa_logs.txt', date('Y-m-d H:i:s')." - $raw\n", FILE_APPEND);
echo "OK";
?>
