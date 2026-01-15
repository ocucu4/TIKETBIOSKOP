<?= $this->extend('kasir/layout/main') ?>
<?= $this->section('content') ?>

<div class="container py-5" style="max-width: 800px">

  <div class="text-center mb-5">
    <div class="rounded-circle bg-danger bg-opacity-10
                d-inline-flex align-items-center justify-content-center"
         style="width:100px;height:100px">
      <i class="bi bi-x-circle-fill text-danger fs-1"></i>
    </div>

    <h2 class="fw-bold mt-4">Transaksi Dibatalkan</h2>
    <p class="text-muted fs-5">
      Pembayaran tidak diselesaikan
    </p>
  </div>

  <div class="card shadow-sm">
    <div class="card-body p-4 text-center">
      <p class="fs-6 mb-0">
        Kursi telah dikembalikan dan transaksi dicatat
        dalam riwayat.
      </p>
    </div>
  </div>

  <div class="d-grid gap-3 mt-4">
    <a href="<?= base_url('kasir/dashboard') ?>"
       class="btn btn-outline-secondary btn-lg">
      ⬅ Kembali ke Dashboard
    </a>
  </div>

</div>

<?= $this->endSection() ?>
