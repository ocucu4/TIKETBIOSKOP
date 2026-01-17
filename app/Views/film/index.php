<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="card p-4 shadow-sm">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-semibold mb-0">Daftar Film</h4>

        <button class="btn btn-primary px-4" data-bs-toggle="modal" data-bs-target="#modalTambah">
            Tambah Film
        </button>
    </div>

    <table class="table table-premium align-middle">
        <thead>
            <tr>
                <th class="text-center" style="width:60px">No</th>
                <th>Judul</th>
                <th class="text-center" style="width:120px">Genre</th>
                <th class="text-end" style="width:110px">Durasi</th>
                <th class="text-end" style="width:140px">Harga</th>
                <th class="text-center" style="width:110px">Aksi</th>
            </tr>
        </thead>

        <tbody>
            <?php if (!empty($data)): ?>
                <?php $no=1; foreach($data as $f): ?>
                <tr>
                    <td class="text-center"><?= $no++ ?></td>

                    <td class="fw-semibold"><?= esc($f->judul_film) ?></td>

                    <td class="text-center"><?= esc($f->nama_genre) ?></td>

                    <td class="text-end"><?= esc($f->durasi) ?> menit</td>

                    <td class="text-end">
                        Rp <?= number_format($f->harga_tiket, 0, ',', '.') ?>
                    </td>

                    <td class="text-center">
                        <button class="btn btn-outline-primary action-btn me-2"
                                onclick='editFilm(<?= json_encode($f, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ?>)'
                                data-bs-toggle="modal"
                                data-bs-target="#modalUbah">
                            <i data-feather="edit"></i>
                        </button>

                        <button class="btn btn-outline-danger action-btn"
                                onclick="hapusFilm(<?= $f->id_film ?>)">
                            <i data-feather="trash-2"></i>
                        </button>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" class="text-center empty-state">
                        Belum ada data film
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

</div>

<div class="modal fade" id="modalTambah" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Tambah Film</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="<?= base_url('film/add') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>

                <div class="modal-body">
                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label">Judul Film</label>
                            <input type="text" name="judul_film" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Poster Film</label>
                            <input type="file" name="poster" class="form-control" accept="image/*" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Genre</label>
                            <select name="id_genre" class="form-select" required>
                                <option value="">-- Pilih Genre --</option>
                                <?php foreach ($genres as $g): ?>
                                    <option value="<?= $g->id_genre ?>"><?= $g->nama_genre ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Durasi (menit)</label>
                            <input type="number" name="durasi" class="form-control" required>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Harga Tiket</label>
                            <input type="number" name="harga_tiket" class="form-control" required>
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-primary">Simpan</button>
                </div>

            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalUbah" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Ubah Film</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form id="formUbah" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>

                <div class="modal-body">
                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label">Judul Film</label>
                            <input type="text" id="u-judul" name="judul_film" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Poster (opsional)</label>
                            <input type="file" name="poster" class="form-control" accept="image/*">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Genre</label>
                            <select name="id_genre" id="u-genre" class="form-select" required>
                                <?php foreach ($genres as $g): ?>
                                    <option value="<?= $g->id_genre ?>"><?= $g->nama_genre ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Durasi</label>
                            <input type="number" id="u-durasi" name="durasi" class="form-control" required>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Harga Tiket</label>
                            <input type="number" id="u-harga" name="harga_tiket" class="form-control" required>
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-primary">Update</button>
                </div>

            </form>
        </div>
    </div>
</div>

<script>
function editFilm(f) {
    document.getElementById('u-judul').value  = f.judul_film;
    document.getElementById('u-genre').value  = f.id_genre;
    document.getElementById('u-durasi').value = f.durasi;
    document.getElementById('u-harga').value  = f.harga_tiket;

    document.getElementById('formUbah').action =
        "<?= base_url('film/update') ?>/" + f.id_film;
}

function hapusFilm(id) {
    Swal.fire({
        title: 'Hapus Film?',
        text: 'Data film akan dihapus permanen',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        confirmButtonText: 'Hapus'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "<?= base_url('film/delete') ?>/" + id;
        }
    });
}

feather.replace();
</script>

<?= $this->endSection() ?>
