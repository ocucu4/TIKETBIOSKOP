<?= $this->extend('kasir/layout/main') ?>
<?= $this->section('content') ?>

<div class="container py-5" style="max-width: 900px">

    <a href="<?= base_url('kasir/pilih-kursi/'.$id_tayang) ?>"
       class="btn btn-outline-secondary mb-4">
        ← Kembali
    </a>

    <h3 class="fw-bold mb-4">Konfirmasi & Pembayaran</h3>

    <!-- Ringkasan -->
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="fw-bold mb-3">Ringkasan Pesanan</h5>

            <p class="mb-1"><strong>Film:</strong> <?= esc($film->judul_film) ?></p>
            <p class="mb-1"><strong>Tanggal:</strong> <?= $film->tanggal ?></p>
            <p class="mb-1"><strong>Jam:</strong> <?= $film->jam_mulai ?></p>
            <p class="mb-3"><strong>Room:</strong> <?= esc($film->nama_room) ?></p>

            <hr>

            <p class="fw-semibold mb-2">Kursi Dipilih</p>
            <div class="mb-3">
                <?php foreach ($kursiKode as $k): ?>
                    <span class="badge bg-primary me-1"><?= esc($k) ?></span>
                <?php endforeach; ?>
            </div>

            <div class="d-flex justify-content-between fs-5 fw-bold">
                <span>Total Bayar</span>
                <span class="text-primary">
                    Rp <?= number_format($total_bayar, 0, ',', '.') ?>
                </span>
            </div>
        </div>
    </div>

    <!-- Metode Pembayaran -->
    <form action="<?= base_url('kasir/proses-pembayaran') ?>" method="post">
        <?= csrf_field() ?>

        <input type="hidden" name="id_tayang" value="<?= $id_tayang ?>">
        <input type="hidden" name="kursi" value="<?= implode(',', $kursiId) ?>">
        <input type="hidden" name="total_bayar" value="<?= $total_bayar ?>">

        <div class="card mb-4">
            <div class="card-body">
                <h5 class="fw-bold mb-3">Pilih Metode Pembayaran</h5>

                <div class="row g-3">
                    <?php foreach (['QRIS','E-Wallet','Transfer','Debit/Kredit'] as $m): ?>
                        <div class="col-md-6">
                            <label class="w-100">
                                <input type="radio" name="metode_bayar" value="<?= $m ?>" required hidden>
                                <div class="border rounded p-4 text-center metode-bayar">
                                    <strong><?= $m ?></strong>
                                </div>
                            </label>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <button class="btn btn-primary w-100 py-3 fs-5">
            Proses Pembayaran
        </button>

        <a href="<?= base_url('kasir/dashboard') ?>"
           class="btn btn-outline-danger w-100 mt-2">
            Batalkan
        </a>
    </form>
</div>

<style>
.metode-bayar {
    cursor: pointer;
}
input[type="radio"]:checked + .metode-bayar {
    border-color: #0d6efd;
    background: #eef5ff;
}
</style>

<?= $this->endSection() ?>
