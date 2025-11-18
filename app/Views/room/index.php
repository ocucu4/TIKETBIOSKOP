<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="card">
    <div class="card-body">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-semibold mb-0">Daftar Room</h4>
            <a href="<?= base_url('room/tambah') ?>" class="btn btn-primary">
                <i data-feather="plus"></i> Tambah Room
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Room</th>
                        <th>Kapasitas</th>
                        <th class="text-center" style="width:130px;">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($data as $i => $r): ?>
                    <tr>
                        <td><?= $i + 1 ?></td>
                        <td><?= esc($r->nama_room) ?></td>
                        <td><?= esc($r->kapasitas) ?></td>

                        <td class="text-center">
                            <a href="<?= base_url('room/ubah/'.$r->id_room) ?>" class="btn btn-outline-primary action-circle">
    <i data-feather="edit"></i>
</a>


                            <button class="btn btn-outline-danger action-circle"
                                    onclick="hapusRoom(<?= $r->id_room ?>)">
                                <i data-feather="trash-2"></i>
                            </button>
                        </td>

                    </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>
        </div>

    </div>
</div>

<script>
function hapusRoom(id) {
    Swal.fire({
        title: 'Hapus Room?',
        text: "Data akan dihapus permanen!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Hapus'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "<?= base_url('room/hapus') ?>/" + id;
        }
    });
}
</script>

<?= $this->endSection() ?>
