<?php
session_start();
$bets_file = 'bets.txt';
$balance = 1250;
?>
<!DOCTYPE html>
<html><head><title>Bet2026 Kenya</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
*{margin:0;padding:0;box-sizing:border-box}
body{font-family:Arial;background:#0a3d0a;color:#fff}
.head{background:#000;padding:12px;display:flex;justify-content:space-between;align-items:center}
.logo{color:#ffcc00;font-weight:bold;font-size:20px}
.bal{background:#ffcc00;color:#000;padding:6px 12px;border-radius:20px;font-weight:bold}
.leagues{padding:10px}
.game{background:#fff;color:#000;margin:10px 0;border-radius:10px;padding:12px}
.teams{display:flex;justify-content:space-between;font-weight:bold}
.odds{display:flex;gap:8px;margin-top:10px}
.odd{flex:1;background:#f0f0f0;text-align:center;padding:10px;border-radius:6px;cursor:pointer;border:1px solid #ddd}
.odd.selected{background:#0a3d0a;color:#fff}
.slip{position:fixed;bottom:0;left:0;right:0;background:#111;padding:15px;border-top:2px solid #ffcc00}
input{width:100%;padding:12px;margin:6px 0;border-radius:6px;border:none}
.btn{background:#00c853;color:#fff;padding:14px;width:100%;border:none;border-radius:6px;font-weight:bold;font-size:16px}
</style></head><body>
<div class="head"><div class="logo">BET2026 🇰🇪</div><div class="bal">KES <?=number_format($balance)?></div></div>
<div class="leagues">
<h3>⚽ Today Top Games</h3>
<div class="game"><div class="teams"><span>Arsenal vs Man Utd</span><span>18:00</span></div><div class="odds"><div class="odd" onclick="sel(this,'ARS-W 2.10')">1: 2.10</div><div class="odd" onclick="sel(this,'DRAW 3.20')">X: 3.20</div><div class="odd" onclick="sel(this,'MUN-W 2.90')">2: 2.90</div></div></div>
<div class="game"><div class="teams"><span>Gor Mahia vs AFC Leopards</span><span>15:00</span></div><div class="odds"><div class="odd" onclick="sel(this,'GOR 1.85')">1: 1.85</div><div class="odd" onclick="sel(this,'DRAW 3.10')">X: 3.10</div><div class="odd" onclick="sel(this,'AFC 4.20')">2: 4.20</div></div></div>
<div class="game"><div class="teams"><span>Man City vs Liverpool</span><span>19:30</span></div><div class="odds"><div class="odd" onclick="sel(this,'CITY 1.95')">1: 1.95</div><div class="odd" onclick="sel(this,'DRAW 3.40')">X: 3.40</div><div class="odd" onclick="sel(this,'LIV 3.80')">2: 3.80</div></div></div>
<div style="height:180px"></div>
</div>
<div class="slip">
<div id="sliptext" style="margin-bottom:8px;color:#ffcc00">Chagua odd kuweka bet</div>
<input type="tel" id="phone" placeholder="M-Pesa No: 254712345678" value="254">
<input type="number" id="amount" placeholder="Amount (Min 20)">
<button class="btn" onclick="bet()">WEKA BET - LIPA NA M-PESA</button>
</div>
<script>
let picks=[];
function sel(el,txt){
 el.classList.toggle('selected');
 if(picks.includes(txt)) picks=picks.filter(x=>x!=txt); else picks.push(txt);
 document.getElementById('sliptext').innerHTML=picks.length?picks.join(' | ')+' - Total Odds: '+(picks.length*2).toFixed(2):'Chagua odd kuweka bet';
}
function bet(){
 let p=document.getElementById('phone').value;
 let a=document.getElementById('amount').value;
 if(picks.length==0){alert('Chagua mechi kwanza!');return;}
 if(a<20){alert('Min 20 KES');return;}
 if(p.length<12){alert('Weka number kama 2547...');return;}
 document.querySelector('.btn').innerHTML='TUMA STK...';
 fetch('stkpush.php',{method:'POST',headers:{'Content-Type':'application/json'},body:JSON.stringify({phone:p,amount:a,bets:picks})})
 .then(r=>r.text()).then(t=>{alert(t);document.querySelector('.btn').innerHTML='WEKA BET - LIPA NA M-PESA';});
}
</script></body></html>
