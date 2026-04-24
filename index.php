<?php
include 'config/koneksi.php';

// LOGIC ASLI (JANGAN DIUBAH)
function pintu($nomor){
    return ($nomor <= 5) ? "Pintu 7" : "Pintu 8";
}

function km_dalam($nomor){
    return in_array($nomor,[2,5,6]);
}

function fasilitas_pintu($pintu){
    if($pintu == "Pintu 7"){
        return ["KM Luar (1)","Tempat Cuci","Jemuran","Dapur","Kasur","Lemari","Listrik","Air"];
    } else {
        return ["KM Luar (3)","Tempat Cuci","Jemuran","Dapur","Kasur","Lemari","Wastafel","Listrik","Air"];
    }
}

// GAMBAR FALLBACK (PASTI ADA)
$gambar = [
"https://images.unsplash.com/photo-1560448204-e02f11c3d0e2",
"https://images.unsplash.com/photo-1616594039964-ae9021a400a0",
"https://images.unsplash.com/photo-1505691938895-1758d7feb511",
"https://images.unsplash.com/photo-1582582429416-0a58b1f4a6a7",
"https://images.unsplash.com/photo-1615873968403-89e068629265",
"https://images.unsplash.com/photo-1598928506311-c55ded91a20c",
"https://images.unsplash.com/photo-1600585154340-be6161a56a0c"
];

// WA AUTO MESSAGE
$pesan = urlencode("Permisi, ini dengan Kost Putri Mawar Mulia No 7-8, saya ingin tanya kamar yang tersedia.");
?>

<!DOCTYPE html>
<html>
<head>
<title>Kost Putri Mawar Mulia No 7-8</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:Poppins}

body{
background:#f8fafc;
color:#1e293b;
}

/* NAV */
.nav{
position:fixed;
top:0;
width:100%;
display:flex;
justify-content:space-between;
padding:20px 40px;
background:white;
box-shadow:0 4px 20px rgba(0,0,0,0.08);
z-index:100;
}

.nav b{font-size:18px;}

.nav a{
margin-left:20px;
text-decoration:none;
color:#555;
}

/* HERO */
.hero{
height:100vh;
background:
linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)),
url('https://images.unsplash.com/photo-1505691938895-1758d7feb511');
background-size:cover;
display:flex;
align-items:center;
justify-content:center;
flex-direction:column;
color:white;
text-align:center;
}

.hero h1{
font-size:48px;
}

.hero p{
margin-top:10px;
opacity:0.9;
}

.hero a{
margin-top:20px;
padding:12px 25px;
background:#facc15;
color:black;
border-radius:10px;
text-decoration:none;
font-weight:bold;
}

/* SECTION */
.section{
padding:100px 40px;
max-width:1200px;
margin:auto;
}

.title{
font-size:28px;
margin-bottom:30px;
}

/* GRID */
.grid{
display:grid;
grid-template-columns:repeat(auto-fit,minmax(260px,1fr));
gap:25px;
}

/* CARD */
.card{
background:white;
border-radius:20px;
overflow:hidden;
box-shadow:0 10px 30px rgba(0,0,0,0.1);
transition:0.3s;
opacity:0;
transform:translateY(40px);
}

.card.show{
opacity:1;
transform:translateY(0);
}

.card:hover{
transform:translateY(-10px);
}

.card img{
width:100%;
height:200px;
object-fit:cover;
transition:0.3s;
}

.card:hover img{
transform:scale(1.1);
}

.card-body{
padding:15px;
}

.price{
color:#f59e0b;
font-weight:bold;
}

.badge{
background:#facc15;
padding:5px 10px;
border-radius:6px;
font-size:12px;
display:inline-block;
margin-bottom:5px;
}

.kosong{color:green;}
.terisi{color:red;}

ul{
font-size:13px;
margin-top:10px;
padding-left:15px;
}

/* BOX */
.box{
background:white;
padding:25px;
border-radius:15px;
box-shadow:0 5px 20px rgba(0,0,0,0.08);
margin-bottom:20px;
}

/* MAP */
.map iframe{
width:100%;
height:350px;
border:none;
border-radius:15px;
}

/* WA */
.wa{
position:fixed;
bottom:20px;
right:20px;
background:#25D366;
padding:18px;
border-radius:50%;
color:white;
font-size:20px;
text-decoration:none;
}

/* FOOTER */
footer{
text-align:center;
padding:40px;
font-size:14px;
color:#777;
background:#f1f5f9;
}

/* MOBILE */
@media(max-width:768px){
.section{padding:70px 20px}
.hero h1{font-size:30px}
}
</style>
</head>

<body>

