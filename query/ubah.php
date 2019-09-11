<?php 
session_start();
require "../config.php";

if(isset($_POST['insert'])) {
    $id = $_POST['id_ver'];
    $status = $_POST['stat'];
    
    if($status == 1){
        $update = $db->query("UPDATE manajerial SET status_user = '$status', waktu_penghentian = NULL WHERE id_verifikasi = '".$id."'");
        if($update){
            header("Location: ../register.php?pesan=berhasil_diupdate");
        }
    }
    elseif($status == 0){
        $ubah = $db->query("UPDATE manajerial SET status_user = '$status', waktu_penghentian = CURRENT_TIMESTAMP WHERE id_verifikasi = '".$id."'");
        if($ubah){
            header("Location: ../register.php?pesan=berhasil_diupdate");
        }
    }
    else{
        $upd = $db->query("UPDATE manajerial SET status_user = '$status', waktu_penghentian = NULL WHERE id_verifikasi = '".$id."'");
        if($upd){
            header("Location: ../register.php?pesan=berhasil_diupdate");
        }
    }
}
?>
