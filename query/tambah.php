<?php 
session_start();
require "../config.php";

if(isset($_POST['register'])){
    $rfid = $_POST['rfid'];
    $nama = $_POST['nama_lengkap'];
    $email = $_POST['email'];
    $hp = $_POST['nomor_hp'];

    $tambah = $db->query("INSERT INTO user (id_user, nama_lengkap, email, nomor_hp, waktu_dibuat) VALUES ('', '".$nama."', '".$email."', '".$hp."', CURRENT_TIMESTAMP)");
    
    if($tambah){
        $user = $db->query("SELECT * FROM user WHERE nama_lengkap = '".$nama."' and nomor_hp = '".$hp."'");
        $row = $user->fetch_assoc();
        $tambah_ver = $db->query("INSERT INTO verifikasi (id_verifikasi, id_user, kode_rfid, waktu_pemberian, waktu_pemberhentian, status_user) VALUES ('', '".$row['id_user']."', '".$rfid."', CURRENT_TIMESTAMP, NULL, '0')");
        header("Location: ../register.php?pesan=berhasil_ditambahkan");
    }
}
?>