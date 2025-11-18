<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="card p-4 shadow-sm">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-semibold">Daftar Kursi</h4>
        <a href="<?= base_url('kursi/tambah') ?>" class="btn btn-primary">
            <i data-feather="plus"></i> Tambah Kursi
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>ID Room</th>
                    <th>Kode Kursi</th>
                    <th>Status</th>
                    <th class="text-center" style="width:120px;">Aksi</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($data as $i => $k): ?>
                <tr>
                    <td><?= $i + 1 ?></td>
                    <td><?= esc($k->id_room) ?></td>
                    <td><?= esc($k->kode_kursi) ?></td>
                    <td>
                        <?php if ($k->status == 'tersedia'): ?>
                            <span class="badge bg-success">Tersedia</span>
                        <?php else: ?>
                            <span class="badge bg-danger">Terisi</span>
                        <?php endif; ?>
                    </td>

                    <td class="text-center">
                        <a href="<?= base_url('kursi/ubah/'.$k->id_kursi) ?>"
                           class="btn btn-outline-primary action-circle">
                            <i data-feather="edit"></i>
                        </a>

                        <button class="btn btn-outline-danger action-circle"
                                onclick="hapusKursi(<?= $k->id_kursi ?>)">
                            <i data-feather="trash-2"></i>
                        </button>
                    </td>
                </tr>
                <?php endforeach ?>
            </tbody>

        </table>
    </div>

</div>

<script>
function hapusKursi(id) {
    Swal.fire({
        title: 'Hapus Kursi?',
        text: "Data akan dihapus permanen!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Hapus'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "<?= base_url('kursi/hapus') ?>/" + id;
        }
    });
}
</script>

<?= $this->endSection() ?>
