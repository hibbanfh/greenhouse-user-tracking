<?php
include "config.php";

if(isset($_POST["id_ver"])) {
     $query = $db->query("SELECT m.id_verifikasi, u.nama_lengkap, m.kode_rfid, l.waktu_masuk, SEC_TO_TIME(TIME_TO_SEC(l.waktu_keluar) - TIME_TO_SEC(l.waktu_masuk)) AS durasi FROM manajerial m INNER JOIN user u ON m.id_user = u.id_user INNER JOIN log_akses l ON m.id_verifikasi = l.id_verifikasi WHERE l.id_verifikasi ='".$_POST["id_ver"]."'");
     $baris = $query->fetch_assoc();
     echo json_encode($baris);
}
?>
