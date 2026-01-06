<?= $this->extend('layoutkasir/template') ?>
<?= $this->section('content') ?>

<div class="min-h-screen p-8" style="background-color:#0F0F0F">
  <div class="max-w-7xl mx-auto">

    <!-- Header -->
    <div class="flex items-center gap-4 mb-8">
      <a href="<?= base_url('kasir/dashboard') ?>"
         class="p-2 rounded-lg hover:opacity-70"
         style="background-color:#1A1A1A;color:#FFFFFF">
        ←
      </a>
      <h1 style="color:#FFFFFF">Select Showtime</h1>
    </div>

    <!-- Showtimes Grid -->
    <div class="grid grid-cols-2 gap-4">

      <?php
      // DATA SEMENTARA (ganti dari DB nanti)
      $showtimes = [
        ['id'=>1,'movie'=>'DUNE: PART TWO','room'=>'Studio 1','time'=>'14:00','price'=>50000],
        ['id'=>2,'movie'=>'DUNE: PART TWO','room'=>'Studio 2','time'=>'17:30','price'=>50000],
        ['id'=>3,'movie'=>'OPPENHEIMER','room'=>'Studio 1','time'=>'19:00','price'=>60000],
        ['id'=>4,'movie'=>'THE BATMAN','room'=>'Studio 3','time'=>'20:30','price'=>55000],
        ['id'=>5,'movie'=>'KILLERS OF THE FLOWER MOON','room'=>'Studio 2','time'=>'21:00','price'=>65000],
        ['id'=>6,'movie'=>'POOR THINGS','room'=>'Studio 1','time'=>'22:00','price'=>55000],
      ];
      ?>

      <?php foreach ($showtimes as $s): ?>
        <div class="p-6 rounded-lg"
             style="background:#1A1A1A;border:1px solid #2A2A2A">

          <div class="mb-4">
            <h2 style="color:#FFFFFF;font-size:1.25rem;font-weight:600">
              <?= esc($s['movie']) ?>
            </h2>
            <p style="color:#B5B5B5"><?= esc($s['room']) ?></p>
          </div>

          <div class="flex items-center gap-2 mb-4 pb-4"
               style="border-bottom:1px solid #2A2A2A;color:#B5B5B5">
            ⏰ <?= esc($s['time']) ?>
          </div>

          <div class="flex items-center justify-between">
            <div>
              <p style="color:#B5B5B5;font-size:.875rem">Ticket Price</p>
              <p style="color:#FFFFFF;font-size:1.25rem;font-weight:600">
                Rp <?= number_format($s['price'],0,',','.') ?>
              </p>
            </div>

            <a href="<?= base_url('kasir/kursi/'.$s['id']) ?>"
               class="px-8 py-3 rounded-lg hover:opacity-90"
               style="background:#FFFFFF;color:#0F0F0F;font-weight:600">
              Select
            </a>
          </div>

        </div>
      <?php endforeach ?>

    </div>
  </div>
</div>

<?= $this->endSection() ?>
