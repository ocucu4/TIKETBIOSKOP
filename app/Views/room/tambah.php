<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="card p-4 shadow-sm">
    <h5 class="fw-semibold mb-3">Tambah Room</h5>

    <form action="<?= base_url('room/add') ?>" method="post">

        <div class="mb-3">
            <label class="form-label">Nama Room</label>
            <input type="text" name="nama_room" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Kapasitas</label>
            <input type="number" name="kapasitas" class="form-control" required>
        </div>

        <button class="btn btn-primary">Simpan</button>
        <a href="<?= base_url('room') ?>" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<?= $this->endSection() ?>
