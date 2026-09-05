<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Bet2026</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white">
<div class="bg-green-600 p-3 flex justify-between">
<h1 class="font-bold text-xl">⚽ BET2026</h1>
<span class="bg-white text-green-600 px-3 py-1 rounded font-bold">KES 0</span>
</div>
<div class="p-4">
<div class="bg-gray-800 p-4 rounded mb-4">
<h2 class="font-bold mb-2">Deposit M-Pesa</h2>
<input id="phone" placeholder="0712345678" class="w-full p-3 rounded text-black mb-2">
<input id="amount" type="number" placeholder="100" class="w-full p-3 rounded text-black mb-2">
<button onclick="deposit()" class="w-full bg-green-500 p-3 rounded font-bold">DEPOSIT NOW</button>
<p id="msg" class="mt-2 text-yellow-300"></p>
</div>
<div class="space-y-2">
<div class="bg-gray-800 p-3 rounded flex justify-between"><span>Arsenal vs Man City</span><button class="bg-green-600 px-3 rounded">1.85</button></div>
<div class="bg-gray-800 p-3 rounded flex justify-between"><span>Real vs Barca</span><button class="bg-green-600 px-3 rounded">2.10</button></div>
</div>
</div>
<script>
function deposit(){
let p=document.getElementById('phone').value;
let a=document.getElementById('amount').value;
document.getElementById('msg').innerText="Inatuma STK...";
fetch('stkpush.php?phone='+p+'&amount='+a).then(r=>r.text()).then(d=>{document.getElementById('msg').innerText=d; alert(d);});
}
</script>
</body>
</html>
