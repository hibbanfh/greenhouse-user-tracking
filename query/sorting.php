<?php
//query untuk menyortasi tabel utama berdasarkan tanggal yang dipilih
include('config.php');

$date = date("Y-m-d", strtotime($_POST['datepicker']));
$query = $db->query("SELECT u.nama_lengkap, DATE(l.waktu_masuk) as tanggal_masuk, TIME(l.waktu_masuk) as masuk, TIME(l.waktu_keluar) as waktu_keluar, SEC_TO_TIME(TIME_TO_SEC(l.waktu_keluar) - TIME_TO_SEC(l.waktu_masuk)) AS estimasi FROM log_akses l 
						INNER JOIN manajerial m ON l.id_verifikasi = m.id_verifikasi INNER JOIN user u ON m.id_user = u.id_user WHERE DATE(l.waktu_masuk) = '$date'");

if($query->num_rows > 0) {
	while($rows = $query->fetch_assoc()){ ?>
	<tr class="table-dark">
		<td colspan="4"><?php echo date('D, d m Y', strtotime($rows['tanggal_masuk'])) ?></td>
	</tr>
	<tr>
		<td><?php echo $rows['nama_lengkap']; ?></td>
		<td><?php echo $rows['masuk']; ?></td>
		<td><?php echo $rows['waktu_keluar']; ?></td>
		<td><?php echo $rows['estimasi']; ?></td>
	</tr>
<?php }
} else {
	echo '
	<tr>
		<td colspan="4"><center>Tidak Ada Aktifitas Pada Hari Ini</center></td>
	</tr>
	';
} ?>
