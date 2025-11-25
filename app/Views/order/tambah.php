<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="card p-4 shadow-sm">
    <h5 class="fw-semibold mb-3">Tambah Order</h5>

    <form action="<?= base_url('order/add') ?>" method="post">

        <div class="mb-3">
            <label class="form-label">Nama Pemesan</label>
            <input type="text" name="nama_pemesan" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Pilih Jadwal Tayang</label>
            <select name="id_tayang" class="form-select" required>
                <option value="">-- Pilih Jadwal --</option>
                <?php foreach ($jadwal as $j): ?>
                <option value="<?= $j->id_tayang ?>">
                    <?= $j->tanggal ?> | <?= $j->jam_mulai ?> - <?= $j->jam_selesai ?>
                </option>
                <?php endforeach ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Tanggal Order</label>
            <input type="datetime-local" name="tanggal_order" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Total Bayar</label>
            <input type="number" name="total_bayar" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Status Order</label>
            <select name="status_order" class="form-select" required>
                <option value="pending">Pending</option>
                <option value="lunas">Lunas</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Pilih Film</label>
            <select name="id_film" class="form-select" required>
                <option value="">-- Pilih Film --</option>
                <?php foreach ($films as $f): ?>
                <option value="<?= $f->id_film ?>"><?= $f->judul_film ?></option>
                <?php endforeach ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Pilih Room</label>
            <select name="id_room" class="form-select" required>
                <option value="">-- Pilih Room --</option>
                <?php foreach ($rooms as $r): ?>
                <option value="<?= $r->id_room ?>"><?= $r->nama_room ?></option>
                <?php endforeach ?>
            </select>
        </div>

        <button class="btn btn-primary">Simpan</button>
        <a href="<?= base_url('order') ?>" class="btn btn-secondary">Kembali</a>

    </form>
</div>

<?= $this->endSection() ?>
