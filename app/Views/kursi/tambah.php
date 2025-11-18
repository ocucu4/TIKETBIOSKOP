<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="card p-4 shadow-sm">
    <h5 class="fw-semibold mb-3">Tambah Kursi</h5>

    <form action="<?= base_url('kursi/add') ?>" method="post">

        <div class="mb-3">
            <label class="form-label">Room</label>
            <select name="id_room" class="form-control" required>
                <option value="">-- Pilih Room --</option>
                <?php foreach ($room as $r): ?>
                    <option value="<?= $r->id_room ?>">
                        <?= $r->nama_room ?> (Kapasitas: <?= $r->kapasitas ?>)
                    </option>
                <?php endforeach ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Kode Kursi</label>
            <input type="text" name="kode_kursi" class="form-control" required placeholder="A1, B2, C10">
        </div>

        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-control" required>
                <option value="tersedia">Tersedia</option>
                <option value="terisi">Terisi</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="<?= base_url('kursi') ?>" class="btn btn-secondary">Kembali</a>

    </form>
</div>

<?= $this->endSection() ?>
