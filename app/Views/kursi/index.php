<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<style>
  .table-premium thead {
    background: #f8f9fa;
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

      <form action="<?= base_url('kursi/add') ?>" method="post">
        <?= csrf_field() ?>

        <div class="d-flex justify-content-between align-items-center mb-4">
          <h4 class="fw-semibold">Tambah Kursi</h4>
        </div>

        <div class="mb-3">
          <label class="form-label fw-semibold">Room</label>
          <select name="id_room" class="form-control" required>
            <option value="">-- Pilih Room --</option>
            <?php foreach ($room as $r): ?>
              <option value="<?= $r->id_room ?>">
                <?= $r->nama_room ?> (Kapasitas: <?= $r->kapasitas ?>)
              </option>
            <?php endforeach ?>
          </select>
        </div>

        <div class="mb-3">
          <label class="form-label fw-semibold">Kode Kursi</label>
          <input type="text" name="kode_kursi" class="form-control"
                 placeholder="A1, B2, C10" required>
        </div>

        <div class="mb-3">
          <label class="form-label fw-semibold">Status</label>
          <select name="status" class="form-control" required>
            <option value="0">Kosong</option>
            <option value="1">Terisi</option>
          </select>
        </div>

        <div class="modal-footer">
          <button class="btn btn-secondary">Batal</button>
          <button class="btn btn-primary">Simpan</button>
        </div>

      </form>

    </div>
  </div>


  <div class="col-md-8">
    <div class="card p-4 shadow-sm">

      <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-semibold">Daftar Kursi</h4>
      </div>

      <table class="table table-premium align-middle">
        <thead>
          <tr>
            <th>No</th>
            <th>Room</th>
            <th>Kode Kursi</th>
            <th>Status</th>
            <th style="width: 120px;" class="text-center">Aksi</th>
          </tr>
        </thead>

        <tbody>
          <?php if (!empty($data)): ?>
            <?php $no = 1; foreach ($data as $k): ?>
              <tr>
                <td><?= $no++ ?></td>
                <td><?= esc($k->id_room) ?></td>
                <td class="fw-semibold"><?= esc($k->kode_kursi) ?></td>

                <td>
                  <?php if ($k->status == '0'): ?>
                    <span class="badge bg-success">Tersedia</span>
                  <?php else: ?>
                    <span class="badge bg-danger">Terisi</span>
                  <?php endif ?>
                </td>

                <td class="text-center">

                  <button class="btn btn-outline-primary action-btn me-2"
                    data-bs-toggle="modal"
                    data-bs-target="#modalUbah"
                    onclick='editKursi(<?= json_encode($k) ?>)'>
                    <i data-feather="edit"></i>
                  </button>

                  <button class="btn btn-outline-danger action-btn"
                          onclick="hapusKursi(<?= $k->id_kursi ?>)">
                    <i data-feather="trash-2"></i>
                  </button>

                </td>
              </tr>
            <?php endforeach ?>

          <?php else: ?>
            <tr>
              <td colspan="5" class="text-center py-3 text-muted">
                Belum ada data kursi.
              </td>
            </tr>
          <?php endif ?>
        </tbody>

      </table>

    </div>
  </div>
</div>


<div class="modal fade" id="modalUbah" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title fw-semibold">Ubah Kursi</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <form id="formUbah" method="post">
        <?= csrf_field() ?>

        <div class="modal-body">

          <div class="mb-3">
            <label class="form-label fw-semibold">Room</label>
            <input type="number" name="id_room" id="u-room" class="form-control" required>
          </div>

          <div class="mb-3">
            <label class="form-label fw-semibold">Kode Kursi</label>
            <input type="text" name="kode_kursi" id="u-kode" class="form-control" required>
          </div>

          <div class="mb-3">
            <label class="form-label fw-semibold">Status</label>
            <select name="status" id="u-status" class="form-control">
              <option value="tersedia">Tersedia</option>
              <option value="terisi">Terisi</option>
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
  function editKursi(k) {
    document.getElementById('u-room').value = k.id_room;
    document.getElementById('u-kode').value = k.kode_kursi;
    document.getElementById('u-status').value = k.status;
    document.getElementById('formUbah').action =
      "<?= base_url('kursi/update') ?>/" + k.id_kursi;
  }

  function hapusKursi(id) {
    Swal.fire({
      title: 'Hapus Kursi?',
      text: "Data kursi akan dihapus permanen!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#6c757d',
      confirmButtonText: 'Hapus'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = "<?= base_url('kursi/hapus') ?>/" + id;
      }
    });
  }

  feather.replace();
</script>

<?= $this->endSection() ?>
