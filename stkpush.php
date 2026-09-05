<?php
header('Content-Type: application/json');
$k = getenv('MPESA_CONSUMER_KEY')?:'mnDJrjgW7iXfRFDxBDtk9tEn2dNGxwythyGvHHBORXhccG4';
$s = getenv('MPESA_CONSUMER_SECRET')?:'d3OfEnDWZUh5nWxdRYMWIs1hGNBUDtssZ2AysCA3GpsHTcZj5ZVsmhHhLO1HBuvo';
$code = getenv('MPESA_SHORTCODE')?:'174379';
$pass = getenv('MPESA_PASSKEY')?:'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';
$phone = $_POST['phone']??'';
$amount = $_POST['amount']??10;
$phone = preg_replace('/^0/','254',$phone);
$time = date('YmdHis');
$pwd = base64_encode($code.$pass.$time);
$ch = curl_init('https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials');
curl_setopt($ch,CURLOPT_HTTPHEADER,['Authorization: Basic '.base64_encode($k.':'.$s)]);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
$tok = json_decode(curl_exec($ch))->access_token??'';
if(!$tok){echo json_encode(['error'=>'TOKEN FAILED']);exit;}
$d=['BusinessShortCode'=>$code,'Password'=>$pwd,'Timestamp'=>$time,'TransactionType'=>'CustomerPayBillOnline','Amount'=>$amount,'PartyA'=>$phone,'PartyB'=>$code,'PhoneNumber'=>$phone,'CallBackURL'=>'https://bet2026.onrender.com/callback.php','AccountReference'=>'BET2026','TransactionDesc'=>'Deposit'];
$ch2=curl_init('https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest');
curl_setopt($ch2,CURLOPT_HTTPHEADER,['Content-Type: application/json','Authorization: Bearer '.$tok]);
curl_setopt($ch2,CURLOPT_POST,1);curl_setopt($ch2,CURLOPT_POSTFIELDS,json_encode($d));curl_setopt($ch2,CURLOPT_RETURNTRANSFER,1);
echo curl_exec($ch2);
