<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="card shadow-sm">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h4 class="fw-bold mb-0">Daftar Bioskop</h4>

    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">
      <i data-feather="plus"></i> Tambah Bioskop
    </button>
  </div>

  <div class="card-body">

    <div class="table-responsive">
      <table class="table table-bordered table-hover align-middle">
        <thead class="table-light">
          <tr>
            <th>No</th>
            <th>Nama Bioskop</th>
            <th class="hide-mobile">Alamat</th>
            <th class="hide-mobile">Kota</th>
            <th class="hide-mobile">Telepon</th>
            <th class="hide-mobile">Email</th>
            <th class="hide-mobile">Website</th>
            <th class="hide-mobile">Jam Buka</th>
            <th class="hide-mobile">Jam Tutup</th>
            <th class="text-center">Aksi</th>
          </tr>
        </thead>

        <tbody>
          <?php if (!empty($data)): ?>
            <?php $no=1; foreach($data as $b): ?>
            <tr>
              <td><?= $no++ ?></td>
              <td><?= esc($b->nama_bioskop) ?></td>
              <td class="hide-mobile"><?= esc($b->alamat) ?></td>
              <td class="hide-mobile"><?= esc($b->kota) ?></td>
              <td class="hide-mobile"><?= esc($b->telepon) ?></td>
              <td class="hide-mobile"><?= esc($b->email) ?></td>
              <td class="hide-mobile"><?= esc($b->website) ?></td>
              <td class="hide-mobile"><?= esc($b->jam_buka) ?></td>
              <td class="hide-mobile"><?= esc($b->jam_tutup) ?></td>

              <td class="text-center">

                <button class="btn btn-outline-primary action-circle"
                        onclick='editModal(<?= json_encode($b, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ?>)'
                        data-bs-toggle="modal" data-bs-target="#modalUbah">
                  <i data-feather="edit"></i>
                </button>

                <button onclick="hapusData(<?= $b->id_bioskop ?>)"
                        class="btn btn-outline-danger action-circle">
                  <i data-feather="trash-2"></i>
                </button>
              </td>
            </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr><td colspan="10" class="text-center">Belum ada data.</td></tr>
          <?php endif; ?>
        </tbody>

      </table>
    </div>

  </div>
</div>


<div class="modal fade" id="modalTambah" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title fw-bold">Tambah Bioskop</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <form action="<?= base_url('bioskop/simpan') ?>" method="post">
        <?= csrf_field() ?>

      <div class="modal-body">

        <div class="row g-3">

          <div class="col-md-6">
            <label class="form-label fw-semibold">Nama Bioskop</label>
            <input type="text" name="nama_bioskop" class="form-control" required>
          </div>

          <div class="col-md-6">
            <label class="form-label fw-semibold">Kota</label>
            <input type="text" name="kota" class="form-control" required>
          </div>

          <div class="col-12">
            <label class="form-label fw-semibold">Alamat</label>
            <textarea name="alamat" class="form-control" rows="2" required></textarea>
          </div>

          <div class="col-md-6">
            <label class="form-label fw-semibold">Telepon</label>
            <input type="text" name="telepon" class="form-control">
          </div>

          <div class="col-md-6">
            <label class="form-label fw-semibold">Email</label>
            <input type="email" name="email" class="form-control">
          </div>

          <div class="col-md-6">
            <label class="form-label fw-semibold">Website</label>
            <input type="text" name="website" class="form-control">
          </div>

          <div class="col-md-3">
            <label class="form-label fw-semibold">Jam Buka</label>
            <input type="time" name="jam_buka" class="form-control">
          </div>

          <div class="col-md-3">
            <label class="form-label fw-semibold">Jam Tutup</label>
            <input type="time" name="jam_tutup" class="form-control">
          </div>

        </div>

      </div>

      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button class="btn btn-success">Simpan</button>
      </div>

      </form>

    </div>
  </div>
</div>

<div class="modal fade" id="modalUbah" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title fw-bold">Ubah Bioskop</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <form id="formUbah" method="post">
        <?= csrf_field() ?>

      <div class="modal-body">

        <div class="row g-3">

          <div class="col-md-6">
            <label class="form-label fw-semibold">Nama Bioskop</label>
            <input type="text" id="u-nama" name="nama_bioskop" class="form-control" required>
          </div>

          <div class="col-md-6">
            <label class="form-label fw-semibold">Kota</label>
            <input type="text" id="u-kota" name="kota" class="form-control" required>
          </div>

          <div class="col-12">
            <label class="form-label fw-semibold">Alamat</label>
            <textarea id="u-alamat" name="alamat" class="form-control" rows="2" required></textarea>
          </div>

          <div class="col-md-6">
            <label class="form-label fw-semibold">Telepon</label>
            <input type="text" id="u-telepon" name="telepon" class="form-control">
          </div>

          <div class="col-md-6">
            <label class="form-label fw-semibold">Email</label>
            <input type="email" id="u-email" name="email" class="form-control">
          </div>

          <div class="col-md-6">
            <label class="form-label fw-semibold">Website</label>
            <input type="text" id="u-website" name="website" class="form-control">
          </div>

          <div class="col-md-3">
            <label class="form-label fw-semibold">Jam Buka</label>
            <input type="time" id="u-buka" name="jam_buka" class="form-control">
          </div>

          <div class="col-md-3">
            <label class="form-label fw-semibold">Jam Tutup</label>
            <input type="time" id="u-tutup" name="jam_tutup" class="form-control">
          </div>

        </div>

      </div>

      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button class="btn btn-primary">Simpan Perubahan</button>
      </div>

      </form>

    </div>
  </div>
</div>

<script>
function editModal(data) {

    document.getElementById('u-nama').value = data.nama_bioskop;
    document.getElementById('u-alamat').value = data.alamat;
    document.getElementById('u-kota').value = data.kota;
    document.getElementById('u-telepon').value = data.telepon;
    document.getElementById('u-email').value = data.email;
    document.getElementById('u-website').value = data.website;
    document.getElementById('u-buka').value = data.jam_buka;
    document.getElementById('u-tutup').value = data.jam_tutup;

    document.getElementById('formUbah').action =
        "<?= base_url('bioskop/update') ?>/" + data.id_bioskop;
}

function hapusData(id) {
    Swal.fire({
        title: 'Hapus Bioskop?',
        text: "Data akan dihapus permanen!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Hapus'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "<?= base_url('bioskop/hapus') ?>/" + id;
        }
    });
}
</script>

<?= $this->endSection() ?>
