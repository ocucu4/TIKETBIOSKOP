<?= $this->extend('kasir/layout/main') ?>
<?= $this->section('content') ?>

<div class="container py-5" style="max-width: 720px">

  <div class="card p-5 text-center shadow-sm">

    <div class="mb-4">
      <div class="d-inline-flex align-items-center justify-content-center
                  bg-warning bg-opacity-25 rounded-circle mb-3"
           style="width:100px;height:100px;font-size:42px;">
        💳
      </div>

      <h3 class="fw-bold">Konfirmasi Pembayaran</h3>
      <p class="text-muted fs-6">
        Metode: <strong><?= esc($metode) ?></strong>
      </p>
    </div>

    <?php if ($metode === 'QRIS'): ?>
      <div class="mb-4">
        <h6 class="fw-bold mb-2">Scan QRIS</h6>
        <img src="<?= base_url('assets/img/qris_dummy.png') ?>"
             alt="QRIS"
             style="max-width:220px">
        <p class="small text-muted mt-2">
          Minta customer scan QR code QRIS di atas
        </p>
      </div>

    <?php elseif ($metode === 'E-Wallet'): ?>
      <div class="mb-4">
        <h6 class="fw-bold mb-2">E-Wallet</h6>
        <img src="<?= base_url('assets/img/ewallet_dummy.png') ?>"
             alt="E-Wallet"
             style="max-width:200px">
        <p class="small">
          No E-Wallet: <strong>0812-3456-7890</strong><br>
          a.n <strong>MYCINEMA</strong>
        </p>
      </div>

    <?php elseif ($metode === 'Transfer Bank'): ?>
      <div class="mb-4">
        <h6 class="fw-bold mb-2">Transfer Bank</h6>
        <div class="bg-light p-3 rounded d-inline-block text-start">
          <div><strong>Bank BCA</strong></div>
          <div>No Rekening: <strong>1234567890</strong></div>
          <div>a.n <strong>MYCINEMA</strong></div>
        </div>
      </div>

    <?php else: ?>
      <div class="mb-4">
        <h6 class="fw-bold mb-2">Debit / Kredit</h6>
        <p class="text-muted">
          Silakan proses pembayaran melalui mesin EDC.
        </p>
      </div>
    <?php endif; ?>

    <div class="row g-3 mt-4">

      <div class="col-md-6">
        <form action="<?= base_url('kasir/verifikasi/berhasil') ?>" method="post">
          <?= csrf_field() ?>
          <input type="hidden" name="id_order" value="<?= $id_order ?>">
          <button class="btn btn-success w-100 py-3 fw-bold">
            ✔ YA, PEMBAYARAN BERHASIL
          </button>
        </form>
      </div>

      <div class="col-md-6">
        <form action="<?= base_url('kasir/verifikasi/batal') ?>" method="post">
          <?= csrf_field() ?>
          <input type="hidden" name="id_order" value="<?= $id_order ?>">
          <button class="btn btn-danger w-100 py-3 fw-bold">
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
