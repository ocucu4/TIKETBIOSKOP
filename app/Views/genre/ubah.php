<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="card p-4 shadow-sm">
    <h5 class="fw-semibold mb-3">Ubah Genre</h5>

    <form action="<?= base_url('genre/update/'.$data->id_genre) ?>" method="post">

        <div class="mb-3">
            <label class="form-label">Nama Genre</label>
            <input type="text"
                   name="nama_genre"
                   value="<?= esc($data->nama_genre) ?>"
                   class="form-control"
                   required>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="<?= base_url('genre') ?>" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<?= $this->endSection() ?>
