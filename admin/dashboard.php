<?php
session_start();
if(!isset($_SESSION['login'])){
    header("Location: ../auth/login.php");
    exit;
}

include '../config/koneksi.php';

// ================= DATA =================
$total = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) as total FROM kamar"))['total'];
$kosong = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) as kosong FROM kamar WHERE status='Kosong'"))['kosong'];
$terisi = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) as isi FROM kamar WHERE status='Terisi'"))['isi'];

$persen = ($total > 0) ? round(($terisi/$total)*100) : 0;

// pemasukan (dari kamar terisi)
$pemasukan = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT SUM(harga) as total FROM kamar WHERE status='Terisi'
"))['total'] ?? 0;
?>

<!DOCTYPE html>
<html>
<head>
<title>Dashboard</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
:root{
    --gold:#FFD700;
    --gold2:#FFC107;
}

body{
    font-family:Poppins;
    margin:0;
    color:white;
    background: radial-gradient(circle at top, #1a1a1a, #000);
}

/* NAVBAR */
.navbar{
    display:flex;
    justify-content:space-between;
    padding:20px 50px;
    background:linear-gradient(90deg,#000,#111);
    border-bottom:1px solid rgba(255,215,0,0.2);
}

.navbar a{
    color:white;
    margin-left:20px;
    text-decoration:none;
}

/* HERO */
.hero{
    text-align:center;
    padding:60px;
}

.hero h1{
    font-size:40px;
    background: linear-gradient(90deg,#FFD700,#FFA500);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

/* ALERT */
.alert{
    margin:20px 40px;
    padding:15px;
    background:#ff4d4d;
    border-radius:10px;
    text-align:center;
    font-weight:bold;
}

/* CARD */
.cards{
    display:flex;
    gap:20px;
    padding:40px;
    flex-wrap:wrap;
}

.card{
    flex:1;
    min-width:200px;
    padding:30px;
    border-radius:20px;
    background:rgba(255,255,255,0.05);
    backdrop-filter:blur(15px);
    border:1px solid rgba(255,215,0,0.2);
    text-align:center;
    transition:0.3s;
}

.card:hover{
    transform:translateY(-10px);
    box-shadow:0 0 25px rgba(255,215,0,0.4);
}

.card h2{
    font-size:30px;
    color:var(--gold);
}

.card p{
    opacity:0.7;
}

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
    background:rgba(255,255,255,0.05);
    border-radius:20px;
    padding:20px;
    backdrop-filter:blur(10px);
    border:1px solid rgba(255,215,0,0.2);
}

/* PROGRESS */
.progress{
    height:20px;
    background:#222;
    border-radius:20px;
    overflow:hidden;
    margin-top:10px;
}

.progress-bar{
    height:100%;
    background:linear-gradient(90deg,#FFD700,#FFB300);
    width:<?= $persen ?>%;
    text-align:center;
    font-size:12px;
    line-height:20px;
    color:black;
    font-weight:bold;
}
</style>
</head>

<body>

<!-- NAVBAR -->
<div class="navbar">
    <div>🏠 Kost Mawar Mulia</div>
    <div>
        <a href="dashboard.php">Dashboard</a>
        <a href="kamar.php">Kamar</a>
        <a href="penghuni.php">Penghuni</a>
        <a href="laporan.php">Laporan</a>
        <a href="../auth/logout.php">Logout</a>
    </div>
</div>

<!-- HERO -->
<div class="hero">
    <h1>🔥 Dashboard Admin</h1>
    <p>Kelola kost dengan sistem profesional</p>
</div>

<!-- ALERT -->
<?php if($kosong > 0){ ?>
<div class="alert">
⚠️ Ada <?= $kosong ?> kamar kosong!
</div>
<?php } ?>

<!-- CARDS -->
<div class="cards">

    <div class="card">
        <h2><?= $total ?></h2>
        <p>Total Kamar</p>
    </div>

    <div class="card">
        <h2><?= $kosong ?></h2>
        <p>Kamar Kosong</p>
    </div>

    <div class="card">
        <h2><?= $terisi ?></h2>
        <p>Kamar Terisi</p>
    </div>

    <div class="card">
        <h2>Rp <?= number_format($pemasukan,0,',','.') ?></h2>
        <p>Total Pemasukan</p>
    </div>

</div>

<!-- GRID -->
<div class="grid">

    <div class="box">
        <h3>📊 Grafik Kamar</h3>
        <canvas id="chart"></canvas>
    </div>

    <div class="box">
        <h3>📈 Tingkat Hunian</h3>
        <p><?= $persen ?>% Terisi</p>
        <div class="progress">
            <div class="progress-bar"><?= $persen ?>%</div>
        </div>
    </div>

</div>

<!-- CHART -->
<script>
const ctx = document.getElementById('chart');

new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: ['Terisi', 'Kosong'],
        datasets: [{
            data: [<?= $terisi ?>, <?= $kosong ?>],
            backgroundColor: ['#FFD700','#ff4d4d']
        }]
    }
});
</script>

</body>
</html>