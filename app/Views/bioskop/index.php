<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="card">
  <div class="card-header">
    <h4>Daftar Bioskop</h4>
  </div>
  <div class="card-body">
    <a href="<?= base_url('bioskop/tambah') ?>" class="btn btn-primary mb-3">Tambah Bioskop</a>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama Bioskop</th>
          <th>Alamat</th>
          <th>Kota</th>
          <th>Telepon</th>
          <th>Email</th>
          <th>Website</th>
          <th>Jam Buka</th>
          <th>Jam Tutup</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($data)): ?>
          <?php $no = 1; foreach ($data as $b): ?>
          <tr>
            <td><?= $no++ ?></td>
            <td><?= esc($b->nama_bioskop) ?></td>
            <td><?= esc($b->alamat) ?></td>
            <td><?= esc($b->kota) ?></td>
            <td><?= esc($b->telepon) ?></td>
            <td><?= esc($b->email) ?></td>
            <td><?= esc($b->website) ?></td>
            <td><?= esc($b->jam_buka) ?></td>
            <td><?= esc($b->jam_tutup) ?></td>
            <td>
              <a href="<?= base_url('bioskop/ubah/'.$b->id_bioskop) ?>" class="btn btn-warning btn-sm">Ubah</a>
              <a href="<?= base_url('bioskop/delete/'.$b->id_bioskop) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus data ini?')">Hapus</a>
            </td>
          </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="10" class="text-center">Belum ada data bioskop.</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<?= $this->endSection() ?>
