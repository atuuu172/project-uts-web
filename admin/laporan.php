<?php
session_start();
if(!isset($_SESSION['login'])){
    header("Location: ../auth/login.php");
    exit;
}

include '../config/koneksi.php';

// DATA
$total = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) as total FROM kamar"))['total'];
$kosong = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) as kosong FROM kamar WHERE status='Kosong'"))['kosong'];
$terisi = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) as isi FROM kamar WHERE status='Terisi'"))['isi'];
$penghuni = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) as total FROM penghuni"))['total'];

$pemasukan = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT SUM(harga) as total FROM kamar WHERE status='Terisi'
"))['total'] ?? 0;

$persen = ($total > 0) ? round(($terisi/$total)*100) : 0;
?>

<!DOCTYPE html>
<html>
<head>
<title>Laporan Kost</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
body{
    margin:0;
    font-family:Poppins;
    color:white;
    background: radial-gradient(circle at top, #1a1a1a, #000);
}

/* NAVBAR */
.navbar{
    display:flex;
    justify-content:space-between;
    padding:20px 50px;
    background:#000;
    border-bottom:1px solid rgba(255,215,0,0.2);
}
.navbar a{color:white; margin-left:20px; text-decoration:none;}

/* TITLE */
.title{text-align:center; padding:40px;}
.gold{
    background: linear-gradient(90deg,#FFD700,#FFA500);
    -webkit-background-clip:text;
    -webkit-text-fill-color:transparent;
}

/* CARDS */
.cards{
    display:flex;
    gap:20px;
    padding:30px;
    flex-wrap:wrap;
}
.card{
    flex:1;
    min-width:200px;
    padding:25px;
    border-radius:20px;
    text-align:center;
    background:rgba(255,255,255,0.05);
    backdrop-filter:blur(10px);
    border:1px solid rgba(255,215,0,0.2);
    transition:0.3s;
}
.card:hover{
    transform:translateY(-8px);
    box-shadow:0 0 25px rgba(255,215,0,0.4);
}
.card h2{color:#FFD700}

/* GRID */
.grid{
    display:flex;
    gap:20px;
    padding:30px;
    flex-wrap:wrap;
}
.box{
    flex:1;
    min-width:300px;
    padding:20px;
    border-radius:20px;
    background:rgba(255,255,255,0.05);
    backdrop-filter:blur(10px);
    border:1px solid rgba(255,215,0,0.2);
}

/* PROGRESS */
.progress{
    height:20px;
    background:#222;
    border-radius:20px;
    overflow:hidden;
}
.bar{
    height:100%;
    background:linear-gradient(90deg,#FFD700,#FFA500);
    width:<?= $persen ?>%;
    text-align:center;
    color:black;
    font-size:12px;
}

/* BUTTON */
.btn{
    display:inline-block;
    margin-top:15px;
    padding:12px 20px;
    background:linear-gradient(90deg,#FFD700,#FFA500);
    color:black;
    font-weight:bold;
    border-radius:10px;
    text-decoration:none;
}
</style>
</head>

<body>

<div class="navbar">
    <div>📊 Laporan Kost</div>
    <div>
        <a href="dashboard.php">Dashboard</a>
        <a href="kamar.php">Kamar</a>
        <a href="penghuni.php">Penghuni</a>
    </div>
</div>

<div class="title">
    <h1 class="gold">📊 Statistik Kost</h1>
    <p><?= date('d F Y') ?></p>
    <div id="jam"></div>
</div>

<div class="cards">
    <div class="card"><h2><?= $total ?></h2><p>Total Kamar</p></div>
    <div class="card"><h2><?= $kosong ?></h2><p>Kosong</p></div>
    <div class="card"><h2><?= $terisi ?></h2><p>Terisi</p></div>
    <div class="card"><h2><?= $penghuni ?></h2><p>Penghuni</p></div>
    <div class="card"><h2>Rp <?= number_format($pemasukan,0,',','.') ?></h2><p>Pemasukan</p></div>
</div>

<div class="grid">

    <div class="box">
        <h3>📊 Grafik</h3>
        <div style="max-width:300px;margin:auto;">
            <canvas id="chart"></canvas>
        </div>
    </div>

    <div class="box">
        <h3>📈 Tingkat Hunian</h3>
        <p><?= $persen ?>%</p>
        <div class="progress">
            <div class="bar"><?= $persen ?>%</div>
        </div>

        <a href="#" onclick="window.print()" class="btn">🖨️ Print</a>
        <a href="export_excel.php" class="btn">📥 Excel</a>
    </div>

</div>

<script>
new Chart(document.getElementById('chart'),{
    type:'doughnut',
    data:{
        labels:['Terisi','Kosong'],
        datasets:[{
            data:[<?= $terisi ?>,<?= $kosong ?>],
            backgroundColor:['#FFD700','#ff4d4d']
        }]
    }
});

// JAM
setInterval(()=>{
document.getElementById("jam").innerHTML=new Date().toLocaleTimeString();
},1000);
</script>

</body>
</html>