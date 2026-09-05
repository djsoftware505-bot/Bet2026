<?php
$key = getenv('MPESA_CONSUMER_KEY');
$secret = getenv('MPESA_CONSUMER_SECRET');
echo "KEY SET: ".($key ? "YES ".substr($key,0,10)."..." : "NO")."<br>";
echo "SECRET SET: ".($secret ? "YES" : "NO")."<br><br>";

$cred = base64_encode($key.":".$secret);
$ch = curl_init("https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials");
curl_setopt($ch, CURLOPT_HTTPHEADER, ["Authorization: Basic ".$cred]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$res = curl_exec($ch);
$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
echo "HTTP CODE: $code<br>";
echo "RESPONSE: $res";
?>
