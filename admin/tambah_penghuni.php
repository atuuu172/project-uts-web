<?php
include '../config/koneksi.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Tambah Penghuni</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins', sans-serif;
}

body{
    display:flex;
    background:#0f172a;
    color:white;
}

/* SIDEBAR */
.sidebar{
    width:230px;
    height:100vh;
    background:#020617;
    padding:20px;
    border-right:1px solid rgba(255,255,255,0.1);
}

.sidebar h2{
    color:gold;
    margin-bottom:30px;
}

.sidebar a{
    display:block;
    padding:12px;
    margin:10px 0;
    color:#ccc;
    text-decoration:none;
    border-radius:10px;
    transition:0.3s;
}

.sidebar a:hover, .active{
    background:gold;
    color:black;
}

/* MAIN */
.main{
    flex:1;
    padding:40px;
}

/* CARD */
.card{
    background:#020617;
    padding:30px;
    border-radius:20px;
    box-shadow:0 0 30px rgba(255,215,0,0.1);
}

/* TITLE */
.title{
    font-size:28px;
    margin-bottom:20px;
}

.title span{
    color:gold;
}

/* INPUT */
.input-group{
    margin:15px 0;
}

.input-group label{
    display:block;
    margin-bottom:5px;
}

.input-group input{
    width:100%;
    padding:12px;
    border:none;
    border-radius:10px;
    background:#1e293b;
    color:white;
}

/* BUTTON */
.btn{
    padding:12px 20px;
    border:none;
    border-radius:10px;
    font-weight:bold;
    cursor:pointer;
}

.btn-save{
    background:linear-gradient(45deg,gold,orange);
    color:black;
}

.btn-cancel{
    background:#334155;
    color:white;
    margin-right:10px;
}

.btn:hover{
    transform:scale(1.05);
}

.button-group{
    margin-top:20px;
}
</style>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <h2>Kost Mawar</h2>
    <a href="dashboard.php">Dashboard</a>
    <a href="kamar.php">Kamar</a>
    <a href="tambah_kamar.php">Tambah Kamar</a>
    <a href="penghuni.php" class="active">Penghuni</a>
</div>

<!-- MAIN -->
<div class="main">

    <div class="title">Tambah <span>Penghuni</span></div>

    <div class="card">
        <form method="POST">

            <div class="input-group">
                <label>Nama</label>
                <input type="text" name="nama" required>
            </div>

            <div class="input-group">
                <label>No HP</label>
                <input type="text" name="hp" required>
            </div>

            <div class="input-group">
                <label>Nomor Kamar</label>
                <input type="text" name="kamar" required>
            </div>

            <div class="button-group">
                <button type="submit" name="simpan" class="btn btn-save">Simpan</button>
                <a href="penghuni.php" class="btn btn-cancel">Batal</a>
            </div>

        </form>

        <?php
        if(isset($_POST['simpan'])){
            $nama = $_POST['nama'];
            $hp = $_POST['hp'];
            $kamar = $_POST['kamar'];

            mysqli_query($conn, "INSERT INTO penghuni VALUES('', '$nama','$hp','$kamar')");

            echo "<script>alert('Berhasil ditambahkan!');window.location='penghuni.php';</script>";
        }
        ?>
    </div>

</div>

</body>
</html>