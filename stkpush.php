<?php
header('Content-Type: text/plain');
$data = json_decode(file_get_contents('php://input'),true);
$phone = $data['phone'] ?? '';
$amount = $data['amount'] ?? 0;
$bets = $data['bets'] ?? [];

$log = date('Y-m-d H:i:s')." | $phone | KES $amount | ".implode(',',$bets)."\n";
file_put_contents('bets.txt',$log,FILE_APPEND);

// TODO: Hapa tunaweka Daraja API yako baadaye
echo "✅ STK Push imetumwa kwa $phone - KES $amount\n\nIngiza PIN yako ya M-Pesa kwa simu kukamilisha bet yako!\n\nBets: ".implode(', ',$bets);
?>
