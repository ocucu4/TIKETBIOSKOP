<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="card p-4 shadow-sm">
    <h5 class="fw-semibold mb-3">Tambah Film</h5>

    <form action="<?= base_url('film/add') ?>" method="post">

        <div class="mb-3">
            <label class="form-label">Judul Film</label>
            <input type="text" name="judul" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Sinopsis</label>
            <textarea name="Sinopsis" rows="4" class="form-control" required></textarea>
        </div>

        <button class="btn btn-primary">Simpan</button>
        <a href="<?= base_url('film') ?>" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<?= $this->endSection() ?>
