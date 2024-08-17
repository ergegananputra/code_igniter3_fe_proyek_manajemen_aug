<style>
    label{
        margin: 8px 0;
    }
    input:read-only {
        background-color: #f8f9fa;
    }
</style>

<div class="container min-view-port">
    <div class="card my-3">
        <div class="card-header">
            <h1><?php echo isset($lokasi) ?  "Edit" : "Tambah" ?> Lokasi</h1>
        </div>

        <div class="card-body">
            <?php if ($this->session->flashdata('error') ): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $this->session->flashdata('error'); ?>
                </div>
            <?php endif; ?>
            <?php if (validation_errors()): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo validation_errors(); ?>
                </div>
            <?php endif; ?>

            <form action="" method="post">
                <input type="hidden" name="isEdit" value="<?php echo isset($lokasi) ? 'true' : 'false'; ?>">


                <div class="form-group">
                    <label for="nama_lokasi">Nama Lokasi</label>
                    <input type="text" class="form-control" id="nama_lokasi" name="nama_lokasi"
                        value="<?php if (isset($lokasi)) {echo $lokasi->nama_lokasi;} ?>"
                    >
                </div>

                <div class="form-group">
                    <label for="negara">Negara</label>
                    <input type="text" class="form-control" id="negara" name="negara"
                        value="<?php if (isset($lokasi)) {echo $lokasi->negara;} ?>"
                    >
                </div>

                <div class="form-group">
                    <label for="provinsi">Provinsi</label>
                    <input type="text" class="form-control" id="provinsi" name="provinsi"
                        value="<?php if (isset($lokasi)) {echo $lokasi->provinsi;} ?>"
                    >
                </div>

                <div class="form-group">
                    <label for="kota">Kota</label>
                    <input type="text" class="form-control" id="kota" name="kota"
                        value="<?php if (isset($lokasi)) {echo $lokasi->kota;} ?>"
                    >
                </div>
                
                <br>
                
                <a href="<?= base_url('lokasi') ?>" class="btn btn-secondary">Kembali</a>

                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>


</div>
