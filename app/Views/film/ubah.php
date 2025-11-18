<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="card">
    <div class="card-body">

        <h5 class="fw-semibold mb-4">Ubah Film</h5>

        <form action="<?= base_url('film/update/' . $data->id_film) ?>" method="post">

            <div class="mb-3">
                <label class="form-label">Judul Film</label>
                <input type="text" name="judul_film" class="form-control" 
                       value="<?= esc($data->judul_film) ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Genre</label>
                <select name="id_genre" class="form-select" required>
                    <?php foreach ($genres as $g): ?>
                        <option value="<?= $g->id_genre ?>" 
                            <?= $g->id_genre == $data->id_genre ? 'selected' : '' ?>>
                            <?= $g->nama_genre ?>
                        </option>
                    <?php endforeach ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Durasi (menit)</label>
                <input type="number" name="durasi" class="form-control" 
                       value="<?= esc($data->durasi) ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Tanggal Mulai</label>
                <input type="date" name="tanggal_mulai" class="form-control"
                       value="<?= esc($data->tanggal_mulai) ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Tanggal Selesai</label>
                <input type="date" name="tanggal_selesai" class="form-control"
                       value="<?= esc($data->tanggal_selesai) ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Harga Tiket</label>
                <input type="number" name="harga_tiket" class="form-control"
                       value="<?= esc($data->harga_tiket) ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Sinopsis</label>
                <textarea name="sinopsis" rows="4" class="form-control" required><?= esc($data->sinopsis) ?></textarea>
            </div>

            <button class="btn btn-primary">Update</button>
            <a href="<?= base_url('film') ?>" class="btn btn-secondary">Kembali</a>

        </form>

    </div>
</div>

<?= $this->endSection() ?>
