<?php 
session_start();
require "config.php";
if($_SESSION['status'] != "login"){
    header("Location: index.php?pesan=belum_login");
}

$query = $db->query("SELECT m.id_verifikasi as id, m.id_verifikasi as ver, u.nama_lengkap, r.kode_rfid, m.waktu_pemberian, m.waktu_penghentian, m.status_user FROM manajerial m INNER JOIN user u
                    ON m.id_user = u.id_user INNER JOIN rfid r ON m.kode_rfid = r.kode_rfid ORDER BY m.waktu_pemberian DESC");
$_rfid = $db->query("SELECT * FROM rfid");
$_user = $db->query("SELECT * FROM user");
$kuota = $db->query("SELECT r.kode_rfid, r.status_kartu, COUNT(m.kode_rfid) AS kuota FROM rfid r LEFT JOIN manajerial m ON r.kode_rfid = m.kode_rfid GROUP BY kode_rfid");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register User Greenhouse</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>

<body class="bg-light">
<nav class="navbar navbar-expand-sm navbar-dark bg-dark sticky-top">
    <a href="#" class="navbar-brand">Monitoring User</a>
    <ul class="navbar-nav w-100 mr-auto">
        <li class="nav-item"><a href="index_admin.php" class="nav-link">Beranda</a></li>
        <li class="nav-item"><a href="register.php" class="nav-link">Kelola Akun</a></li>
        <li class="nav-item"><a href="#" class="nav-link">Perihal</a></li>
    </ul>
    <ul class="navbar-nav w-100 justify-content-end">
        <li class="nav-item justify-content-end mr-5"><a href="logout.php" class="nav-link">Keluar</a></li>
    </ul>
</nav>

<div class="container mt-2">
    <?php include 'pesan.php'; ?>

    <div class="row">
        <div class="col-md-5">
            <section><h4 style="margin: 30px 0 30px 0;font-family: 'Roboto', sans-serif;">Kelola Akun Pengguna Rumah Kaca</h4></section>
        </div>
        <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#Regis" style="margin: 30px 30px 30px 0px;">Tambah User</button>
        <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#rfid" style="margin: 30px 0px 30px 0;">Tambah Kartu RFID</button>   
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="table table-stripped table-responsive-sm">
                <table class="table table-hover table-sm table-responsive">
                    <thead>
                        <tr>
                            <th class="p-2" scope="col">Nama User</th>
                            <th class="p-2" scope="col">Kode RFID</th>
                            <th class="p-2" scope="col">Waktu Pemberian</th>
                            <th class="p-2" scope="col">Waktu Pemberhentian</th>
                            <th class="p-2" scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = $query->fetch_assoc()) {?>
                        <tr>
                            <td><input type="button" name="user_detail" id="<?php echo $row['id']; ?>" value="<?php echo $row['nama_lengkap']; ?>" class="btn btn-link btn-sm user_detail" /></td>
                            <td><?php echo $row['kode_rfid']; ?></td>
                            <td><?php echo $row['waktu_pemberian']; ?></td>
                            <td><?php if($row['waktu_penghentian'] == NULL): 
                                    echo "";
                                else:
                                    echo $row['waktu_penghentian'];
                                endif; ?></td>
                            <td><?php if($row['status_user'] == 1): ?>
                                    <span class="badge badge-pill badge-info">Aktif</span>
                                <?php elseif($row['status_user'] == 2): ?>
                                    <span class="badge badge-pill badge-warning">Pending</span>
                                <?php else: ?>
                                    <span class="badge badge-pill badge-danger">Tidak Aktif</span>
                                <?php endif; ?></td>
                            <td><?php if($row['status_user'] == 1): ?>
                                    <button type="button" name="status" value="Aktif" id="<?php echo $row['id']; ?>" class="btn btn-labeled btn-info btn-sm edit_data" data-toggle="modal" data-target="#edit">
                                    <span class="btn-label"><i class="icon-exchange"></i></span></button>
                                <?php elseif($row['status_user'] == 2): ?>
                                    <button type="button" name="status" value="Pending" id="<?php echo $row['id']; ?>" class="btn btn-warning btn-sm edit_data" data-toggle="modal" data-target="#edit">
                                    <span class="btn-label"><i class="icon-exchange"></i></span></button>
                                <?php else: ?>
                                    <button type="button" name="status" value="Tidak Aktif" id="<?php echo $row['id']; ?>" class="btn btn-danger btn-sm edit_data" data-toggle="modal" data-target="#edit">
                                    <span class="btn-label"><i class="icon-exchange"></i></span></button>
                                <?php endif; } ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="col-md-4">
            <div id="accordion">
                <div class="card">
                    <div class="card-header">
                        <a class="card-link" data-toggle="collapse" href="#kuota">Rekap Kuota Kartu RFID</a>
                    </div>
                    <div id="kuota" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            <table class="table table-stripped table-sm">
                                <thead>
                                    <tr>
                                        <th>Kode RFID</th>
                                        <th>Status</th>
                                        <th>Kuota</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while($kuo = $kuota->fetch_assoc()) { ?>
                                    <tr>
                                        <td><?php echo $kuo['kode_rfid']; ?></td>
                                        <td><?php if($kuo['status_kartu'] == 1): ?>
                                                    <span class="badge badge-pill badge-info">Aktif</span>
                                                <?php else: ?>
                                                    <span class="badge badge-pill badge-danger">Tidak Aktif</span>
                                                <?php endif; ?></td>
                                        <td><?php echo $kuo['kuota']; } ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>   
                    </div>    
                </div>
            </div>    
        </div>
    </div>
    
    <?php include 'modal/ubah_status.php'; ?>
    <?php include 'modal/kelola_akun.php'; ?>
    <?php include 'modal/kartu_baru.php'; ?>
    <?php include 'modal/modal_user.php'; ?>
</div>
</body>

<script type="text/javascript">
$(document).ready(function(){
    $(document).on('click', '.edit_data', function(){
        var id_ver = $(this).attr("id");
        $.ajax({
            url: "query/fetch.php",
            method: "POST",
            data: {id_ver:id_ver},
            dataType: "json",
            success: function(data){
                $('#nama').val(data.nama_lengkap);
                $('#kode').val(data.kode_rfid);
                $('#stat').val(data.status_user);
                $('#id_ver').val(data.id_verifikasi);
                $('#insert').val("Update");
                $('#edit').modal('show');
            }
        });
    });
    $(document).on('click', '.user_detail', function(){
        var user_id = $(this).attr("id");
        if(user_id != '')
        {
            $.ajax({
                url: "query/user_detail.php",
                method: "POST",
                data: {user_id:user_id},
                success: function(data){
                    $('#acc_detail').html(data);
                    $('#detail').modal('show');
                } 
            });
        }
    });
    $('#insert_form').on("submit", function(){
        $.ajax({
            url: "query/ubah.php",
            method: "POST",
            data: $('#insert_form').serialize(),
            beforeSend: function(){
                $('#insert').val("Updating");
            },
            success: function(data){
                $('edit').modal('hide');
                $('#tabel_user').html(data);
            }
        });
    });
});
</script>

</html>
