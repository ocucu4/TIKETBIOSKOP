<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="card">
  <div class="card-header">
    <h4>Daftar Bioskop</h4>
  </div>

  <div class="card-body">
    <a href="<?= base_url('bioskop/tambah') ?>" class="btn btn-primary mb-3">Tambah Bioskop</a>
    
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
            <?php $no = 1; foreach ($data as $b): ?>
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
                <a href="<?= base_url('bioskop/ubah/'.$b->id_bioskop) ?>" 
                   class="btn btn-outline-primary action-circle">
                    <i data-feather="edit"></i>
                </a>

                <button onclick="hapusData(<?= $b->id_bioskop ?>)" 
                        class="btn btn-outline-danger action-circle" type="button">
                    <i data-feather="trash-2"></i>
                </button>
              </td>
            </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="10" class="text-center text-muted">Belum ada data bioskop.</td>
            </tr>
          <?php endif; ?>
        </tbody>

      </table>
    </div>

  </div>
</div>

<script>
function hapusData(id) {
    Swal.fire({
        title: 'Hapus Bioskop?',
        text: "Data ini akan dihapus permanen!",
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
