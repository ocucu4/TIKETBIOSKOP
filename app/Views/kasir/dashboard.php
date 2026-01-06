<?= $this->extend('layoutkasir/template') ?>
<?= $this->section('content') ?>

<div class="min-h-screen p-8" style="background-color:#0F0F0F">
  <div class="max-w-7xl mx-auto">

    <!-- Header -->
    <div class="mb-12 flex justify-between items-start">
      <div>
        <h1 style="color:#FFFFFF">Cinema Cashier</h1>
        <p style="color:#B5B5B5" class="mt-2">
          <?= date('l, d F Y') ?> • Welcome, Kasir
        </p>
      </div>

      <a href="<?= base_url('logout') ?>"
         class="flex items-center gap-2 px-4 py-2 rounded-lg"
         style="background-color:#1A1A1A;color:#FFFFFF">
        Logout
      </a>
    </div>

    <!-- Summary -->
    <div class="grid grid-cols-2 gap-6 mb-12">

      <div class="p-6 rounded-lg" style="background:#1A1A1A;border:1px solid #2A2A2A">
        <h3 style="color:#B5B5B5">Daily Transactions</h3>
        <p style="color:#FFFFFF;font-size:2.5rem">0</p>
      </div>

      <div class="p-6 rounded-lg" style="background:#1A1A1A;border:1px solid #2A2A2A">
        <h3 style="color:#B5B5B5">Total Revenue Today</h3>
        <p style="color:#FFFFFF;font-size:2.5rem">Rp 0</p>
      </div>

    </div>

    <!-- Start Transaction -->
    <div class="flex justify-center">
      <a href="<?= base_url('kasir/jadwal') ?>"
         class="px-12 py-6 rounded-lg"
         style="background:#FFFFFF;color:#0F0F0F;font-size:1.25rem;font-weight:600">
        Start Transaction
      </a>
    </div>

  </div>
</div>

<?= $this->endSection() ?>
