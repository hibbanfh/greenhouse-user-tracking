<?php 
include "../config.php";

if(isset($_POST["id_ver"])) {
    $hasil = $db->query("SELECT m.id_verifikasi, u.nama_lengkap, m.kode_rfid, m.status_user FROM manajerial m INNER JOIN user u ON m.id_user = u.id_user WHERE id_verifikasi = '".$_POST["id_ver"]."'");
    $row = $hasil->fetch_assoc();
    echo json_encode($row);
}
?>
