<?php 
session_start();
require "../config.php";

if(isset($_POST['tambah']))
{
    $rfid = $_POST['nomor_rfid'];
    $tambah = $db->query("INSERT INTO rfid (id_rfid, kode_rfid, status_kartu) VALUES('', '".$rfid."', 0)");
    header("Location:../register.php");
}
?>