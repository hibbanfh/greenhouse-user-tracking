<?php 
session_start();

include '../config.php';

$username = $_POST['username'];
$password = $_POST['password'];

$data = mysqli_query($db, "SELECT * FROM admin WHERE username='".$username."' and password='".md5($password)."'");

$cek = mysqli_num_rows($data);

if($cek > 0){
    $_SESSION['username'] = $username;
    $_SESSION['status'] = "login";
    header("Location: ../index_admin.php?pesan=berhasil");
}
else{
    header("Location: ../login.php?error=1");
}
?>
