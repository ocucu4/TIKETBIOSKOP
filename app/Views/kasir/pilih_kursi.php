<?= $this->extend('layoutkasir/template') ?>
<?= $this->section('content') ?>

<div class="min-h-screen p-8" style="background-color:#0F0F0F">
  <div class="max-w-7xl mx-auto">

    <!-- Header -->
    <div class="flex items-center gap-4 mb-8">
      <a href="<?= base_url('kasir/jadwal') ?>"
         class="p-2 rounded-lg hover:opacity-70"
         style="background-color:#1A1A1A;color:#FFFFFF">
        ←
      </a>
      <div>
        <h1 style="color:#FFFFFF">Select Seats</h1>
        <p style="color:#B5B5B5" class="mt-1">
          Film - Studio - Jam
        </p>
      </div>
    </div>

    <div class="flex gap-8">

      <!-- Seat Grid -->
      <div class="flex-1">

        <!-- Screen -->
        <div class="mb-12">
          <div class="py-2 text-center rounded-lg" style="background-color:#1A1A1A">
            <span style="color:#B5B5B5">SCREEN</span>
          </div>
        </div>

        <?php
        // ===== DATA SEMENTARA (NANTI DARI DB) =====
        $rows = ['A','B','C','D','E','F','G','H'];
        $seats = [];
        foreach ($rows as $r) {
          for ($i=1; $i<=10; $i++) {
            $seats[$r][$i] = (rand(0,10) > 7) ? 'occupied' : 'available';
          }
        }
        ?>

        <!-- Seats -->
        <div class="space-y-3">
          <?php foreach ($rows as $row): ?>
            <div class="flex items-center gap-3">
              <span style="color:#B5B5B5;width:24px;font-weight:600">
                <?= $row ?>
              </span>

              <div class="flex gap-2">
                <?php for ($i=1; $i<=10; $i++): 
                  $status = $seats[$row][$i];
                  $style = match($status) {
                    'available' => 'background:#0F0F0F;border:2px solid #FFFFFF;color:#FFFFFF',
                    'occupied'  => 'background:#3A3A3A;border:2px solid #3A3A3A;color:#6A6A6A',
                  };
                ?>
                  <button
                    class="w-12 h-12 rounded-lg flex items-center justify-center"
                    style="<?= $style ?>;font-weight:600"
                    <?= $status === 'occupied' ? 'disabled' : '' ?>>
                    <?= $i ?>
                  </button>
                <?php endfor ?>
              </div>
            </div>
          <?php endforeach ?>
        </div>

        <!-- Legend -->
        <div class="flex items-center gap-6 mt-8">
          <div class="flex items-center gap-2">
            <div class="w-8 h-8 rounded-lg" style="background:#0F0F0F;border:2px solid #FFFFFF"></div>
            <span style="color:#B5B5B5">Available</span>
          </div>
          <div class="flex items-center gap-2">
            <div class="w-8 h-8 rounded-lg" style="background:#3A3A3A"></div>
            <span style="color:#B5B5B5">Occupied</span>
          </div>
        </div>
      </div>

      <!-- Summary Sidebar -->
      <div style="width:320px">
        <div class="p-6 rounded-lg sticky top-8"
             style="background:#1A1A1A;border:1px solid #2A2A2A">

          <h3 style="color:#FFFFFF;margin-bottom:1rem">Order Summary</h3>

          <p style="color:#B5B5B5;font-size:.875rem">Selected Seats</p>
          <p style="color:#FFFFFF">-</p>

          <hr style="border-color:#2A2A2A;margin:1rem 0">

          <p style="color:#B5B5B5;font-size:.875rem">Total Price</p>
          <p style="color:#FFFFFF;font-size:1.5rem;font-weight:600">
            Rp 0
          </p>

          <a href="<?= base_url('kasir/bayar') ?>"
             class="block text-center mt-6 px-6 py-3 rounded-lg"
             style="background:#FFFFFF;color:#0F0F0F;font-weight:600">
            Continue to Payment
          </a>

        </div>
      </div>

    </div>
  </div>
</div>

<?= $this->endSection() ?>
