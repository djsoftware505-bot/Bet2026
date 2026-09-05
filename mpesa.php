<?php
header("Content-Type: application/json");
$key = trim(getenv('MPESA_CONSUMER_KEY'));
$secret = trim(getenv('MPESA_CONSUMER_SECRET'));
if(!$key){ echo json_encode(["error"=>"NO KEYS SET"]); exit; }
$ch = curl_init("https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials");
curl_setopt($ch, CURLOPT_HTTPHEADER, ["Authorization: Basic ".base64_encode($key.":".$secret)]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$res = curl_exec($ch); $code = curl_getinfo($ch, CURLINFO_HTTP_CODE); curl_close($ch);
if($code!=200){ echo json_encode(["status"=>"TOKEN_FAILED","code"=>$code,"resp"=>$res,"key_start"=>substr($key,0,10)]); exit; }
$token = json_decode($res)->access_token;
$sc="174379"; $pk="bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919";
$ts=date("YmdHis"); $pwd=base64_encode($sc.$pk.$ts);
$body=json_decode(file_get_contents("php://input"),true);
$phone=preg_replace('/\D/','',$body['phone']??''); if(substr($phone,0,1)=="0") $phone="254".substr($phone,1);
$data=["BusinessShortCode"=>$sc,"Password"=>$pwd,"Timestamp"=>$ts,"TransactionType"=>"CustomerPayBillOnline","Amount"=>(int)($body['amount']??1),"PartyA"=>$phone,"PartyB"=>$sc,"PhoneNumber"=>$phone,"CallBackURL"=>"https://bet2026.onrender.com/callback.php","AccountReference"=>"Bet2026","TransactionDesc"=>"Deposit"];
$ch=curl_init("https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processquery");
curl_setopt($ch, CURLOPT_HTTPHEADER, ["Authorization: Bearer $token","Content-Type: application/json"]);
curl_setopt($ch, CURLOPT_POST,true); curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($data)); curl_setopt($ch, CURLOPT_RETURNTRANSFER,true); curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);
echo curl_exec($ch);
