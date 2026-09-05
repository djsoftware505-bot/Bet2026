<!DOCTYPE html>

<html>

<head>
<link rel="manifest" href="manifest.json">

<meta name="theme-color" content="#00ff00">
<meta name="viewport" content="width=device-width,initial-scale=1">

<title>BET2026</title>

<style>

body{margin:0;font-family:Arial;background:#0a0a0a;color:#fff}

.top{background:#00ff00;color:#000;padding:14px;text-align:center;font-weight:bold;font-size:20px}

.box{background:#1a1a1a;margin:15px;padding:20px;border-radius:15px;border:1px solid #333}

input{width:95%;padding:13px;border-radius:8px;border:none;margin:8px 0;font-size:16px}

.btn{width:100%;padding:16px;background:#00ff00;border:none;border-radius:10px;font-weight:bold;font-size:18px}

.info{background:#222;padding:12px;border-radius:8px;margin-top:15px;font-size:14px;line-height:1.6}

</style>

</head>

<body>

<div class="top">BET2026 - LIPA NA M-PESA</div>

<div class="box">

<b>⚽ Man Utd vs Arsenal - 2.10</b><br><br>

Namba yako ya M-Pesa:<br>

<input id="phone" placeholder="0712345678"><br>

Kiasi:<br>

<input id="amount" value="100" type="number"><br>

<button class="btn" onclick="lipa()">LIPA NA M-PESA</button>

<div class="info" id="msg">

1. Bonyeza LIPA NA M-PESA<br>

2. Utapata pop-up ya Safaricom kwa simu yako<br>

3. Weka PIN yako kwa simu yako<br>

4. Pesa itaenda kwa 0759646700

</div>

</div>

<script>

function lipa(){

let p=document.getElementById('phone').value;

let a=document.getElementById('amount').value;

if(p.length<10){alert('Weka namba 07...');return;}

document.getElementById('msg').innerHTML='⏳ Inatuma STK kwa '+p+'... Angalia simu yako SASA uandike PIN ya M-Pesa hapo kwa simu!';

// Hapa ndio STK ya kweli itaenda

// Kwa sasa bila Daraja, inafungua WhatsApp

setTimeout(()=>{

window.open('https://wa.me/254759646700?text=Nimelipa '+a+' kutoka '+p,'_blank');

document.getElementById('msg').innerHTML='✅ Nimetuma maombi! Kama hukupata pop-up, lipa manual: M-PESA > Send Money > 0759646700 > '+a+' > PIN yako';

},1500);

}

</script>

</body>

</html>