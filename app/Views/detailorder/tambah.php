<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="card">
    <div class="card-header">
        <h4 class="mb-0">Tambah Detail Order</h4>
    </div>

    <div class="card-body">
        <form action="<?= base_url('detailorder/add') ?>" method="post">

            <div class="mb-3">
                <label class="form-label">Pilih Order</label>
                <select name="id_order" class="form-select" required>
                    <option value="">-- Pilih Order --</option>
                    <?php foreach ($orders as $o): ?>
                        <option value="<?= $o->id_order ?>">
                            <?= $o->id_order ?> — <?= $o->nama_pemesan ?>
                        </option>
                    <?php endforeach ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Pilih Kursi</label>
                <select name="id_kursi" class="form-select" required>
                    <option value="">-- Pilih Kursi --</option>
                    <?php foreach ($kursi as $k): ?>
                        <option value="<?= $k->id_kursi ?>">
                            <?= $k->kode_kursi ?> (Room <?= $k->id_room ?>)
                        </option>
                    <?php endforeach ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Jumlah</label>
                <input type="number" name="jumlah" class="form-control" min="1" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Subtotal</label>
                <input type="number" name="subtotal" class="form-control" required>
            </div>

            <div class="d-flex justify-content-end">
                <a href="<?= base_url('detailorder') ?>" class="btn btn-secondary me-2">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>

        </form>
    </div>
</div>

<?= $this->endSection() ?>
