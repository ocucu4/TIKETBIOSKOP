<?= $this->extend('layoutkasir/template') ?>
<?= $this->section('content') ?>

<div class="min-h-screen p-8" style="background-color:#0F0F0F">
  <div class="max-w-4xl mx-auto">

    <!-- Header -->
    <div class="flex items-center gap-4 mb-8">
      <a href="<?= base_url('kasir/kursi/1') ?>"
         class="p-2 rounded-lg hover:opacity-70"
         style="background-color:#1A1A1A;color:#FFFFFF">
        ←
      </a>
      <h1 style="color:#FFFFFF">Payment</h1>
    </div>

    <div class="grid grid-cols-2 gap-6">

      <!-- Order Summary -->
      <div class="p-6 rounded-lg"
           style="background:#1A1A1A;border:1px solid #2A2A2A">
        <h2 style="color:#FFFFFF;font-size:1.25rem;margin-bottom:1.5rem">
          Order Summary
        </h2>

        <div class="mb-4 pb-4" style="border-bottom:1px solid #2A2A2A">
          <p style="color:#B5B5B5;font-size:.875rem">Movie</p>
          <p style="color:#FFFFFF">-</p>
        </div>

        <div class="mb-4 pb-4" style="border-bottom:1px solid #2A2A2A">
          <p style="color:#B5B5B5;font-size:.875rem">Studio & Time</p>
          <p style="color:#FFFFFF">-</p>
        </div>

        <div class="mb-4 pb-4" style="border-bottom:1px solid #2A2A2A">
          <p style="color:#B5B5B5;font-size:.875rem">Seats</p>
          <p style="color:#FFFFFF">-</p>
        </div>

        <div>
          <p style="color:#B5B5B5;font-size:.875rem">Total Amount</p>
          <p style="color:#FFFFFF;font-size:1.5rem;font-weight:600">
            Rp 0
          </p>
        </div>
      </div>

      <!-- Payment Method -->
      <div class="p-6 rounded-lg"
           style="background:#1A1A1A;border:1px solid #2A2A2A">
        <h2 style="color:#FFFFFF;font-size:1.25rem;margin-bottom:1.5rem">
          Payment Method
        </h2>

        <div class="space-y-4 mb-8">
          <div class="p-4 rounded-lg"
               style="background:#0F0F0F;border:2px solid #2A2A2A;color:#FFFFFF">
            Cash
          </div>

          <div class="p-4 rounded-lg"
               style="background:#0F0F0F;border:2px solid #2A2A2A;color:#FFFFFF">
            Credit / Debit Card
          </div>
        </div>

        <button
          class="w-full px-6 py-4 rounded-lg"
          style="background:#FFFFFF;color:#0F0F0F;font-weight:600;font-size:1.125rem">
          Confirm Payment
        </button>
      </div>

    </div>
  </div>
</div>

<?= $this->endSection() ?>
