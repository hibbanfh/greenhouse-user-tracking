<?php if(isset($_GET['pesan'])) {?>
    <?php if($_GET['pesan'] == 'belum_login') {?>
        <div class="col-md-12">
            <div class="alert alert-primary alert-dismissable show fade" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                Anda Belum Login!
            </div>
        </div>
<?php } }?>

<?php if(isset($_GET['pesan'])) {?>
    <?php if($_GET['pesan'] == 'berhasil_ditambahkan') {?>
        <div class="col-md-12">
            <div class="alert alert-primary alert-dismissable show fade" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                User Berhasil ditambahkan!
            </div>
        </div>
<?php } }?>