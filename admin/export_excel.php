<?php
include '../config/koneksi.php';

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=laporan_kost.xls");

$data = mysqli_query($conn,"
SELECT penghuni.nama, penghuni.no_hp, kamar.nomor_kamar, kamar.status, kamar.harga
FROM penghuni
LEFT JOIN kamar ON penghuni.id_kamar = kamar.id_kamar
");

$total=0;
?>

<h2>LAPORAN KOST MAWAR MULIA</h2>
<p><?= date('d-m-Y') ?></p>

<table border="1">
<tr>
<th>No</th>
<th>Nama</th>
<th>No HP</th>
<th>Kamar</th>
<th>Status</th>
<th>Harga</th>
</tr>

<?php $no=1; while($d=mysqli_fetch_assoc($data)){ $total+=$d['harga']; ?>
<tr>
<td><?= $no++ ?></td>
<td><?= $d['nama'] ?></td>
<td><?= $d['no_hp'] ?></td>
<td><?= $d['nomor_kamar'] ?></td>
<td><?= $d['status'] ?></td>
<td>Rp <?= number_format($d['harga'],0,',','.') ?></td>
</tr>
<?php } ?>

<tr>
<td colspan="5"><b>Total</b></td>
<td><b>Rp <?= number_format($total,0,',','.') ?></b></td>
</tr>
</table>