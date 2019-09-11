<?php 
session_start();
include('config.php');
if($_SESSION['status'] != "login"){
    header("Location: index.php?pesan=belum_login");
}
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
</head>


<body>
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

    <div class="container-fluid">

        <div class="row">
            <div class="col-md-7">
                <table class="table table-stripped table-hover maintabel" style="margin-left:30px;"> 
                    <thead>
                    <tr>
                        <th scope="col">User</th>   
                        <th scope="col">Waktu Masuk</th>
                        <th scope="col">Waktu Keluar</th>
                        <th scope="col">Durasi Aktifitas</th>
                    </tr>
                    </thead>

                    <?php
                    if ($hasil-> num_rows > 0){
                        $cur_date = false;
                        while($row = $hasil-> fetch_assoc()) {
                            $row_counter++;
                            if ($row['tanggal_masuk'] != $cur_date) {
                    ?>
                    <tr class="table-dark">
                        <td colspan='4'><b><?php if ($row['tanggal_masuk'] == date('Y-m-d')):
                            echo "Hari ini";
                        elseif ($row['tanggal_masuk'] == date('Y-m-d', time() - 86400)):
                            echo "Kemarin";
                        else:
                            echo $row['tanggal_masuk'];
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
                    </tr>
                    
                    <?php
                        }
                    }
                    ?>
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
        </div>
        
        <div class="col-md-3">
            <ul class="pagination" style="margin-left:30px;">
                <li class="page-item"><?php if($page > 1): ?>
                    <a class="page-link" href="?halaman=<?= $page - 1; ?>">Previous</a>
                <?php endif; ?>
                </li>
                <?php for($i=1; $i<=$pages; $i++) :?>
                <li class="<?php if($i == $page) {echo 'page-item active';} else {echo 'page-item';} ?>">
                        <a href="?halaman=<?= $i; ?>" class="page-link"><?= $i; ?></a>
                    <?php endfor;?>  
                </li>
                <li class="page-item"><?php if($page < $pages): ?>
                    <a href="?halaman=<?= $page + 1;?>" class="page-link">Next</a>
                <?php endif; ?>
                </li>
            </ul>
        </div>
        
        
    </div>

    <?php include "footer.php"; ?>
</body>
    <script src="http://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="//cdn.datatables.net/3.3.7/js/jquery.dataTables.min.js"></script>
    <script>
    $(document).ready(function() {
        $('.maintabel').DataTable();
    } );
    </script>
</html>
