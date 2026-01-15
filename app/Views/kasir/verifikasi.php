<?= $this->extend('kasir/layout/main') ?>
<?= $this->section('content') ?>

<div class="container py-5" style="max-width: 720px">

  <div class="card p-5 text-center shadow-sm">

    <div class="mb-4">
      <div
        class="d-inline-flex align-items-center justify-content-center
               bg-warning bg-opacity-25 rounded-circle mb-3"
        style="width:90px;height:90px;font-size:40px;">
        💳
      </div>

      <h3 class="fw-bold mb-1">Verifikasi Pembayaran</h3>
      <p class="text-muted fs-6 mb-0">
        Metode: <strong><?= esc($metode) ?></strong>
      </p>
    </div>

    <?php if ($metode === 'QRIS'): ?>
      <div class="mb-4">
        <h6 class="fw-bold mb-3">Scan QRIS</h6>

        <div class="qr-box mb-2">
          <img
            src="https://api.qrserver.com/v1/create-qr-code/?size=220x220&data=QRIS-DUMMY-MYCINEMA"
            alt="QRIS Dummy">
        </div>

        <div id="countdown" class="fw-bold text-danger mt-3 fs-5"></div>

        <p class="small text-muted">
          Minta customer scan QRIS di atas untuk melakukan pembayaran.
        </p>
      </div>

    <?php elseif ($metode === 'E-Wallet'): ?>
      <div class="mb-4">
        <h6 class="fw-bold mb-3">E-Wallet</h6>

        <div class="qr-box mb-2">
          <img
            src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=EWALLET-081234567890"
            alt="E-Wallet Dummy">
        </div>

        <p class="small">
          No E-Wallet: <strong>0812-3456-7890</strong><br>
          a.n <strong>MYCINEMA</strong>
        </p>
      </div>

    <?php elseif ($metode === 'Transfer Bank'): ?>
      <div class="mb-4">
        <h6 class="fw-bold mb-3">Transfer Bank</h6>

        <div class="bank-box text-start">
          <div><strong>Bank BCA</strong></div>
          <div>No Rekening: <strong>1234567890</strong></div>
          <div>a.n <strong>MYCINEMA</strong></div>
        </div>
      </div>

    <?php else: ?>
      <div class="mb-4">
        <h6 class="fw-bold mb-2">Debit / Kredit</h6>
        <p class="text-muted">
          Silakan proses pembayaran menggunakan mesin EDC.
        </p>
      </div>
    <?php endif; ?>

    <div class="row g-3 mt-4">

      <div class="col-md-6">
        <form action="<?= base_url('kasir/verifikasi/berhasil') ?>" method="post">
          <?= csrf_field() ?>
          <input type="hidden" name="id_order" value="<?= esc($id_order) ?>">
          <button class="btn btn-success w-100 py-3 fw-bold">
            ✔ Pembayaran Berhasil
          </button>
        </form>
      </div>

      <div class="col-md-6">
        <form action="<?= base_url('kasir/verifikasi/batal') ?>" method="post">
          <?= csrf_field() ?>
          <input type="hidden" name="id_order" value="<?= esc($id_order) ?>">
          <button class="btn btn-danger w-100 py-3 fw-bold">
            ✖ Belum Dibayar
          </button>
        </form>
      </div>

      <form
        id="autoBatalForm"
        action="<?= base_url('kasir/verifikasi/batal') ?>"
        method="post"
        class="d-none">
        <?= csrf_field() ?>
        <input type="hidden" name="id_order" value="<?= esc($id_order) ?>">
      </form>

    </div>

    <div class="mt-4 p-3 bg-light rounded">
      <small class="text-muted">
        Pastikan pembayaran benar-benar diterima sebelum menekan tombol
        <strong>Pembayaran Berhasil</strong>.
      </small>
    </div>

  </div>
</div>

<style>
.qr-box {
  display: inline-block;
  padding: 12px;
  background: #fff;
  border-radius: 14px;
  box-shadow: 0 6px 20px rgba(0,0,0,.12);
}

.bank-box {
  background: #f8fafc;
  border-radius: 12px;
  padding: 16px 18px;
  display: inline-block;
  font-size: 14px;
}
</style>

<script>
let timeLeft = <?= $sisaDetik ?>;

const countdownEl = document.getElementById('countdown');

const timer = setInterval(() => {
  const minutes = Math.floor(timeLeft / 60);
  const seconds = timeLeft % 60;

  countdownEl.textContent =
    `Sisa waktu: ${String(minutes).padStart(2,'0')}:${String(seconds).padStart(2,'0')}`;

  if (timeLeft <= 0) {
    clearInterval(timer);
    document.getElementById('autoBatalForm').submit();
  }

  timeLeft--;
}, 1000);
</script>

<?= $this->endSection() ?>
