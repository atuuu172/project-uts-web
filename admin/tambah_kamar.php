<?php
include '../config/koneksi.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Tambah Kamar</title>
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

.input-group input,
.input-group select{
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

/* FLEX BUTTON */
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
    <a href="tambah_kamar.php" class="active">Tambah Kamar</a>
    <a href="penghuni.php">Penghuni</a>
</div>

<!-- MAIN -->
<div class="main">

    <div class="title">Tambah <span>Kamar</span></div>

    <div class="card">
        <form method="POST" action="">

            <div class="input-group">
                <label>Nomor Kamar</label>
                <input type="text" name="nomor" required>
            </div>

            <div class="input-group">
                <label>Harga</label>
                <input type="number" name="harga" required>
            </div>

            <div class="input-group">
                <label>Status</label>
                <select name="status">
                    <option value="Kosong">Kosong</option>
                    <option value="Terisi">Terisi</option>
                </select>
            </div>

            <div class="button-group">
                <button type="submit" name="simpan" class="btn btn-save">Simpan</button>
                <a href="kamar.php" class="btn btn-cancel">Batal</a>
            </div>

        </form>

        <?php
        if(isset($_POST['simpan'])){
            $nomor = $_POST['nomor'];
            $harga = $_POST['harga'];
            $status = $_POST['status'];

            mysqli_query($conn,"INSERT INTO kamar VALUES('', '$nomor','$harga','$status')");

            echo "<script>alert('Berhasil ditambahkan!');window.location='kamar.php';</script>";
        }
        ?>
    </div>

</div>

</body>
</html>