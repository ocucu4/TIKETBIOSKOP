<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="card p-4 shadow-sm">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-semibold">Daftar Film</h5>
        <a href="<?= base_url('film/tambah') ?>" class="btn btn-primary">
            <i data-feather="plus"></i> Tambah Film
        </a>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Judul Film</th>
                <th>Sinopsis</th>
                <th style="width:120px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $i => $d): ?>
                <tr>
                    <td><?= $i + 1 ?></td>
                    <td><?= esc($d['judul_film']) ?></td>
                    <td><?= esc($d['sinopsis']) ?></td>
                    <td>
                        <a href="<?= base_url('film/ubah/' . $d['id_film']) ?>" 
                           class="btn btn-outline-primary action-circle">
                            <i data-feather="edit"></i>
                        </a>

                        <button class="btn btn-outline-danger action-circle"
                                onclick="hapusData(<?= $d['id_film'] ?>)">
                            <i data-feather="trash"></i>
                        </button>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>

<script>
function hapusData(id) {
    Swal.fire({
        title: 'Hapus Film?',
        text: "Data akan dihapus permanen!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Hapus'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "<?= base_url('film/hapus') ?>/" + id;
        }
    });
}
</script>

<?= $this->endSection() ?>
