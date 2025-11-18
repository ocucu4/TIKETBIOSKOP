<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="card">
    <div class="card-body">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="fw-semibold mb-0">Daftar Film</h5>
            <a href="<?= base_url('film/tambah') ?>" class="btn btn-primary">
                <i class="ti ti-plus"></i> Tambah Film
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Judul Film</th>
                        <th>Genre</th>
                        <th>Durasi</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Selesai</th>
                        <th>Harga Tiket</th>
                        <th>Sinopsis</th>
                        <th class="text-center" style="width:120px;">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($data as $i => $d): ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td><?= esc($d->judul_film) ?></td>
                            <td><?= esc($d->nama_genre) ?></td>
                            <td><?= esc($d->durasi) ?> menit</td>
                            <td><?= date('d M Y', strtotime($d->tanggal_mulai)) ?></td>
                            <td><?= date('d M Y', strtotime($d->tanggal_selesai)) ?></td>
                            <td>Rp <?= number_format($d->harga_tiket, 0, ',', '.') ?></td>

                            <td class="text-truncate" style="max-width:180px;">
                                <?= esc($d->sinopsis) ?>
                            </td>

                            <td class="text-center">
                                <a href="<?= base_url('film/ubah/'.$d->id_film) ?>" 
                                   class="btn btn-outline-primary action-circle me-1">
                                    <i data-feather="edit"></i>
                                </a>

                                <button onclick="hapusData(<?= $d->id_film ?>)" 
                                        class="btn btn-outline-danger action-circle">
                                    <i data-feather="trash-2"></i>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>

            </table>
        </div>

    </div>
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
            window.location.href = "<?= base_url('film/delete') ?>/" + id;
        }
    });
}
</script>

<?= $this->endSection() ?>
