<?= $this->extend('kasir/layout/main') ?>
<?= $this->section('content') ?>

<div class="container py-5" style="max-width: 700px">

    <div class="card p-5 text-center shadow-sm">

        <div class="mb-4">
            <div class="d-inline-flex align-items-center justify-content-center
                        bg-warning bg-opacity-25 rounded-circle mb-3"
                 style="width:100px;height:100px;font-size:48px;">
                💳
            </div>

            <h3 class="fw-bold">Konfirmasi Pembayaran</h3>
            <p class="text-muted fs-5">
                Apakah pembayaran sudah diterima?
            </p>
        </div>

        <div class="row g-3 mt-4">

            <!-- YA -->
            <div class="col-md-6">
                <form action="<?= base_url('kasir/verifikasi/berhasil') ?>" method="post">
                    <?= csrf_field() ?>
                    <input type="hidden" name="id_order" value="<?= $_GET['id_order'] ?? '' ?>">
                    
                    <button class="btn btn-success w-100 py-4 fs-5 fw-bold">
                        ✔ YA, PEMBAYARAN BERHASIL
                    </button>
                </form>
            </div>

            <!-- TIDAK -->
            <div class="col-md-6">
                <form action="<?= base_url('kasir/verifikasi/batal') ?>" method="post">
                    <?= csrf_field() ?>
                    <input type="hidden" name="id_order" value="<?= $_GET['id_order'] ?? '' ?>">

                    <button class="btn btn-danger w-100 py-4 fs-5 fw-bold">
                        ✖ TIDAK, BELUM DIBAYAR
                    </button>
                </form>
            </div>

        </div>

        <div class="mt-4 p-3 bg-light rounded">
            <small class="text-muted">
                Pastikan pembayaran benar-benar diterima sebelum menekan tombol
                <strong>YA</strong>.
            </small>
        </div>

    </div>

</div>

<?= $this->endSection() ?>
