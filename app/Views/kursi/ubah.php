<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="card p-4 shadow-sm">
    <h5 class="fw-semibold mb-3">Ubah Kursi</h5>

    <form action="<?= base_url('kursi/update/' . $data->id_kursi) ?>" method="post">

        <div class="mb-3">
            <label class="form-label">ID Room</label>
            <input type="number" name="id_room" class="form-control"
                   value="<?= esc($data->id_room) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Kode Kursi</label>
            <input type="text" name="kode_kursi" class="form-control"
                   value="<?= esc($data->kode_kursi) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-control" required>
                <option value="tersedia" <?= $data->status == 'tersedia' ? 'selected' : '' ?>>Tersedia</option>
                <option value="terisi" <?= $data->status == 'terisi' ? 'selected' : '' ?>>Terisi</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="<?= base_url('kursi') ?>" class="btn btn-secondary">Kembali</a>

    </form>
</div>

<?= $this->endSection() ?>
