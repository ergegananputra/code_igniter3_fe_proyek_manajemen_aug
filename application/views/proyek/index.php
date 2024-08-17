<div class="container min-view-port">
    <div class="d-flex justify-content-between align-items-center my-4">
        <h1>Manajemen Proyek</h1>
        <a href="<?= base_url('proyek/create') ?>" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Tambah Proyek</a>
    </div>

    <hr>

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
                    <h3 class="card-title"><?= $proyek->nama_proyek ?></h3>
                    <p class="card-text"><i class="bi bi-calendar"> </i><?= $start_date ?> - <?= $end_date ?></p>
                    <h6 class="card-subtitle mb-2 text-muted">
                        <span class="badge bg-success"><i class="bi bi-person"></i><?= $proyek->client ?> (client)</span>
                        <span class="badge bg-secondary"><i class="bi bi-tag-fill"></i><?= $proyek->pimpinan_proyek ?></span>
                    </h6>
                    <p class="card-text"><?= $proyek->keterangan ?></p>
    
                    <h6 class="card-subtitle mb-2 text-muted"><i class="bi bi-geo-alt-fill"> </i>Lokasi:</h6>
                    <ul>
                        <?php foreach ($proyek->lokasis as $lokasi): ?>
                            <li><?= $lokasi->nama_lokasi ?>, <?= $lokasi->kota ?>, <?= $lokasi->provinsi ?>, <?= $lokasi->negara ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div class="card-footer">
                    <a href="<?= base_url('proyek/edit/' . $proyek->id) ?>" class="btn btn-warning"><i class="bi bi-pencil"> </i>Edit</a>
                    <a href="<?= base_url('proyek/delete/' . $proyek->id) ?>" 
                        class="btn btn-danger"
                        onclick="return confirm('Apakah Anda ingin menghapus proyek ini?');"
                        ><i class="bi bi-trash"> </i>Delete</a>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Tidak ada proyek</h5>
                <p class="card-text">Silakan tambah proyek baru.</p>
            </div>
        </div>
    <?php endif; ?>
</div>

<script>

</script>
    
