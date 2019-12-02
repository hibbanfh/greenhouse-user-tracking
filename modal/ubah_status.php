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