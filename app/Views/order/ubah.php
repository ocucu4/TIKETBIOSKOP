<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="card p-4 shadow-sm">
    <h5 class="fw-semibold mb-3">Ubah Order</h5>

    <form action="<?= base_url('order/update/' . $data->id_order) ?>" method="post">

        <div class="mb-3">
            <label class="form-label">Nama Pemesan</label>
            <input type="text" name="nama_pemesan" 
                   value="<?= esc($data->nama_pemesan) ?>" 
                   class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Tanggal Order</label>
            <input type="datetime-local" name="tanggal_order"
                   value="<?= date('Y-m-d\TH:i', strtotime($data->tanggal_order)) ?>"
                   class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Total Bayar</label>
            <input type="number" name="total_bayar"
                   value="<?= esc($data->total_bayar) ?>"
                   class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Status Order</label>
            <select name="status_order" class="form-select" required>
                <option value="pending" <?= $data->status_order=='pending'?'selected':'' ?>>Pending</option>
                <option value="lunas" <?= $data->status_order=='lunas'?'selected':'' ?>>Lunas</option>
                <option value="batal" <?= $data->status_order=='batal'?'selected':'' ?>>Batal</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Film</label>
            <select name="id_film" class="form-select" required>
                <?php foreach ($films as $f): ?>
                    <option value="<?= $f->id_film ?>"
                        <?= $f->id_film == $data->id_film ? 'selected' : '' ?>>
                        <?= $f->judul_film ?>
                    </option>
                <?php endforeach ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Room</label>
            <select name="id_room" class="form-select" required>
                <?php foreach ($rooms as $r): ?>
                    <option value="<?= $r->id_room ?>"
                        <?= $r->id_room == $data->id_room ? 'selected' : '' ?>>
                        <?= $r->nama_room ?>
                    </option>
                <?php endforeach ?>
            </select>
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="<?= base_url('order') ?>" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<?= $this->endSection() ?>
