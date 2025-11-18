<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="card">
  <div class="card-header">
    <h4>Tambah Pembayaran</h4>
  </div>

  <div class="card-body">
    <form action="<?= base_url('pembayaran/add') ?>" method="post">

            <div class="mb-3">
          <label>Pilih Order</label>
          <select name="id_order" class="form-control" required>
              <option value="">-- Pilih Order --</option>
              <?php foreach ($orders as $o): ?>
                  <option value="<?= $o->id_order ?>">
                      <?= $o->id_order ?> — <?= $o->nama_pemesan ?>
                  </option>
              <?php endforeach ?>
          </select>
      </div>

      <div class="mb-3">
        <label>Metode Bayar</label>
        <select name="metode_bayar" class="form-control" required>
            <option value="cash">Cash</option>
            <option value="transfer">Transfer</option>
            <option value="ewallet">E-Wallet</option>
        </select>
      </div>

      <div class="mb-3">
        <label>Tanggal Bayar</label>
        <input type="datetime-local" name="tanggal_bayar" class="form-control" required>
      </div>

      <div class="mb-3">
        <label>Jumlah Bayar</label>
        <input type="number" name="jumlah_bayar" class="form-control" required>
      </div>

      <div class="mb-3">
        <label>Keterangan</label>
        <select name="keterangan" class="form-control">
          <option value="Belum lunas">Belum lunas</option>
          <option value="Lunas">Lunas</option>
          <option value="Menunggu konfirmasi">Menunggu konfirmasi</option>
      </select>
      </div>
      <button class="btn btn-primary">Simpan</button>
    </form>
  </div>
</div>

<?= $this->endSection() ?>
