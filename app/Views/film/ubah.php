<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="card p-4 shadow-sm">
    <h5 class="fw-semibold mb-3">Ubah Film</h5>

    <form action="<?= base_url('film/update/' . $data['id']) ?>" method="post">

        <div class="mb-3">
            <label class="form-label">Judul Film</label>
            <input type="text" name="judul" class="form-control" 
                   value="<?= esc($data['judul']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea name="deskripsi" rows="4" class="form-control" required><?= esc($data['deskripsi']) ?></textarea>
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="<?= base_url('film') ?>" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<?= $this->endSection() ?>
