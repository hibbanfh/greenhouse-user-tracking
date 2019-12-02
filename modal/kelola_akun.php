<div class="modal fade" id="Regis">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Form User Baru</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>    

            <div class="modal-body">
                <form action="query/tambah.php" method="POST">
                <div class="form-group">
                    <select name="rfid" class="form-control" placeholder="Kode Kartu RFID">
                        <option disabled="disabled" selected="selected">Kode Kartu RFID</option>
                        <?php while($kode = $_rfid->fetch_assoc()){ ?>
                        <option><?php echo $kode['kode_rfid']; } ?></option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="text" name="nama_lengkap" class="form-control" placeholder="Nama Lengkap Anda" required>
                </div>
                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="Email Anda" required>
                </div>
                <div class="form-group">
                    <input type="tel" name="nomor_hp" pattern="[0-9]{12}" class="form-control" placeholder="Nomor HP Anda" required>
                </div>

                <input type="submit" class="btn btn-success btn-block" name="register" value="Daftar">
                </form>
            </div>
        </div>
    </div>
</div>