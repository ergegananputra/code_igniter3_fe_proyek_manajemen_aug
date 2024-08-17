<div class="container">
    <h1>Manajemen Proyek</h1>

    <?php if ($this->session->flashdata('error') ): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $this->session->flashdata('error'); ?>
        </div>
    <?php endif; ?>
    <?php if ($this->session->flashdata('success') ): ?>
        <div class="alert alert-success" role="alert">
            <?php echo $this->session->flashdata('success'); ?>
        </div>
    <?php endif; ?>


    <a href="<?= base_url('proyek/create') ?>" class="btn btn-primary mb-4">Tambah Proyek</a>

    <?php if (!empty($proyeks) && count($proyeks) > 0): ?>
        <?php foreach ($proyeks as $proyek): ?>
            <?php 
                $start_date = new DateTime($proyek->tgl_mulai);
                $end_date = new DateTime($proyek->tgl_selesai);
    
                $format = 'j M Y';
                $start_date = $start_date->format($format);
                $end_date = $end_date->format($format);
            ?>
            
            <div class="card my-4">
                <div class="card-body">
                    <h5 class="card-title"><?= $proyek->nama_proyek ?></h5>
                    <h6 class="card-subtitle mb-2 text-muted"><?= $proyek->client ?></h6>
                    <p class="card-text"><?= $start_date ?> - <?= $end_date ?></p>
                    <h6 class="card-subtitle mb-2 text-muted"><?= $proyek->pimpinan_proyek ?></h6>
                    <p class="card-text"><?= $proyek->keterangan ?></p>
    
                    <h6 class="card-subtitle mb-2 text-muted">Lokasi</h6>
                    <ul>
                        <?php foreach ($proyek->lokasis as $lokasi): ?>
                            <li><?= $lokasi->nama_lokasi ?>, <?= $lokasi->kota ?>, <?= $lokasi->provinsi ?>, <?= $lokasi->negara ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div class="card-footer">
                    <a href="<?= base_url('proyek/edit/' . $proyek->id) ?>" class="btn btn-primary">Edit</a>
                    <a href="<?= base_url('proyek/delete/' . $proyek->id) ?>" 
                        class="btn btn-danger"
                        onclick="return confirm('Apakah Anda ingin menghapus proyek ini?');"
                        >Delete</a>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<script>

</script>
    
