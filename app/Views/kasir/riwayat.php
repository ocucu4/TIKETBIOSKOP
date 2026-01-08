<?= $this->extend('kasir/layout/main') ?>
<?= $this->section('content') ?>

<div class="container py-4">

    <a href="<?= base_url('kasir/dashboard') ?>" class="btn btn-outline-secondary mb-3">
        ← Kembali
    </a>

    <h3 class="fw-bold mb-1">Riwayat Transaksi</h3>
    <p class="text-muted mb-4">History transaksi yang telah dilakukan oleh kasir</p>

    <input type="text" id="search" class="form-control mb-3"
           placeholder="Cari film, order ID, atau kursi...">

    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>Tanggal & Jam</th>
                    <th>Order ID</th>
                    <th>Film</th>
                    <th>Kursi</th>
                    <th>Total</th>
                    <th>Metode</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody id="orderTable">
                <?php if (empty($orders)): ?>
                    <tr>
                        <td colspan="7" class="text-center text-muted">
                            Belum ada transaksi
                        </td>
                    </tr>
                <?php endif; ?>

                <?php foreach ($orders as $o): ?>
                <tr>
                    <td>
                        <strong><?= $o['tanggal'] ?></strong><br>
                        <small class="text-muted"><?= $o['jam'] ?></small>
                    </td>
                    <td>#<?= $o['id'] ?></td>
                    <td>
                        <strong><?= esc($o['film']) ?></strong><br>
                        <small class="text-muted"><?= esc($o['room']) ?></small>
                    </td>
                    <td>
                        <?php foreach ($o['kursi'] as $k): ?>
                            <span class="badge bg-primary"><?= esc($k) ?></span>
                        <?php endforeach; ?>
                    </td>
                    <td>
                        Rp <?= number_format($o['total'], 0, ',', '.') ?>
                    </td>
                    <td><?= esc($o['metode']) ?></td>
                    <td>
                        <?php if ($o['status'] === 'Berhasil'): ?>
                            <span class="badge bg-success">Berhasil</span>
                        <?php else: ?>
                            <span class="badge bg-danger">Dibatalkan</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div>

<script>
document.getElementById('search').addEventListener('keyup', function () {
    const value = this.value.toLowerCase();
    document.querySelectorAll('#orderTable tr').forEach(row => {
        row.style.display = row.innerText.toLowerCase().includes(value)
            ? ''
            : 'none';
    });
});
</script>

<?= $this->endSection() ?>
