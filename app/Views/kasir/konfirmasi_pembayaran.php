<?= $this->extend('kasir/layout/main') ?>
<?= $this->section('content') ?>

<div class="container py-5" style="max-width: 900px">

  <a href="<?= base_url('kasir/pilih-kursi/'.$id_tayang) ?>"
     class="btn btn-outline-secondary mb-4">
    ← Kembali
  </a>

  <h3 class="fw-bold mb-4 text-center">Konfirmasi & Pembayaran</h3>

  <div class="card mb-4 shadow-sm">
    <div class="card-body">

      <h5 class="fw-bold mb-3">Ringkasan Pesanan</h5>

      <div class="summary-header mb-3">
        <small class="text-muted">Nama Film</small>
        <div class="summary-title"><?= esc($film->judul_film) ?></div>

        <div class="summary-meta">
          <span><i class="bi bi-calendar-event"></i>
            <?= date('d F Y', strtotime($film->tanggal)) ?>
          </span>
          <span><i class="bi bi-clock"></i>
            <?= substr($film->jam_mulai,0,5) ?> WIT
          </span>
          <span><i class="bi bi-door-open"></i>
            <?= esc($film->nama_room) ?>
          </span>
        </div>
      </div>

      <hr class="my-3">

      <div class="mb-3">
        <small class="text-muted">Rincian Harga</small>

        <div class="d-flex justify-content-between mt-2">
          <span>
            Kursi (<?= count($kursiKode) ?> × Rp <?= number_format($film->harga_tiket,0,',','.') ?>)
          </span>
          <span>
            Rp <?= number_format(count($kursiKode) * $film->harga_tiket,0,',','.') ?>
          </span>
        </div>

        <div class="mt-2 d-flex flex-wrap gap-2">
          <?php foreach ($kursiKode as $k): ?>
            <span class="badge bg-primary px-3 py-2">
              <?= esc($k) ?>
            </span>
          <?php endforeach; ?>
        </div>
      </div>
          
      <div class="total-box d-flex justify-content-between align-items-center mt-3">
        <span class="fw-semibold">Total Bayar</span>
        <span class="fs-4 fw-bold text-primary">
          Rp <?= number_format($total_bayar, 0, ',', '.') ?>
        </span>
      </div>

    </div>
  </div>

  <form action="<?= base_url('kasir/proses-pembayaran') ?>" method="post">
    <?= csrf_field() ?>

    <input type="hidden" name="id_tayang" value="<?= $id_tayang ?>">
    <input type="hidden" name="kursi_terpilih" value="<?= implode(',', $kursiId) ?>">
    <input type="hidden" name="total_bayar" value="<?= $total_bayar ?>">

    <div class="card mb-4 shadow-sm">
      <div class="card-body">

        <h5 class="fw-bold mb-3">Pilih Metode Pembayaran</h5>

        <div class="row g-3">
          <?php
          $metode = [
            'QRIS' => 'bi-qr-code',
            'E-Wallet' => 'bi-phone',
            'Transfer Bank' => 'bi-bank',
            'Debit / Kredit' => 'bi-credit-card'
          ];
          foreach ($metode as $label => $icon):
          ?>
            <div class="col-md-6">
              <label class="w-100">
                <input
                  type="radio"
                  name="metode_bayar"
                  value="<?= $label ?>"
                  hidden
                  required
                >
                <div class="metode-bayar-card">
                  <i class="bi <?= $icon ?> fs-2 mb-2 d-block"></i>
                  <?= $label ?>
                </div>
              </label>
            </div>
          <?php endforeach; ?>
        </div>
          
      </div>
    </div>

    <div
      id="finalConfirm"
      class="final-confirm-wrapper d-none">
      <div class="card final-confirm-card shadow-lg">

      <div class="card-body">

      <div class="text-center mb-3">
        <i class="bi bi-shield-lock fs-1 text-success"></i>
      </div>

      <h6 class="fw-bold mb-2 text-center">🔒 Konfirmasi & Proses Pembayaran</h6>

        <div class="small text-muted mb-2">
          Pastikan pesanan berikut sudah benar:
        </div>

        <ul class="list-unstyled small mb-3">
          <li><strong>Film:</strong> <?= esc($film->judul_film) ?></li>
          <li><strong>Kursi:</strong> <?= implode(', ', $kursiKode) ?></li>
          <li><strong>Total:</strong>
          <span class="text-primary fw-bold">
            Rp <?= number_format($total_bayar,0,',','.') ?>
          </span>
          </li>
          <li><strong>Metode:</strong>
            <span id="confirmMetode">-</span>
          </li>
        </ul>

        <button
          type="button"
          id="btnFinalSubmit"
          class="btn btn-success w-100">
          ✔ Ya, Proses Sekarang
        </button>

        <button
          type="button"
          class="btn btn-outline-secondary w-100 mt-2"
          onclick="document.getElementById('finalConfirm').classList.add('d-none')">
          ← Kembali
        </button>

        </div>
      </div>
    </div>

    <button
      type="button"
      id="btnSubmit"
      class="btn btn-primary w-100 py-3 fs-5 fw-semibold"
      disabled>
      <span id="btnText">
        <i class="bi bi-lock-fill me-2"></i>Proses Pembayaran
      </span>
      <span
        id="btnSpinner"
        class="spinner-border spinner-border-sm d-none"
        role="status"
        aria-hidden="true">
      </span>
    </button>

    <a href="<?= base_url('kasir/dashboard') ?>"
       class="btn btn-outline-secondary w-100 mt-2">
      Batalkan
    </a>

  </form>
