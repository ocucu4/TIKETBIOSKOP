<?= $this->extend('kasir/layout/main') ?>
<?= $this->section('content') ?>

<div class="container py-5" style="max-width: 800px">

    <div class="text-center mb-5">
        <div class="rounded-circle bg-success bg-opacity-10 d-inline-flex align-items-center justify-content-center"
             style="width:100px;height:100px">
            <i class="bi bi-check-circle-fill text-success fs-1"></i>
        </div>

        <h2 class="fw-bold mt-4">Pembayaran Berhasil!</h2>
        <p class="text-muted fs-5">Transaksi telah diproses dengan sukses</p>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-body p-4">

            <div class="text-center mb-4">
                <small class="text-muted">Nomor Order</small>
                <div class="fw-bold fs-3 text-primary">
                    #<?= $order->id_order ?>
                </div>
            </div>

            <hr>

            <p><strong>Film:</strong> <?= esc($order->judul_film) ?></p>
            <p><strong>Tanggal:</strong> <?= $order->tanggal ?></p>
            <p><strong>Jam:</strong> <?= $order->jam_mulai ?></p>
            <p><strong>Studio:</strong> <?= esc($order->nama_room) ?></p>

            <hr>

            <p class="fw-semibold mb-2">Kursi</p>
            <div class="mb-3">
                <?php foreach ($kursi as $k): ?>
                    <span class="badge bg-primary fs-6 me-1 px-3 py-2">
                        <?= esc($k->kode_kursi) ?>
                    </span>
                <?php endforeach; ?>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <span class="fw-semibold">Metode Pembayaran</span>
                <span><?= esc($order->metode_bayar ?? '-') ?></span>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-2 pt-3 border-top">
                <span class="fw-bold fs-5">Total Dibayar</span>
                <span class="fw-bold fs-3 text-success">
                    Rp <?= number_format($order->total_bayar, 0, ',', '.') ?>
                </span>
            </div>

        </div>
    </div>

    <div class="d-grid gap-3">
        <a href="<?= base_url('kasir/cetak-tiket/'.$order->id_order) ?>"
           target="_blank"
           class="btn btn-primary btn-lg">
            🖨 Cetak Tiket
        </a>

        <a href="<?= base_url('kasir/dashboard') ?>"
           class="btn btn-outline-secondary btn-lg">
            ⬅ Kembali ke Dashboard
        </a>
    </div>

</div>

<?= $this->endSection() ?>
