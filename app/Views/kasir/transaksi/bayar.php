<?= $this->extend('layoutkasir/main') ?>
<?= $this->section('content') ?>

<h4 class="mb-3">Pembayaran</h4>

<form method="post" action="<?= base_url('kasir/proses-bayar') ?>">
    <?= csrf_field() ?>

    <input type="hidden" name="id_order" value="<?= esc($id_order) ?>">

    <div class="mb-3">
        <label class="form-label">Metode Pembayaran</label>
        <select name="metode" class="form-control" required>
            <option value="cash">Cash</option>
            <option value="transfer">Transfer</option>
            <option value="ewallet">E-Wallet</option>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Total Bayar</label>
        <input type="number" name="total" class="form-control" required>
    </div>

    <button class="btn btn-success">Selesaikan Transaksi</button>
</form>

<?= $this->endSection() ?>
