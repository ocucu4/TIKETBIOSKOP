<?= $this->extend('kasir/layout/main') ?>
<?= $this->section('content') ?>

<div class="container py-4">

    <h3 class="fw-bold mb-4">Dashboard Kasir</h3>

    <div class="row g-4 mb-4">

        <div class="col-md-6">
            <a href="<?= base_url('kasir/pilih-film') ?>"
               class="card text-decoration-none shadow-sm h-100">
                <div class="card-body text-center">
                    <h5 class="fw-semibold">🎬 Mulai Order</h5>
                    <p class="text-muted mb-0">
                        Pilih film & kursi pelanggan
                    </p>
                </div>
            </a>
        </div>

        <div class="col-md-6">
            <a href="<?= base_url('kasir/riwayat') ?>"
               class="card text-decoration-none shadow-sm h-100">
                <div class="card-body text-center">
                    <h5 class="fw-semibold">📜 Riwayat Order</h5>
                    <p class="text-muted mb-0">
                        Lihat transaksi sebelumnya
                    </p>
                </div>
            </a>
        </div>

    </div>

    <div class="row g-3">

    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-body text-center">
                <h6 class="text-muted">Order Hari Ini</h6>
                <h4 class="fw-bold"><?= $orderHariIni ?></h4>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-body text-center">
                <h6 class="text-muted">Berhasil</h6>
                <h4 class="fw-bold"><?= $berhasil ?></h4>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-body text-center">
                <h6 class="text-muted">Gagal / Batal</h6>
                <h4 class="fw-bold text-danger"><?= $batal ?></h4>
            </div>
        </div>
    </div>

</div>

<?= $this->endSection() ?>
