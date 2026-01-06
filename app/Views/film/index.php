<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<style>
.table-premium thead {
    background: #fdfeffff;
    color: white;
    font-weight: bold;
}
.table-premium tbody tr:hover {
    background-color: #f0f6ff !important;
}
.table-premium {
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 3px 12px rgba(0,0,0,0.08);
}
.action-btn {
    width: 38px;
    height: 38px;
    padding: 6px;
    border-radius: 50%;
}
</style>

<div class="card p-4 shadow-sm">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-semibold">Daftar Film</h4>

        <button class="btn btn-primary px-4" data-bs-toggle="modal" data-bs-target="#modalTambah">
            Tambah Film
        </button>
    </div>

    <table class="table table-premium align-middle">
        <thead>
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Genre</th>
                <th>Durasi</th>
                <th>Harga</th>
                <th style="width:120px" class="text-center">Aksi</th>
            </tr>
        </thead>

        <tbody>
            <?php if (!empty($data)): ?>
                <?php $no=1; foreach($data as $f): ?>
                <tr>
                    <td><?= $no++ ?></td>

                    <td class="fw-semibold"><?= esc($f->judul_film) ?></td>
                    <td><?= esc($f->nama_genre) ?></td>
                    <td><?= esc($f->durasi) ?> menit</td>
                    <td>Rp <?= number_format($f->harga_tiket, 0, ',', '.') ?></td>

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
                    <td colspan="8" class="text-center text-muted py-3">Belum ada data film.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

</div>

<div class="modal fade" id="modalTambah" tabindex="-1">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title fw-semibold">Tambah Film</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="<?= base_url('film/add') ?>" method="post">
                <?= csrf_field() ?>

                <div class="modal-body">

                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Judul Film</label>
                            <input type="text" name="judul_film" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Genre</label>
                            <select name="id_genre" class="form-select" required>
                                <option value="">-- Pilih Genre --</option>
                                <?php foreach ($genres as $g): ?>
                                    <option value="<?= $g->id_genre ?>"><?= $g->nama_genre ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Durasi (menit)</label>
                            <input type="number" name="durasi" class="form-control" required>
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold">Sinopsis</label>
                            <textarea name="sinopsis" rows="3" class="form-control" required></textarea>
                        </div>

                        <div class="col-md-5">
                            <label class="form-label fw-semibold">Harga Tiket</label>
                            <input type="number" name="harga_tiket" class="form-control" required>
                        </div>

                    </div>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-success">Simpan</button>
                </div>

            </form>

        </div>
    </div>
</div>

<div class="modal fade" id="modalUbah" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title fw-semibold">Ubah Film</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form id="formUbah" method="post">
                <?= csrf_field() ?>

                <div class="modal-body">

                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Judul Film</label>
                            <input type="text" id="u-judul" name="judul_film" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Genre</label>
                            <select name="id_genre" id="u-genre" class="form-select" required>
                                <?php foreach ($genres as $g): ?>
                                    <option value="<?= $g->id_genre ?>"><?= $g->nama_genre ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Durasi (menit)</label>
                            <input type="number" id="u-durasi" name="durasi" class="form-control" required>
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold">Sinopsis</label>
                            <textarea id="u-sinopsis" name="sinopsis" rows="3" class="form-control" required></textarea>
                        </div>

                        <div class="col-md-5">
                            <label class="form-label fw-semibold">Harga Tiket</label>
                            <input type="number" id="u-harga" name="harga_tiket" class="form-control" required>
                        </div>

                    </div>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-primary">Update</button>
                </div>

            </form>

        </div>
    </div>
</div>

<script>
function editFilm(f) {

    document.getElementById('u-judul').value    = f.judul_film;
    document.getElementById('u-genre').value    = f.id_genre;
    document.getElementById('u-durasi').value   = f.durasi;
    document.getElementById('u-sinopsis').value = f.sinopsis;
    document.getElementById('u-harga').value    = f.harga_tiket;

    document.getElementById('formUbah').action =
        "<?= base_url('film/update') ?>/" + f.id_film;
}

function hapusFilm(id) {
    Swal.fire({
        title: 'Hapus Film?',
        text: "Data film akan dihapus permanen!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#666',
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
