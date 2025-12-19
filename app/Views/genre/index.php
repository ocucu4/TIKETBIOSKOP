<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<style>
  .table-premium thead {
    background: #fdfeffff;
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
      <form action="<?= base_url('genre/add') ?>" method="post">
        <?= csrf_field() ?>
        <div class="d-flex justify-content-between align-items-center mb-4">
          <h4 class="fw-semibold">Tambah Genre</h4>
        </div>

        <div class="mb-3">
          <label class="form-label fw-semibold">Nama Genre</label>
          <input type="text" name="nama_genre" class="form-control"
            placeholder="Contoh: Action, Drama, Komedi" required>
        </div>

        <div class="modal-footer">
          <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button class="btn btn-primary">Simpan</button>
        </div>

      </form>
    </div>
  </div>
  <div class="col-md-8">
    <div class="card p-4 shadow-sm">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-semibold">Daftar Genre</h4>
      </div>
      <table class="table table-premium align-middle">
        <thead>
          <tr>
            <th style="width: 70px;">No</th>
            <th>Nama Genre</th>
            <th style="width: 120px;" class="text-center">Aksi</th>
          </tr>
        </thead>

        <tbody>
          <?php if (!empty($data)): ?>
            <?php $no = 1;
            foreach ($data as $g): ?>
              <tr>
                <td><?= $no++ ?></td>

                <td class="fw-semibold"><?= esc($g->nama_genre) ?></td>

                <td class="text-center">

                  <button class="btn btn-outline-primary action-btn me-2"
                    data-bs-toggle="modal"
                    data-bs-target="#modalUbah"
                    onclick='editGenre(<?= json_encode($g) ?>)'>
                    <i data-feather="edit"></i>
                  </button>

                  <button class="btn btn-outline-danger action-btn"
                    onclick="hapusGenre(<?= $g->id_genre ?>)">
                    <i data-feather="trash-2"></i>
                  </button>

                </td>
              </tr>
            <?php endforeach; ?>

          <?php else: ?>
            <tr>
              <td colspan="3" class="text-center py-3 text-muted">
                Belum ada data genre.
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
        <h5 class="modal-title fw-semibold">Ubah Genre</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <form id="formUbah" method="post">
        <?= csrf_field() ?>

        <div class="modal-body">

          <div class="mb-3">
            <label class="form-label fw-semibold">Nama Genre</label>
            <input type="text" name="nama_genre" id="u-genre" class="form-control" required>
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
  function editGenre(g) {
    document.getElementById('u-genre').value = g.nama_genre;
    document.getElementById('formUbah').action =
      "<?= base_url('genre/update') ?>/" + g.id_genre;
  }

  function hapusGenre(id) {
    Swal.fire({
      title: 'Hapus Genre?',
      text: "Data genre akan dihapus permanen!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#6c757d',
      confirmButtonText: 'Hapus'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = "<?= base_url('genre/delete') ?>/" + id;
      }
    });
  }

  feather.replace();
</script>

<?= $this->endSection() ?>