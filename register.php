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
<nav class="navbar navbar-expand-md navbar-dark bg-dark sticky-top">
        <a href="#" class="navbar-brand">Monitoring User</a>
        <ul class="navbar-nav w-100">
            <li class="nav-item"><a href="index_admin.php" class="nav-link">Beranda</a></li>
            <li class="nav-item"><a href="register.php" class="nav-link">Kelola Akun</a></li>
            <li class="nav-item"><a href="#" class="nav-link">Perihal</a></li>
        </ul>
        <ul class="navbar-nav w-100 justify-content-end">-
            <li class="nav-item justify-content-end mr-5"><a href="logout.php" class="nav-link">Keluar</a></li>
        </ul>
</nav>

<div class="container mt-2">
    <?php include 'pesan.php'; ?>

    <div class="row">
        <div class="col-md-6">
            <section><h4 style="margin: 30px 0 30px 0;">Kelola Akun Pengguna Rumah Kaca</h4></section>
        </div>
        <div class="col-md-3">
            <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#Regis" style="margin: 30px 0 30px 0;">Tambah User</button>
            <div class="modal fade" id="Regis">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Form User Baru</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>    

                        <div class="modal-body">
                            <form action="../tambah.php" method="POST">
                                <div class="form-group">
                                    <label for="rfid">Kode RFID</label>
                                    <select name="rfid" class="form-control" placeholder="Kode Kartu RFID">
                                        <option disabled="disabled" selected="selected">Kode Kartu RFID</option>
                                        <?php while($kode = $_rfid->fetch_assoc()){ ?>
                                        <option><?php echo $kode['kode_rfid']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="nama_lengkap">Nama Lengkap</label>
                                    <input type="text" name="nama_lengkap" class="form-control" placeholder="Nama Lengkap Anda">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" class="form-control" placeholder="Email Anda">
                                </div>
                                <div class="form-group">
                                    <label for="nomor_hp">Nomor Handphone</label>
                                    <input type="text" name="nomor_hp" class="form-control" placeholder="Nomor HP Anda">
                                </div>

                                <input type="submit" class="btn btn-success btn-block" name="register" value="Daftar">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
        
        <div class="col-md-3">
            <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#rfid" style="margin: 30px 0 30px 0;">Tambah Kartu RFID</button>
                <div class="modal fade" id="rfid">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Form Kartu RFID Baru</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>    

                            <div class="modal-body">
                                <form action="#" method="POST">
                                    <div class="form-group">
                                        <label for="nomor_rfid">Nomor Kartu RFID</label>
                                        <input type="text" name="nomor_rfid" class="form-control" placeholder="Nomor Kartu RFID Anda">
                                    </div>
                                    <input type="submit" class="btn btn-success btn-block" name="tambah" value="Daftar">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="table table-stripped table-responsive-sm">
                <table class="table table-hover table-sm">
                    <thead>
                        <tr>
                            <th>Nama User</th>
                            <th>Kode RFID</th>
                            <th>Waktu Pemberian</th>
                            <th>Waktu Pemberhentian</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = $query->fetch_assoc()) {?>
                        <tr>
                            <td><button type="button" data-toggle="modal" data-target="#user" name="user" id="<?php echo $row['id']; ?>" class="btn btn-labeled btn-link btn-sm tracking"><?php echo $row['nama_lengkap']; ?></button></td>
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
    
    <div class="col-md-3">
        <div class="modal fade" id="edit">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Ubah Status User</h3>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <div class="modal-body">
                        <form id="insert_form" action="query/ubah.php" method="POST">
                            <div class="form-group">
                                Apa anda yakin akan mengubah status dari user di bawah?
                            </div>
                            <div class="form-group">
                                <label for="nama">Nama User</label>
                                <input disabled type="text" name="nama" id="nama" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="kode">Kode RFID</label>
                                <input disabled type="text" name="kode" id="kode" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="stat">Status User</label>
                                <select name="stat" id="stat" placeholder="status" class="form-control">
                                    <option value="1">Aktif</option>
                                    <option value="2">Pending</option>
                                    <option value="0">Tidak Aktif</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="id_ver" id="id_ver">
                            </div>
                            <input type="submit" class="btn btn-success btn-block" name="insert" id="insert" value="Submit">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <div class="col-md-3">
        <div class="modal modal-fade" id="user">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Rekord Data User</h3>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body" id="user_detail">
                        <p>Akun milik <span id="nama_user" style="font-weight:bold;"></span>, dengan kode RFID: <span id="rfid_clm" style="font-weight:bold;"></span></p>
                        <div class="table table-stripped">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Tanggal Masuk</th>
                                        <th>Waktu Masuk</th>
                                        <th>Durasi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td id="tanggal"></td>
                                        <td id="waktu"></td>
                                        <td id="durasi"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
    $(document).on('click', '.tracking', function(){
        var id_ver = $(this).attr("id");
        $.ajax({
            url: "query/tabel_user.php",
            method: "POST",
            data: {id_ver:id_ver},
            dataType: "json",
            success: function(data){
                $('#nama_user').val(data.nama_lengkap);
                $('#rfid_clm').val(data.kode_rfid);
                $('#tanggal').val(data.tanggal);
                $('#waktu').val(data.jam);
                $('#durasi').val(data.durasi);
                $('#user').modal('show');
            }
        });
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
