<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="card">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h4>Pembayaran</h4>
    <a href="<?= base_url('pembayaran/tambah') ?>" class="btn btn-primary">Tambah Pembayaran</a>
  </div>

  <div class="card-body">
    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>No</th>
          <th>ID Order</th>
          <th>Metode Bayar</th>
          <th>Tanggal Bayar</th>
          <th>Jumlah Bayar</th>
          <th>Keterangan</th>
          <th>Aksi</th>
        </tr>
      </thead>

      <tbody>
        <?php if (!empty($data)): ?>
        <?php $no = 1; foreach($data as $row): ?>
        <tr>
          <td><?= $no++ ?></td>
          <td><?= esc($row->id_order) ?></td>
          <td><?= esc($row->metode_bayar) ?></td>
          <td><?= esc($row->tanggal_bayar) ?></td>
          <td>Rp <?= number_format($row->jumlah_bayar,0,',','.') ?></td>
          <td><?= esc($row->keterangan) ?></td>

          <td>
            <a href="<?= base_url('pembayaran/ubah/'.$row->id_pembayaran) ?>" 
               class="btn btn-outline-primary action-circle">
              <i data-feather="edit"></i>
            </a>

            <button onclick="hapusData(<?= $row->id_pembayaran ?>)" 
                    class="btn btn-outline-danger action-circle">
              <i data-feather="trash-2"></i>
            </button>
          </td>
        </tr>
        <?php endforeach; else: ?>
        <tr><td colspan="7" class="text-center">Belum ada pembayaran.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<script>
function hapusData(id){
  Swal.fire({
      title: "Hapus data?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#e63946",
      cancelButtonColor: "#6c757d",
      confirmButtonText: "Ya, hapus"
    }).then((result) => {
      if (result.isConfirmed) {
          window.location.href = "<?= base_url('pembayaran/hapus/') ?>" + id;
      }
  });
}
</script>

<?= $this->endSection() ?>
