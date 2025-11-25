<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<style>
  .table-premium thead {
    background: (90deg, #ffffffff);
    color: white;
    font-weight: bold;
  }

  .table-premium tbody tr:hover {
    background-color: #f0f6ff !important;
  }

  .table-premium {
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 3px 12px rgba(0, 0, 0, 0.08);
  }

  .action-btn {
    width: 38px;
    height: 38px;
    padding: 6px;
    border-radius: 50%;
  }
</style>


<div class="row">
  <div class="col-md-4">

    <div class="card p-4 shadow-sm">

      <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-semibold">Tambah Status Kursi</h4>
      </div>

      <form action="<?= base_url('kursijadwalstatus/simpan') ?>" method="post">
        <?= csrf_field() ?>

        <div class="mb-3">
          <label class="form-label fw-semibold">Kursi</label>
          <select name="id_kursi" class="form-control" required>
            <?php foreach ($kursi as $k): ?>
              <option value="<?= $k->id_kursi ?>"><?= $k->kode_kursi ?></option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="mb-3">
          <label class="form-label fw-semibold">Order</label>
          <select name="id_order" class="form-control">
            <option value="">Tidak Ada</option>
            <?php foreach ($order as $o): ?>
              <option value="<?= $o->id_order ?>">
                Order #<?= $o->id_order ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>


        <div class="mb-3">
          <label class="form-label fw-semibold">Status Kursi</label>
          <select name="status" class="form-control">
            <option value="0">Kosong</option>
            <option value="1">Terisi</option>
          </select>
        </div>

        <button class="btn btn-primary w-100 mt-2">Simpan</button>
      </form>

    </div>
  </div>

  <div class="col-md-8">
    <div class="card p-4 shadow-sm">

      <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-semibold">Daftar Status Kursi</h4>
      </div>

      <table class="table table-premium align-middle">
        <thead>
          <tr>
            <th>No</th>
            <th>Kursi</th>
            <th>Order</th>
            <th>Status</th>
            <th class="text-center">Aksi</th>
          </tr>
        </thead>

        <tbody>
          <?php if (!empty($data)): ?>
            <?php $no = 1; foreach ($data as $d): ?>
              <tr>
                <td><?= $no++ ?></td>

                <td class="fw-semibold"><?= $d->kode_kursi ?></td>

                <td>
                  <?= $d->id_order ? 'Order #'.$d->id_order : '<span class="text-muted">Tidak Ada</span>' ?>
                </td>

                <td>
                  <?php if ($d->status == 1): ?>
                    <span class="badge bg-danger px-3 py-2">Terisi</span>
                  <?php else: ?>
                    <span class="badge bg-success px-3 py-2">Kosong</span>
                  <?php endif; ?>
                </td>

                <td class="text-center">

                  <button class="btn btn-outline-primary action-btn me-2"
                    data-bs-toggle="modal"
                    data-bs-target="#modalUbah"
                    onclick='editStatus(<?= json_encode($d) ?>)'>
                    <i data-feather="edit"></i>
                  </button>

                  <button class="btn btn-outline-danger action-btn"
                    onclick="hapusStatus(<?= $d->id_status ?>)">
                    <i data-feather="trash-2"></i>
                  </button>

                </td>
              </tr>
            <?php endforeach; ?>

          <?php else: ?>
            <tr>
              <td colspan="5" class="text-center py-3 text-muted">
                Belum ada data status kursi.
              </td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>

    </div>
  </div>
</div>

<div class="modal fade" id="modalUbah" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title fw-semibold">Ubah Status Kursi</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <form id="formUbah" method="post">
        <?= csrf_field() ?>

        <div class="modal-body">

          <div class="mb-3">
            <label class="form-label fw-semibold">Kursi</label>
            <select name="id_kursi" id="u-kursi" class="form-control">
              <?php foreach ($kursi as $k): ?>
                <option value="<?= $k->id_kursi ?>"><?= $k->kode_kursi ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label fw-semibold">Order</label>
            <select name="id_order" id="u-order" class="form-control">
              <option value="">Tidak Ada</option>
              <?php foreach ($order as $o): ?>
                <option value="<?= $o->id_order ?>">Order #<?= $o->id_order ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label fw-semibold">Status</label>
            <select name="status" id="u-status" class="form-control">
              <option value="0">Kosong</option>
              <option value="1">Terisi</option>
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
</div>

<script>
  function editStatus(data) {
    document.getElementById('u-kursi').value = data.id_kursi;
    document.getElementById('u-order').value = data.id_order;
    document.getElementById('u-status').value = data.status;

    document.getElementById('formUbah').action =
      "<?= base_url('kursijadwalstatus/update') ?>/" + data.id_status;
  }

  function hapusStatus(id) {
    Swal.fire({
      title: 'Hapus Status?',
      text: "Data status kursi akan dihapus permanen!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#6c757d',
      confirmButtonText: 'Hapus'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = "<?= base_url('kursijadwalstatus/hapus') ?>/" + id;
      }
    });
  }

  feather.replace();
</script>


<?= $this->endSection() ?>
