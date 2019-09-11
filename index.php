<?php
session_start(); 
include('config.php');
$row_counter = 0;
$limit = isset($_POST["limit-records"]) ? $_POST["limit-records"] : 10;
$perpage = 10;
$page = isset($_GET["halaman"]) ? (int)$_GET["halaman"] : 1;
$start = ($page > 1) ? ($page * $perpage) - $perpage : 0;
$hasil = $db->query("SELECT u.nama_lengkap, DATE(l.waktu_masuk) as tanggal_masuk, TIME(l.waktu_masuk) as masuk, TIME(l.waktu_keluar) as waktu_keluar, SEC_TO_TIME(TIME_TO_SEC(l.waktu_keluar) - TIME_TO_SEC(l.waktu_masuk)) AS estimasi FROM log_akses l 
                    INNER JOIN manajerial m ON l.id_verifikasi = m.id_verifikasi INNER JOIN user u ON m.id_user = u.id_user 
                    ORDER BY DATE(l.waktu_masuk) DESC, TIME(l.waktu_masuk) DESC LIMIT $start, $limit");
$sql = $db->query("SELECT * FROM log_akses");
$total = mysqli_num_rows($sql);
$pages = ceil($total/$perpage); 

$kemarin = $db->query("SELECT u.nama_lengkap, TIME(l.waktu_masuk) as masuk, TIME(l.waktu_keluar) as waktu_keluar FROM log_akses l 
                        INNER JOIN manajerial m ON l.id_verifikasi = m.id_verifikasi INNER JOIN user u ON m.id_user = u.id_user 
                        WHERE DATE(l.waktu_masuk) = CURDATE() - INTERVAL 1 DAY");
$lusa = $db->query("SELECT u.nama_lengkap, TIME(l.waktu_masuk) as masuk, TIME(l.waktu_keluar) as waktu_keluar FROM log_akses l 
                    INNER JOIN manajerial m ON l.id_verifikasi = m.id_verifikasi INNER JOIN user u ON m.id_user = u.id_user 
                    WHERE DATE(l.waktu_masuk) = CURDATE() - INTERVAL 2 DAY");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Monitoring Akses Greenhouse</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css">
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css"/>    
    <link rel="stylesheet" type="text/css" href="env.css">
</head>


<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark sticky-top">
        <a href="#" class="navbar-brand">Monitoring User</a>
        <ul class="navbar-nav w-100">
            <li class="nav-item"><a href="index.php" class="nav-link">Beranda</a></li>
            <li class="nav-item"><a href="#" class="nav-link">Perihal</a></li>
        </ul>
        <ul class="navbar-nav w-100 justify-content-end">
            <li class="nav-item justify-content-end mr-5"><a href="login.php" class="nav-link">Masuk</a></li>
        </ul>
    </nav>

    <div class="container-fluid">
        <?php include 'pesan.php'; ?>
        </*?php include 'limit.php'; ?>
        <div class="row">
            <div class="col-md-3">
                <div class="input-append date">
                    <input id="datepicker" size="16" type="text" readonly>
                    <span class="add-on"><i class="icon-calendar"></i></span>
                    <button type="button" id="sort" name="sort" class="btn btn-success btn-sm"><span class="btn-label"><i class="icon-search"></i></span></button>
                    <button type="button" id="clear" name="clear" class="btn btn-danger btn-sm"><span class="btn-label"><i class="icon-refresh"></i></span></button>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div id="tbl_utama" class="col-md-7">
                <table class="table table-stripped table-hover maintabel" style="margin-left:30px;"> 
                    <thead>
                    <tr>
                        <th scope="col">User</th>   
                        <th scope="col">Waktu Masuk</th>
                        <th scope="col">Waktu Keluar</th>
                        <th scope="col">Durasi Aktifitas</th>
                    </tr>
                    </thead>
                    
                    <tbody id="tbl_isi">
                    <?php
                    if ($hasil-> num_rows > 0){
                        $cur_date = false;
                        while($row = $hasil-> fetch_assoc()) {
                            $row_counter++;
                            if ($row['tanggal_masuk'] != $cur_date) { ?>
                        <tr class="table-dark">
                            <td colspan='4'><b><?php if ($row['tanggal_masuk'] == date('Y-m-d')):
                                echo "Hari ini";
                            elseif ($row['tanggal_masuk'] == date('Y-m-d', time() - 86400)):
                                echo "Kemarin";
                            else:
                                echo date('D, d M Y', strtotime($row['tanggal_masuk']));
                            endif;
                            ?></b></td>
                        </tr>
                        
                        <?php $cur_date = $row['tanggal_masuk'];
                            }?>
                        <tr>
                            <td><?php echo $row['nama_lengkap'] ?></td>
                            <td><?php echo $row['masuk'] ?></td>
                            <td><?php if ($row['waktu_keluar'] === NULL):
                                    echo "User belum keluar";
                                else:
                                    echo $row['waktu_keluar'];
                                endif; ?></td>
                            <td><?php if ($row['estimasi'] < 0):
                                    echo "User belum Keluar";
                                else: 
                                    echo $row['estimasi'];
                                endif; ?></td>
                        </tr><?php }
                        } ?>
                    </tbody>    
                </table>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <p style="margin-top:10px;">Rekap Data</p>
                    <div id="accordion">
                        <div class="card">
                            <div class="card-header">
                                <a class="card-link" data-toggle="collapse" href="#kemarin">Kemarin</a>
                            </div>
                            <div id="kemarin" class="collapse" data-parent="#accordion">
                                <div class="card-body">
                                    <table class="table table-stripped table-sm">
                                        <thead>
                                        <tr>
                                            <th>User</th>
                                            <th>Waktu Masuk</th>
                                            <th>Waktu Keluar</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php while($k = $kemarin->fetch_assoc()) {?>
                                        <tr>
                                            <td><?php echo $k['nama_lengkap']; ?></td>
                                            <td><?php echo $k['masuk']; ?></td>
                                            <td><?php echo $k['waktu_keluar']; }?></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <a class="card-link" data-toggle="collapse" href="#lusa">2 Hari yang Lalu</a>
                            </div>
                            <div id="lusa" class="collapse" data-parent="#accordion">
                                <div class="card-body">
                                    <table class="table table-stripped table-sm">
                                        <thead>
                                        <tr>
                                            <th>User</th>
                                            <th>Waktu Masuk</th>
                                            <th>Waktu Keluar</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php while($l = $lusa->fetch_assoc()) {
                                                if($lusa-> num_rows>0): ?>
                                        <tr>
                                            <td><?php echo $l['nama_lengkap']; ?></td>
                                            <td><?php echo $l['masuk']; ?></td>
                                            <td><?php echo $l['waktu_keluar']; ?></td>
                                        <?php else: ?>
                                            <td>Tidak Ada Aktifitas</td>
                                        <?php endif; }?>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        <?php include "pagination.php"; ?>
        </div>
        
    </div>
    <?php include "footer.php"; ?>
</body>

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdn.datatables.net/3.3.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
<script src="https://maxcdn.boostrapcdn.com/bootstrap/4.3.1/js/boostrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmY1" crossorigin="anonymous"></script>
<script type="text/javascript">
$(document).ready(function(){
    $(function(){
        $('#datepicker').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd',
        todayHighlight: true,
        });
    });
    //$('#datepicker').datepicker();
    $('#sort').on('click', function(){
        if($('#datepicker').val() == ""){
            alert("Pilih tanggal terlebih dahulu!");
        } else {
            $datepicker = $('#datepicker').val();
            $('#tbl_isi').empty();
            $loading = $('<tr><td colspan="4"><center>Mencari....</center></td></tr>');
            $loading.appendTo('#tbl_isi');
            setTimeout(function(){
                $loading.remove();
                $.ajax({
                    url: "query/sorting.php",
                    type: "POST",
                    data: {datepicker:$datepicker},
                    success: function(res){
                        $('#tbl_isi').html(res);
                    }
                });
            }, 3000);
        }
    });
    $('#clear').on('click', function(){
        location.reload();
    }); 
});
</script>
</html>