</div>

<style>
.metode-bayar-card {
  border: 1px solid #e5e7eb;
  border-radius: 14px;
  padding: 28px;
  text-align: center;
  font-weight: 600;
  cursor: pointer;
  transition: all .2s ease;
  background: #fff;
}

.metode-bayar-card:hover {
  border-color: #2563eb;
  background: #f4f8ff;
}

input[type="radio"]:checked + .metode-bayar-card {
  border-color: #2563eb;
  background: #eef5ff;
  color: #2563eb;
  box-shadow: 0 0 0 3px rgba(37,99,235,.15);
}

#btnSubmit:disabled {
  cursor: not-allowed;
  background: #93c5fd;
  border-color: #93c5fd;
}

.summary-header {
  background: linear-gradient(180deg, #f8faff, #ffffff);
  border-left: 4px solid #2563eb;
  border-radius: 12px;
  padding: 16px 18px;
}

.summary-title {
  font-size: 18px;
  font-weight: 700;
  color: #111827;
  margin-top: 2px;
}

.summary-meta {
  display: flex;
  flex-wrap: wrap;
  gap: 16px;
  font-size: 13px;
  color: #374151;
  margin-top: 8px;
}

.summary-meta i {
  color: #2563eb;
  margin-right: 4px;
}

.total-box {
  background: #f0f7ff;
  border-radius: 12px;
  padding: 14px 16px;
}

.badge {
  font-size: 13px;
  padding: 8px 14px;
  border-radius: 999px;
}

.rincian-harga {
  font-size: 14px;
  color: #374151;
}

.final-confirm-wrapper {
  position: fixed;
  inset: 0;
  background: rgba(15, 23, 42, 0.55);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 1050;
  padding: 16px;
}

.final-confirm-card {
  max-width: 420px;
  width: 100%;
  border-radius: 18px;
  animation: popIn .25s ease-out;
}

.final-confirm-card h6 {
  font-size: 16px;
}

@keyframes popIn {
  from {
    transform: scale(.96);
    opacity: 0;
  }
  to {
    transform: scale(1);
    opacity: 1;
  }
}

.final-confirm-card ul li {
  margin-bottom: 6px;
}

.final-confirm-card ul li strong {
  display: inline-block;
  min-width: 70px;
  color: #111827;
}

</style>

<script>
const form = document.querySelector('form');
const btnSubmit = document.getElementById('btnSubmit');
const finalBox = document.getElementById('finalConfirm');
const btnFinal = document.getElementById('btnFinalSubmit');
const confirmMetode = document.getElementById('confirmMetode');
const radios = document.querySelectorAll('input[name="metode_bayar"]');

radios.forEach(radio => {
  radio.addEventListener('change', () => {
    btnSubmit.disabled = false;
  });
});

btnSubmit.addEventListener('click', () => {
  const selected = document.querySelector(
    'input[name="metode_bayar"]:checked'
  );
  if (!selected) return;

  confirmMetode.textContent = selected.value;
  finalBox.classList.remove('d-none');

  document.body.style.overflow = 'hidden';
  btnSubmit.disabled = true;
});

document.querySelectorAll('[onclick]').forEach(btn => {
  btn.addEventListener('click', () => {
    document.body.style.overflow = '';
  });
});

btnFinal.addEventListener('click', () => {
  btnFinal.disabled = true;
  form.submit();
});
</script>

<?= $this->endSection() ?>
