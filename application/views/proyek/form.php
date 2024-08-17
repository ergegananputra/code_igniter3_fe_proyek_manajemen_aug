<style>
    label{
        margin: 8px 0;
    }
    input:read-only {
        background-color: #f8f9fa;
    }
</style>

<div class="container">
    <div class="card my-3">
        <div class="card-header">
            <h1><?php echo isset($proyek) ?  "Edit" : "Tambah" ?> Proyek</h1>
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
                <input type="hidden" name="isEdit" value="<?php echo isset($proyek) ? 'true' : 'false'; ?>">

                <div class="form-group">
                    <label for="nama_proyek">Nama Proyek</label>
                    <input type="text" class="form-control" id="nama_proyek" name="nama_proyek" 
                        required
                        value="<?php if (isset($proyek)) { echo $proyek->nama_proyek; } ?>"
                        >
                </div>
                <div class="form-group">
                    <label for="client">Client</label>
                    <input type="text" class="form-control" id="client" name="client"
                        required
                        value="<?php if (isset($proyek))  {echo $proyek->client;} ?>"
                        >
                </div>
                <div class="form-group">
                    <label for="tgl_mulai">Tanggal Mulai</label>
                    <input type="datetime-local" class="form-control" id="tgl_mulai" name="tgl_mulai" 
                        required
                        value="<?php if (isset($proyek)) {echo $proyek->tgl_mulai;} ?>"
                        >
                </div>
                <div class="form-group">
                    <label for="tgl_selesai">Tanggal Selesai</label>
                    <input type="datetime-local" class="form-control" id="tgl_selesai" name="tgl_selesai" 
                        required
                        value="<?php if (isset($proyek)) {echo $proyek->tgl_selesai;} ?>"
                        >
                </div>
                <div class="form-group">
                    <label for="pimpinan_proyek">Pimpinan Proyek</label>
                    <input type="text" class="form-control" id="pimpinan_proyek" name="pimpinan_proyek" 
                        required
                        value="<?php if (isset($proyek)) {echo $proyek->pimpinan_proyek;} ?>"
                        >
                </div>
                <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <textarea class="form-control" id="keterangan" name="keterangan" required><?php if (isset($proyek)) {echo $proyek->keterangan;}?></textarea>
                </div>

                <?php if (!isset($proyek)) : ?>
                    <hr class="my-4">
                    <h4 class="mt-4">Lokasi</h4>
    
                    <div class="form-group">
                        <label for="lokasi">Pilih lokasi</label>
                        <select class="form-select" id="lokasi" name="lokasi">
                            <option value="">Tambah Lokasi</option>
                            <?php foreach ($lokasis as $lokasi): ?>
                                <option value="<?php echo $lokasi->id; ?>"
                                    data-nama_lokasi="<?php echo $lokasi->nama_lokasi; ?>"
                                    data-negara="<?php echo $lokasi->negara; ?>"
                                    data-provinsi="<?php echo $lokasi->provinsi; ?>"
                                    data-kota="<?php echo $lokasi->kota; ?>"
                                    <?php if (isset($proyek)) { echo $proyek->lokasis[0]->id == $lokasi->id ? 'selected' : ''; } ?>
                                    >
                                    <?php echo $lokasi->nama_lokasi; ?>,
                                    <?php echo $lokasi->kota; ?>,
                                    <?php echo $lokasi->provinsi; ?>,
                                    <?php echo $lokasi->negara; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                <?php endif; ?>
                    


                <div class="form-group">
                    <label for="nama_lokasi">Nama Lokasi</label>
                    <input type="text" class="form-control" id="nama_lokasi" name="nama_lokasi"
                        value="<?php if (isset($proyek)) {echo $proyek->lokasis[0]->nama_lokasi;} ?>"
                        <?php if (isset($proyek)) {echo "readonly";} ?>
                    >
                </div>

                <div class="form-group">
                    <label for="negara">Negara</label>
                    <input type="text" class="form-control" id="negara" name="negara"
                        value="<?php if (isset($proyek)) {echo $proyek->lokasis[0]->negara;} ?>"
                        <?php if (isset($proyek)) {echo "readonly";} ?>
                    >
                </div>

                <div class="form-group">
                    <label for="provinsi">Provinsi</label>
                    <input type="text" class="form-control" id="provinsi" name="provinsi"
                        value="<?php if (isset($proyek)) {echo $proyek->lokasis[0]->provinsi;} ?>"
                        <?php if (isset($proyek)) {echo "readonly";} ?>
                    >
                </div>

                <div class="form-group">
                    <label for="kota">Kota</label>
                    <input type="text" class="form-control" id="kota" name="kota"
                        value="<?php if (isset($proyek)) {echo $proyek->lokasis[0]->kota;} ?>"
                        <?php if (isset($proyek)) {echo "readonly";} ?>
                    >
                </div>
                
                <br>
                
                <a href="<?= base_url('proyek') ?>" class="btn btn-secondary">Kembali</a>

                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>


</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const lokasiSelect = document.getElementById('lokasi');
        const namaLokasiInput = document.getElementById('nama_lokasi');
        const negaraInput = document.getElementById('negara');
        const provinsiInput = document.getElementById('provinsi');
        const kotaInput = document.getElementById('kota');

        function changeLokasiInput(value) {
            namaLokasiInput.readOnly = value;
            negaraInput.readOnly = value;
            provinsiInput.readOnly = value;
            kotaInput.readOnly = value;
        }

        lokasiSelect.addEventListener('change', function() {
            const selectedOption = lokasiSelect.options[lokasiSelect.selectedIndex];

            if (selectedOption.value) {
                namaLokasiInput.value = selectedOption.getAttribute('data-nama_lokasi') || '';
                negaraInput.value = selectedOption.getAttribute('data-negara') || '';
                provinsiInput.value = selectedOption.getAttribute('data-provinsi') || '';
                kotaInput.value = selectedOption.getAttribute('data-kota') || '';
                changeLokasiInput(true)
            } else {
                namaLokasiInput.value = '';
                negaraInput.value = '';
                provinsiInput.value = '';
                kotaInput.value = '';
                changeLokasiInput(false)
            }
        });



    });
  
</script>