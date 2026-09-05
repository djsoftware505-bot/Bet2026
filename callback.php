<?php
file_put_contents("log.txt", file_get_contents("php://input").PHP_EOL, FILE_APPEND);
echo json_encode(["ResultCode"=>0,"ResultDesc"=>"Success"]);
?>
