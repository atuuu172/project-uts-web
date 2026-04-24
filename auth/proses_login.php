<?php
session_start();
include '../config/koneksi.php';

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

if($username == '' || $password == ''){
    echo "<script>alert('Isi semua dulu!');window.location='login.php';</script>";
    exit;
}

$query = mysqli_query($conn, "SELECT * FROM admin WHERE username='$username' AND password='$password'");

if(mysqli_num_rows($query) > 0){
    $_SESSION['login'] = true;
    $_SESSION['username'] = $username;

    header("Location: ../admin/dashboard.php");
    exit;
}else{
    echo "<script>alert('Login gagal!');window.location='login.php';</script>";
}
?>