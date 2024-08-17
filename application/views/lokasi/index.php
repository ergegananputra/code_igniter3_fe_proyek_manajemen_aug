<div class="container min-view-port">
    <div class="d-flex justify-content-between align-items-center my-4">
        <h1>Manajemen Lokasi</h1>
        <a href="<?= base_url('lokasi/create') ?>" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Tambah Lokasi</a>
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

    <?php if (!empty($lokasis) && count($lokasis) > 0): ?>
        <table class="table  table-striped">
            <thead>
                <tr>
                    <th scope="col">Nama Lokasi</th>
                    <th scope="col">Negara</th>
                    <th scope="col">Provinsi</th>
                    <th scope="col">Kota</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($lokasis as $lokasi): ?>
                    <tr>
                        <td ><?= $lokasi->nama_lokasi ?></td>
                        <td><?= $lokasi->negara ?></td>
                        <td><?= $lokasi->provinsi ?></td>
                        <td><?= $lokasi->kota ?></td>
                        <td>
                            <a href="<?= base_url('lokasi/edit/' . $lokasi->id) ?>" class="btn btn-warning"><i class="bi bi-pencil"> </i>Edit</a>
                            <a href="<?= base_url('lokasi/delete/' . $lokasi->id) ?>" 
                                class="btn btn-danger"
                                onclick="return confirm('Apakah Anda ingin menghapus lokasi ini?');"
                                ><i class="bi bi-trash"> </i>Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Tidak ada lokasi proyek</h5>
                <p class="card-text">Silakan tambah lokasi proyek baru.</p>
            </div>
        </div>
    <?php endif; ?>
</div>

<script>

</script>
    
