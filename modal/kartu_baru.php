<div class="modal fade" id="rfid">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Form Kartu RFID Baru</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>    

            <div class="modal-body">
                <form action="query/tambah_kartu.php" method="POST">
                    <div class="form-group">
                        <input type="tel" name="nomor_rfid" class="form-control" pattern="[0-9]{10}" placeholder="Nomor Kartu RFID Baru" required>
                    </div>
                    <input type="submit" class="btn btn-success btn-block" name="tambah" value="Daftar">
                </form>
            </div>
        </div>
    </div>
</div>