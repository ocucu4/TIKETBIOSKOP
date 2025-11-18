<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="card">
  <div class="card-header">
    <h4>Ubah Pembayaran</h4>
  </div>

  <div class="card-body">
    <form action="<?= base_url('pembayaran/update') ?>" method="post">

      <input type="hidden" name="id_pembayaran" value="<?= $row->id_pembayaran ?>">

      <div class="mb-3">
        <label>ID Order</label>
        <input type="number" name="id_order" class="form-control" value="<?= $row->id_order ?>">
      </div>

      <div class="mb-3">
        <label>Metode Bayar</label>
        <select name="metode_bayar" class="form-control">
          <option value="cash" <?= $row->metode_bayar=='cash'?'selected':'' ?>>Cash</option>
          <option value="transfer" <?= $row->metode_bayar=='transfer'?'selected':'' ?>>Transfer</option>
          <option value="ewallet" <?= $row->metode_bayar=='ewallet'?'selected':'' ?>>E-Wallet</option>
        </select>
      </div>

      <div class="mb-3">
        <label>Tanggal Bayar</label>
        <input type="datetime-local" name="tanggal_bayar" 
               class="form-control" 
               value="<?= date('Y-m-d\TH:i', strtotime($row->tanggal_bayar)) ?>">
      </div>

      <div class="mb-3">
        <label>Jumlah Bayar</label>
        <input type="number" name="jumlah_bayar" 
               value="<?= $row->jumlah_bayar ?>" class="form-control">
      </div>

      <div class="mb-3">
        <label>Keterangan</label>
        <select name="keterangan" class="form-control">
          <option value="Belum lunas" <?= ($row->keterangan == 'Belum lunas') ? 'selected' : '' ?>>Belum lunas</option>
          <option value="Lunas" <?= ($row->keterangan == 'Lunas') ? 'selected' : '' ?>>Lunas</option>
          <option value="Menunggu konfirmasi" <?= ($row->keterangan == 'Menunggu konfirmasi') ? 'selected' : '' ?>>Menunggu konfirmasi</option>
      </select>
      </div>
      <button class="btn btn-primary">Update</button>
    </form>
  </div>
</div>

<?= $this->endSection() ?>
