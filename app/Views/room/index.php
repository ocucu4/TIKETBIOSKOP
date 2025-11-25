<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<style>
  .table-premium tbody tr:hover { 
    background-color: #f0f6ff !important; 
  }

  .table-premium { 
    border-radius: 12px; 
    overflow: hidden; 
    box-shadow: 0 3px 12px rgba(0,0,0,0.08); 
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

      <form action="<?= base_url('room/add') ?>" method="post">
        <?= csrf_field() ?>

        <div class="d-flex justify-content-between align-items-center mb-4">
          <h4 class="fw-semibold">Tambah Room</h4>
        </div>

        <div class="mb-3">
          <label class="form-label fw-semibold">Nama Room</label>
          <input type="text" name="nama_room" class="form-control" required>
        </div>

        <div class="mb-3">
          <label class="form-label fw-semibold">Kapasitas</label>
          <input type="number" name="kapasitas" class="form-control" required>
        </div>

        <div class="mb-3">
          <label class="form-label fw-semibold">Jadwal Tayang</label>
          <select name="id_tayang" class="form-control" required>
            <option value="">-- Pilih Jadwal --</option>
            <?php foreach ($tayang as $t): ?>
              <option value="<?= $t->id_tayang ?>">
                <?= $t->tanggal ?> (<?= $t->jam_mulai ?> - <?= $t->jam_selesai ?>)
              </option>
            <?php endforeach ?>
          </select>
        </div>

        <div class="modal-footer px-0">
          <button class="btn btn-secondary">Batal</button>
          <button class="btn btn-primary">Simpan</button>
        </div>

      </form>

    </div>
  </div>

  <div class="col-md-8">
    <div class="card p-4 shadow-sm">

      <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-semibold">Daftar Room</h4>
      </div>

      <table class="table table-premium align-middle">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Room</th>
            <th>Kapasitas</th>
            <th>ID Tayang</th>
            <th class="text-center">Aksi</th>
          </tr>
        </thead>

        <tbody>
          <?php if (!empty($data)): ?>
            <?php $no = 1; foreach ($data as $r): ?>
            <tr>
              <td><?= $no++ ?></td>
              <td><?= esc($r->nama_room) ?></td>
              <td><?= esc($r->kapasitas) ?></td>
              <td><?= esc($r->id_tayang) ?></td>

              <td class="text-center">
                <button class="btn btn-outline-primary action-btn me-2"
                        data-bs-toggle="modal"
                        data-bs-target="#modalUbah"
                        onclick='editRoom(<?= json_encode($r) ?>)'>
                  <i data-feather="edit"></i>
                </button>

                <button class="btn btn-outline-danger action-btn"
                        onclick="hapusRoom(<?= $r->id_room ?>)">
                  <i data-feather="trash-2"></i>
                </button>
              </td>
            </tr>
            <?php endforeach ?>
          <?php else: ?>
            <tr>
              <td colspan="5" class="text-center text-muted py-3">Belum ada data room.</td>
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
        <h5 class="modal-title">Ubah Room</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <form id="formUbah" method="post">
        <?= csrf_field() ?>

        <div class="modal-body">

          <div class="mb-3">
            <label class="form-label fw-semibold">Nama Room</label>
            <input type="text" name="nama_room" id="u-room" class="form-control" required>
          </div>

          <div class="mb-3">
            <label class="form-label fw-semibold">Kapasitas</label>
            <input type="number" name="kapasitas" id="u-kapasitas" class="form-control" required>
          </div>

          <div class="mb-3">
            <label class="form-label fw-semibold">Jadwal Tayang</label>
            <select name="id_tayang" id="u-tayang" class="form-control" required>
              <?php foreach ($tayang as $t): ?>
                <option value="<?= $t->id_tayang ?>">
                  <?= $t->tanggal ?> (<?= $t->jam_mulai ?> - <?= $t->jam_selesai ?>)
                </option>
              <?php endforeach ?>
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
  function editRoom(r) {
    document.getElementById('u-room').value    = r.nama_room;
    document.getElementById('u-kapasitas').value = r.kapasitas;
    document.getElementById('u-tayang').value = r.id_tayang;
    document.getElementById('formUbah').action = "<?= base_url('room/update') ?>/" + r.id_room;
  }

  function hapusRoom(id) {
    Swal.fire({
      title: 'Hapus Room?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#6c757d',
      confirmButtonText: 'Hapus'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = "<?= base_url('room/hapus') ?>/" + id;
      }
    });
  }

  feather.replace();
</script>

<?= $this->endSection() ?>
