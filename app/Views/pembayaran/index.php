<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="card">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h4>Pembayaran</h4>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAdd">
      Tambah Pembayaran
    </button>
  </div>

  <div class="card-body table-responsive">

    <?php if (session()->getFlashdata('success')): ?>
      <div class="alert alert-success alert-dismissible fade show">
        <?= session()->getFlashdata('success') ?>
        <button class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    <?php endif ?>

    <?php if (session()->getFlashdata('error')): ?>
      <div class="alert alert-danger alert-dismissible fade show">
        <?= session()->getFlashdata('error') ?>
        <button class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    <?php endif ?>

    <table class="table table-hover align-middle text-center">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama Pemesan</th>
          <th>Metode</th>
          <th>Tanggal Bayar</th>
          <th>Jumlah Bayar</th>
          <th>Keterangan</th>
          <th>Aksi</th>
        </tr>
      </thead>

      <tbody>
        <?php if (!empty($data)): ?>
          <?php foreach ($data as $i => $row): ?>
          <tr>
            <td><?= $i+1 ?></td>
            <td><?= esc($row->nama_pemesan) ?> (Order #<?= $row->id_order ?>)</td>
            <td><?= esc($row->metode_bayar) ?></td>
            <td><?= esc($row->tanggal_bayar) ?></td>
            <td>Rp <?= number_format($row->jumlah_bayar,0,',','.') ?></td>
            <td><?= esc($row->keterangan) ?></td>
            <td>
              <button class="btn btn-sm btn-outline-primary"
                      onclick='editPembayaran(<?= json_encode($row) ?>)'>
                <i data-feather="edit"></i>
              </button>
              <a href="<?= base_url('pembayaran/delete/'.$row->id_pembayaran) ?>"
                 onclick="return confirm('Hapus pembayaran ini?')"
                 class="btn btn-sm btn-outline-danger">
                <i data-feather="trash-2"></i>
              </a>
            </td>
          </tr>
          <?php endforeach ?>
        <?php else: ?>
          <tr><td colspan="7" class="text-muted">Belum ada pembayaran.</td></tr>
        <?php endif ?>
      </tbody>
    </table>
  </div>
</div>

<!-- MODAL TAMBAH -->
<div class="modal fade" id="modalAdd" tabindex="-1">
  <div class="modal-dialog">
    <form class="modal-content" method="post" action="<?= base_url('pembayaran/add') ?>">
      <?= csrf_field() ?>
      <div class="modal-header">
        <h5 class="modal-title">Tambah Pembayaran</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <div class="mb-3">
          <label class="form-label">Order</label>
          <select name="id_order" class="form-select" required>
            <option value="">-- Pilih Order --</option>
            <?php foreach ($orders as $o): ?>
              <option value="<?= $o->id_order ?>">
                #<?= $o->id_order ?> — <?= esc($o->nama_pemesan) ?>
              </option>
            <?php endforeach ?>
          </select>
        </div>

        <div class="mb-3">
          <label class="form-label">Metode Bayar</label>
          <select name="metode_bayar" class="form-select" required>
            <option value="cash">Cash</option>
            <option value="transfer">Transfer</option>
            <option value="ewallet">E-Wallet</option>
          </select>
        </div>

        <div class="mb-3">
          <label class="form-label">Tanggal Bayar</label>
          <input type="datetime-local" name="tanggal_bayar" class="form-control" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Jumlah Bayar</label>
          <input type="number" name="jumlah_bayar" class="form-control" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Keterangan</label>
          <select name="keterangan" class="form-select">
            <option value="Belum lunas">Belum lunas</option>
            <option value="Lunas">Lunas</option>
            <option value="Menunggu konfirmasi">Menunggu konfirmasi</option>
          </select>
        </div>
      </div>

      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button class="btn btn-primary">Simpan</button>
      </div>
    </form>
  </div>
</div>

<!-- MODAL EDIT -->
<div class="modal fade" id="modalEdit" tabindex="-1">
  <div class="modal-dialog">
    <form class="modal-content" method="post" id="formEdit">
      <?= csrf_field() ?>
      <div class="modal-header">
        <h5 class="modal-title">Ubah Pembayaran</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">

        <input type="hidden" id="e-id" name="id_pembayaran">

        <div class="mb-3">
          <label class="form-label">Metode Bayar</label>
          <select name="metode_bayar" id="e-metode" class="form-select" required>
            <option value="cash">Cash</option>
            <option value="transfer">Transfer</option>
            <option value="ewallet">E-Wallet</option>
          </select>
        </div>

        <div class="mb-3">
          <label class="form-label">Tanggal Bayar</label>
          <input type="datetime-local" name="tanggal_bayar" id="e-tanggal" class="form-control" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Jumlah Bayar</label>
          <input type="number" name="jumlah_bayar" id="e-jumlah" class="form-control" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Keterangan</label>
          <select name="keterangan" id="e-keterangan" class="form-select">
            <option value="Belum lunas">Belum lunas</option>
            <option value="Lunas">Lunas</option>
            <option value="Menunggu konfirmasi">Menunggu konfirmasi</option>
          </select>
        </div>
      </div>

      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button class="btn btn-primary">Update</button>
      </div>
    </form>
  </div>
</div>

<script>
function editPembayaran(p) {
  const form = document.getElementById('formEdit');
  form.action = "<?= base_url('pembayaran/update') ?>/" + p.id_pembayaran;

  document.getElementById('e-id').value         = p.id_pembayaran;
  document.getElementById('e-metode').value     = p.metode_bayar;
  document.getElementById('e-jumlah').value     = p.jumlah_bayar;
  document.getElementById('e-keterangan').value = p.keterangan;

  // format tanggal ke yyyy-MM-ddTHH:mm
  if (p.tanggal_bayar) {
    const dt  = new Date(p.tanggal_bayar.replace(' ', 'T'));
    const yyyy = dt.getFullYear();
    const mm   = String(dt.getMonth()+1).padStart(2,'0');
    const dd   = String(dt.getDate()).padStart(2,'0');
    const hh   = String(dt.getHours()).padStart(2,'0');
    const mi   = String(dt.getMinutes()).padStart(2,'0');
    document.getElementById('e-tanggal').value = `${yyyy}-${mm}-${dd}T${hh}:${mi}`;
  }

  new bootstrap.Modal(document.getElementById('modalEdit')).show();
}

feather.replace();
</script>

<?= $this->endSection() ?>
