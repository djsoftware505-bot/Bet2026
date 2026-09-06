<?php
echo "<h2>BET2026 Admin - Bets</h2><pre style='background:#000;color:#0f0;padding:15px'>";
if(file_exists('bets.txt')) echo file_get_contents('bets.txt'); else echo "Hakuna bets bado";
echo "</pre><h3>M-Pesa Logs</h3><pre>";
if(file_exists('mpesa_logs.txt')) echo file_get_contents('mpesa_logs.txt');
echo "</pre>";
?>
