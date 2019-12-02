<?php
include "../config.php";

if(isset($_POST["user_id"]))
{
    $output = '';
    $query = $db->query("SELECT u.nama_lengkap, u.email, u.nomor_hp, m.kode_rfid, TIME(l.waktu_masuk) as jam, DATE(l.waktu_masuk) as tanggal, SEC_TO_TIME(TIME_TO_SEC(l.waktu_keluar) - TIME_TO_SEC(l.waktu_masuk)) AS durasi FROM manajerial m INNER JOIN user u ON m.id_user = u.id_user INNER JOIN log_akses l ON m.id_verifikasi = l.id_verifikasi 
          WHERE m.id_verifikasi = '".$_POST["user_id"]."' ORDER BY DATE(l.waktu_masuk) DESC");
    $user = $query->fetch_assoc();
    $output = '
    <h5 style="margin-left:5px;">'.$user['nama_lengkap'].'</h5> 
    <div class="table-borderless">
        <table class="table table-sm">
            <tr>
                <td>Kode RFID:</td>
                <td>'.$user['kode_rfid'].'</td>
            </tr>
            <tr>
                <td>Email:</td>
                <td>'.$user['email'].'</td>
            </tr>
            <tr>
                <td>Nomor Handphone:</td>
                <td>'.$user['nomor_hp'].'</td>
            </tr>
        </table>
    </div>
    <div class="table">
        <table class="table table-stripped table-sm" style="margin-top:5px;">
            <thead class="thead-dark">
                <tr>
                    <th>Tanggal Masuk</th>
                    <th>Jam Masuk</th>
                    <th>Durasi</th>
                </tr>
            </thead>
    ';
    while($row = $query->fetch_assoc())
    {
        $output .= '
            <tbody>
                <tr>
                    <td>'.$row['tanggal'].'</td>
                    <td>'.$row['jam'].'</td>
                    <td>'.$row['durasi'].'</td>
                </tr>
            </tbody>
        ';
    }
    $output .= '
        </table>
    </div>
    ';
    echo $output;
}
?>