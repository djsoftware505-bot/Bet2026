<?php
header("Content-Type: application/json");
$phone = $_GET['phone'] ?? '';
$amount = $_GET['amount'] ?? 1;

// SAFISHA NAMBA
$phone = preg_replace('/[^0-9]/','',$phone);
if(substr($phone,0,1)=='0') $phone='254'.substr($phone,1);
if(substr($phone,0,3)!='254') $phone='254'.$phone;

// ---- WEKA KEYS ZAKO HAPA ----
$consumerKey = "YOUR_CONSUMER_KEY";
$consumerSecret = "YOUR_CONSUMER_SECRET";
$BusinessShortCode = "174379"; // Sandbox paybill
$Passkey = "bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919";
$CallbackURL = "https://djsoftware505-bot.github.io/Bet2026/callback.php";
// Tumia URL ya render yako baadaye hapa
// -----------------------------

$token_url = "https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials";
$credentials = base64_encode($consumerKey.":".$consumerSecret);
$ch = curl_init($token_url);
curl_setopt($ch, CURLOPT_HTTPHEADER, ["Authorization: Basic ".$credentials]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$response = curl_exec($ch);
curl_close($ch);
$data = json_decode($response);

if(!isset($data->access_token)){
  echo "TOKEN FAILED: ". $response;
  exit;
}
$token = $data->access_token;

$timestamp = date("YmdHis");
$password = base64_encode($BusinessShortCode.$Passkey.$timestamp);

$stk_url = "https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest";
$payload = [
  "BusinessShortCode"=>$BusinessShortCode,
  "Password"=>$password,
  "Timestamp"=>$timestamp,
  "TransactionType"=>"CustomerPayBillOnline",
  "Amount"=>$amount,
  "PartyA"=>$phone,
  "PartyB"=>$BusinessShortCode,
  "PhoneNumber"=>$phone,
  "CallBackURL"=>$CallbackURL,
  "AccountReference"=>"Bet2026",
  "TransactionDesc"=>"Deposit"
];

$ch = curl_init($stk_url);
curl_setopt($ch, CURLOPT_HTTPHEADER, ["Authorization: Bearer ".$token, "Content-Type: application/json"]);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$result = curl_exec($ch);
curl_close($ch);
echo $result;
?>
