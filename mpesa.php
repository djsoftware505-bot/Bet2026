<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

$key = getenv('MPESA_CONSUMER_KEY') ?: getenv('CONSUMER_KEY');
$secret = getenv('MPESA_CONSUMER_SECRET') ?: getenv('CONSUMER_SECRET');

if(!$key || !$secret){
  echo json_encode(["error"=>"KEYS MISSING"]); exit;
}

// SANDBOX - kama uko na Production badilisha kuwa api.safaricom.co.ke
$tokenUrl = "https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials";
$stkUrl   = "https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processquery";

$cred = base64_encode($key.":".$secret);
$ch = curl_init($tokenUrl);
curl_setopt($ch, CURLOPT_HTTPHEADER, ["Authorization: Basic ".$cred]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$res = curl_exec($ch);
$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if($code != 200){
  echo json_encode(["status"=>"TOKEN_FAILED","debug"=>$res]); exit;
}

$token = json_decode($res)->access_token;
if(!$token){ echo json_encode(["status"=>"TOKEN_FAILED","debug"=>$res]); exit; }

// SANDBOX credentials
$shortCode = "174379";
$passkey = "bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919";
$timestamp = date("YmdHis");
$password = base64_encode($shortCode.$passkey.$timestamp);

$input = json_decode(file_get_contents("php://input"), true);
$phone = $input['phone'] ?? $_POST['phone'] ?? '';
$amount = $input['amount'] ?? $_POST['amount'] ?? 1;

$phone = preg_replace('/[^0-9]/','',$phone);
if(substr($phone,0,1)=="0") $phone = "254".substr($phone,1);
if(substr($phone,0,3)!="254") $phone = "254".$phone;

$payload = [
  "BusinessShortCode"=>$shortCode,
  "Password"=>$password,
  "Timestamp"=>$timestamp,
  "TransactionType"=>"CustomerPayBillOnline",
  "Amount"=>(int)$amount,
  "PartyA"=>$phone,
  "PartyB"=>$shortCode,
  "PhoneNumber"=>$phone,
  "CallBackURL"=>"https://bet2026.onrender.com/callback.php",
  "AccountReference"=>"Bet2026",
  "TransactionDesc"=>"Deposit"
];

$ch = curl_init($stkUrl);
curl_setopt($ch, CURLOPT_HTTPHEADER, ["Authorization: Bearer ".$token,"Content-Type: application/json"]);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$stkRes = curl_exec($ch);
curl_close($ch);

echo $stkRes;
?>