<div class="nav">
<b>🏠 Kost Putri Mawar Mulia</b>
<div>
<a href="#p7">Pintu 7</a>
<a href="#p8">Pintu 8</a>
<a href="#info">Info</a>
<a href="#lokasi">Lokasi</a>
</div>
</div>

<div class="hero">
<h1>Kost Putri Mawar Mulia No 7-8</h1>
<p>Hunian nyaman • strategis • aman</p>
<a href="#p7">Lihat Kamar</a>
</div>

<!-- PINTU 7 -->
<div class="section" id="p7">
<h2 class="title">Pintu 7</h2>
<div class="grid">

<?php
$data=mysqli_query($conn,"SELECT * FROM kamar");
while($d=mysqli_fetch_array($data)){
$nomor=(int)filter_var($d['nomor_kamar'],FILTER_SANITIZE_NUMBER_INT);

if($nomor<=5){
$fasilitas=fasilitas_pintu("Pintu 7");

$img = (!empty($d['foto']) && file_exists('upload/'.$d['foto']))
? 'upload/'.$d['foto']
: $gambar[array_rand($gambar)];
?>

<div class="card">
<img src="<?= $img ?>">
<div class="card-body">

<h3><?= $d['nomor_kamar'] ?></h3>

<?php if(km_dalam($nomor)){ ?>
<span class="badge">KM Dalam</span>
<?php } ?>

<p class="price">Rp<?= number_format($d['harga']) ?></p>

<p class="<?= $d['status']=='Kosong'?'kosong':'terisi' ?>">
<?= $d['status'] ?>
</p>

<ul>
<?php foreach($fasilitas as $f){ ?>
<li><?= $f ?></li>
<?php } ?>
</ul>

</div>
</div>

<?php }} ?>

</div>
</div>

<!-- PINTU 8 -->
<div class="section" id="p8">
<h2 class="title">Pintu 8</h2>
<div class="grid">

<?php
$data=mysqli_query($conn,"SELECT * FROM kamar");
while($d=mysqli_fetch_array($data)){
$nomor=(int)filter_var($d['nomor_kamar'],FILTER_SANITIZE_NUMBER_INT);

if($nomor>5){
$fasilitas=fasilitas_pintu("Pintu 8");

// ambil nomor kamar
$nomor = (int) filter_var($d['nomor_kamar'], FILTER_SANITIZE_NUMBER_INT);

// KHUSUS KAMAR 9
if($nomor == 9){
    $img = "https://images.unsplash.com/photo-1616594039964-ae9021a400a0";
}else{
    $img = (!empty($d['foto']) && file_exists('upload/'.$d['foto']))
    ? 'upload/'.$d['foto']
    : $gambar[array_rand($gambar)];
}
?>

<div class="card">
<img src="<?= $img ?>">
<div class="card-body">

<h3><?= $d['nomor_kamar'] ?></h3>

<?php if(km_dalam($nomor)){ ?>
<span class="badge">KM Dalam</span>
<?php } ?>

<p class="price">Rp<?= number_format($d['harga']) ?></p>

<p class="<?= $d['status']=='Kosong'?'kosong':'terisi' ?>">
<?= $d['status'] ?>
</p>

<ul>
<?php foreach($fasilitas as $f){ ?>
<li><?= $f ?></li>
<?php } ?>
</ul>

</div>
</div>

<?php }} ?>

</div>
</div>

<!-- INFO -->
<div class="section" id="info">
<h2 class="title">Informasi Kost</h2>

<div class="box">
<h3>Alamat</h3>
<p>Jl. Mawar Menteng, Gg. H. Dahlan RT.002 RW.005, Kota Bogor Barat</p>
</div>

<div class="box">
<h3>Kontak</h3>
<a href="https://wa.me/6285720681930?text=<?= $pesan ?>">Chat WhatsApp</a>
</div>

</div>

<!-- MAP -->
<div class="section" id="lokasi">
<h2 class="title">Lokasi</h2>
<div class="map">
<iframe src="https://www.google.com/maps?q=-6.589077,106.787180&output=embed"></iframe>
</div>
</div>

<!-- FOOTER -->
<footer>
© 2026 Kost Putri Mawar Mulia — Crafted with ❤️ by <b>Ratu Agne Panggarena</b>
</footer>

<a href="https://wa.me/6285720681930?text=<?= $pesan ?>" class="wa">💬</a>

<script>
const cards = document.querySelectorAll('.card');
window.addEventListener('scroll',()=>{
cards.forEach(card=>{
if(card.getBoundingClientRect().top < window.innerHeight-100){
card.classList.add('show');
}
});
});
</script>

</body>
</html>