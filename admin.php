<!DOCTYPE html>

<html><head><meta name="viewport" content="width=device-width,initial-scale=1"><title>ADMIN</title><style>body{margin:0;font-family:Arial;background:#000;color:#fff;padding:10px}.top{background:#00ff00;color:#000;padding:12px;text-align:center;font-weight:bold}.box{background:#111;padding:15px;border-radius:10px;margin-top:10px}input{width:95%;padding:12px;margin:6px 0;border-radius:6px;border:none}button{width:100%;padding:14px;background:#00ff00;border:none;border-radius:8px;font-weight:bold;margin-top:8px}table{width:100%;margin-top:15px;border-collapse:collapse}th,td{border:1px solid #333;padding:8px;font-size:13px;text-align:left}th{background:#00ff00;color:#000}</style></head><body>

<div class="top">BET2026 ADMIN - PROFIT KES <span id="profit">300</span></div>

<div class="box">

<input id="jina" placeholder="Jina au Namba ya mteja - mf 0712...">

<input id="bet" placeholder="Bet - mf Barca 1 @2.20">

<input id="kiasi" placeholder="Kiasi - mf 100" type="number">

<button onclick="ongeza()">ONGEZA BET</button>

<button onclick="localStorage.clear();location.reload()" style="background:#ff4444;color:#fff;margin-top:5px">FUTA ZOTE</button>

<table id="tbl"><tr><th>Jina</th><th>Bet</th><th>Kiasi</th></tr></table>

<div style="margin-top:15px">Imeingia: <span id="ingia">500</span> | Kulipa: <span id="kulipa">200</span></div>

</div>

<script>

let ingia=500; let kulipa=200;

function load(){let data=JSON.parse(localStorage.getItem('bets')||'[]');let tbl=document.getElementById('tbl');tbl.innerHTML='<tr><th>Jina</th><th>Bet</th><th>Kiasi</th></tr>';data.forEach(b=>{tbl.innerHTML+=`<tr><td>${b.jina}</td><td>${b.bet}</td><td>${b.kiasi}</td></tr>`});}

function ongeza(){

let j=document.getElementById('jina').value;

let b=document.getElementById('bet').value;

let k=document.getElementById('kiasi').value;

if(!j||!b||!k){alert('Jaza zote!');return;}

let data=JSON.parse(localStorage.getItem('bets')||'[]');

data.push({jina:j,bet:b,kiasi:k});

localStorage.setItem('bets',JSON.stringify(data));

ingia+=parseInt(k); document.getElementById('ingia').innerText=ingia; document.getElementById('profit').innerText=ingia-kulipa;

document.getElementById('jina').value='';document.getElementById('bet').value='';document.getElementById('kiasi').value='';

load(); alert('Bet imeongezwa! Sasa inabonyezeka!');

}

load();

</script></body></html>