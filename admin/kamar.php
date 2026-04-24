<?php
session_start();
if(!isset($_SESSION['login'])){
    header("Location: ../auth/login.php");
    exit;
}

include '../config/koneksi.php';

// ================= TAMBAH =================
if(isset($_POST['tambah'])){
    $nomor  = $_POST['nomor_kamar'];
    $harga  = $_POST['harga'];
    $status = $_POST['status'];

    mysqli_query($conn, "
    INSERT INTO kamar (nomor_kamar,harga,status)
    VALUES ('$nomor','$harga','$status')
    ");

    header("Location: kamar.php");
    exit;
}

// ================= UPDATE =================
if(isset($_POST['update'])){
    $id     = $_POST['id_kamar'];
    $nomor  = $_POST['nomor_kamar'];
    $harga  = $_POST['harga'];
    $status = $_POST['status'];

    mysqli_query($conn, "
    UPDATE kamar SET 
    nomor_kamar='$nomor',
    harga='$harga',
    status='$status'
    WHERE id_kamar='$id'
    ");

    header("Location: kamar.php");
    exit;
}

// ================= HAPUS =================
if(isset($_GET['hapus'])){
    $id = $_GET['hapus'];

    mysqli_query($conn,"DELETE FROM kamar WHERE id_kamar='$id'");

    header("Location: kamar.php");
    exit;
}

// ================= DATA =================
$data = mysqli_query($conn,"SELECT * FROM kamar ORDER BY id_kamar DESC");
?>

<!DOCTYPE html>
<html>
<head>
<title>Data Kamar</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">

<style>
body{
    font-family:Poppins;
    margin:0;
    background:linear-gradient(135deg,#0f2027,#203a43,#2c5364);
    color:white;
}

.nav{
    display:flex;
    justify-content:space-between;
    padding:20px 40px;
    background:black;
}

.nav a{
    color:white;
    margin-left:20px;
    text-decoration:none;
}

.container{padding:40px}

.form{
    display:flex;
    gap:10px;
    margin-bottom:20px;
}

input,select{
    padding:10px;
    border-radius:10px;
    border:none;
}

.btn{
    background:#FFD700;
    padding:10px 15px;
    border:none;
    border-radius:10px;
    font-weight:bold;
    cursor:pointer;
}

/* TABLE */
table{
    width:100%;
    border-collapse:collapse;
    background:rgba(255,255,255,0.05);
    border-radius:10px;
}

th,td{
    padding:12px;
    text-align:center;
}

th{
    background:rgba(255,255,255,0.1);
}
</style>
</head>

<body>

<div class="nav">
    <div>🏠 Kost Mawar Mulia</div>
    <div>
        <a href="dashboard.php">Dashboard</a>
        <a href="kamar.php">Kamar</a>
        <a href="penghuni.php">Penghuni</a>
    </div>
</div>

<div class="container">

<h2>🏠 Data Kamar</h2>

<!-- TAMBAH -->
<form method="POST" class="form">
    <input name="nomor_kamar" placeholder="Nomor Kamar" required>
    <input name="harga" type="number" placeholder="Harga" required>

    <select name="status">
        <option>Kosong</option>
        <option>Terisi</option>
    </select>

    <button name="tambah" class="btn">+ Tambah</button>
</form>

<table>
<tr>
    <th>No</th>
    <th>Nomor</th>
    <th>Harga</th>
    <th>Status</th>
    <th>Aksi</th>
</tr>

<?php $no=1; while($d=mysqli_fetch_assoc($data)){ ?>
<tr>
<form method="POST">

<td><?= $no++ ?></td>

<td>
<input type="hidden" name="id_kamar" value="<?= $d['id_kamar'] ?>">
<input name="nomor_kamar" value="<?= $d['nomor_kamar'] ?>">
</td>

<td>
<input name="harga" value="<?= $d['harga'] ?>">
</td>

<td>
<select name="status">
<option <?= $d['status']=='Kosong'?'selected':'' ?>>Kosong</option>
<option <?= $d['status']=='Terisi'?'selected':'' ?>>Terisi</option>
</select>
</td>

<td>
<button name="update" class="btn">Update</button>
<a href="?hapus=<?= $d['id_kamar'] ?>" style="color:red;" onclick="return confirm('Hapus kamar ini?')">Hapus</a>
</td>

</form>
</tr>
<?php } ?>

</table>

</div>

</body>
</html>