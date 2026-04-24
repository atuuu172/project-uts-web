<?php
session_start();
if(!isset($_SESSION['login'])){
    header("Location: ../auth/login.php");
    exit;
}

include '../config/koneksi.php';

// TAMBAH DATA
if(isset($_POST['tambah'])){
    $nama = $_POST['nama'];
    $hp   = $_POST['hp'];
    $kamar = $_POST['kamar'];

    mysqli_query($conn, "INSERT INTO penghuni (nama,no_hp,id_kamar) VALUES ('$nama','$hp','$kamar')");
}

// HAPUS DATA
if(isset($_GET['hapus'])){
    $id = $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM penghuni WHERE id_penghuni=$id");
}

// QUERY DATA (FIX ERROR)
$data = mysqli_query($conn, "
SELECT penghuni.*, kamar.nomor_kamar, kamar.status
FROM penghuni
LEFT JOIN kamar ON penghuni.id_kamar = kamar.id_kamar
");

if(!$data){
    die("Query Error: " . mysqli_error($conn));
}

// AMBIL DATA KAMAR UNTUK DROPDOWN
$kamar = mysqli_query($conn, "SELECT * FROM kamar");
?>

<!DOCTYPE html>
<html>
<head>
<title>Data Penghuni</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">

<style>
body{
    font-family:Poppins;
    background: linear-gradient(135deg,#0f2027,#203a43,#2c5364);
    color:white;
    margin:0;
}

.navbar{
    display:flex;
    justify-content:space-between;
    padding:20px 50px;
    background:black;
}

.navbar a{
    color:white;
    margin-left:20px;
    text-decoration:none;
}

.container{
    padding:40px;
}

h1{
    margin-bottom:20px;
}

.form{
    display:flex;
    gap:10px;
    margin-bottom:30px;
}

input,select{
    padding:12px;
    border-radius:10px;
    border:none;
    width:200px;
}

button{
    background:#FFD700;
    border:none;
    padding:12px 20px;
    border-radius:10px;
    font-weight:bold;
    cursor:pointer;
}

table{
    width:100%;
    border-collapse:collapse;
    background:rgba(255,255,255,0.05);
    border-radius:10px;
    overflow:hidden;
}

th,td{
    padding:15px;
    text-align:center;
}

th{
    background:rgba(255,255,255,0.1);
}

tr:nth-child(even){
    background:rgba(255,255,255,0.05);
}

.hapus{
    color:red;
    text-decoration:none;
    font-weight:bold;
}
</style>
</head>

<body>

<div class="navbar">
    <div>🏠 Kost Mawar Mulia</div>
    <div>
        <a href="dashboard.php">Dashboard</a>
        <a href="kamar.php">Kamar</a>
        <a href="penghuni.php">Penghuni</a>
        <a href="../auth/logout.php">Logout</a>
    </div>
</div>

<div class="container">
<h1>👤 Data Penghuni</h1>

<form method="POST" class="form">
    <input type="text" name="nama" placeholder="Nama" required>
    <input type="text" name="hp" placeholder="No HP" required>

    <select name="kamar" required>
        <option value="">Pilih Kamar</option>
        <?php while($k = mysqli_fetch_assoc($kamar)){ ?>
            <option value="<?= $k['id_kamar'] ?>">
                Kamar <?= $k['nomor_kamar'] ?>
            </option>
        <?php } ?>
    </select>

    <button name="tambah">+ Tambah</button>
</form>

<table>
<tr>
    <th>No</th>
    <th>Nama</th>
    <th>No HP</th>
    <th>Kamar</th>
    <th>Status</th>
    <th>Aksi</th>
</tr>

<?php 
$no=1;
while($d = mysqli_fetch_assoc($data)){ 
?>
<tr>
    <td><?= $no++ ?></td>
    <td><?= $d['nama'] ?></td>
    <td><?= $d['no_hp'] ?></td>
    <td><?= $d['nomor_kamar'] ?? '-' ?></td>
    <td><?= $d['status'] ?? '-' ?></td>
    <td>
        <a class="hapus" href="?hapus=<?= $d['id_penghuni'] ?>" onclick="return confirm('Hapus data?')">Hapus</a>
    </td>
</tr>
<?php } ?>

</table>

</div>

</body>
</html>