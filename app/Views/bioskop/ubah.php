<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="card">
  <div class="card-header">
    <h4>Ubah Data Bioskop</h4>
  </div>

  <div class="card-body">
    <form action="<?= base_url('bioskop/update/' . $data->id_bioskop) ?>" method="post">
      <?= csrf_field() ?>

      <div class="form-group mb-3">
        <label>Nama Bioskop</label>
        <input type="text" name="nama_bioskop" class="form-control"
               value="<?= esc($data->nama_bioskop) ?>" required>
      </div>

      <div class="form-group mb-3">
        <label>Alamat</label>
        <input type="text" name="alamat" class="form-control"
               value="<?= esc($data->alamat) ?>" required>
      </div>

      <div class="form-group mb-3">
        <label>Kota</label>
        <input type="text" name="kota" class="form-control"
               value="<?= esc($data->kota) ?>" required>
      </div>

      <div class="form-group mb-3">
        <label>Telepon</label>
        <input type="text" name="telepon" class="form-control"
               value="<?= esc($data->telepon) ?>">
      </div>

      <div class="form-group mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control"
               value="<?= esc($data->email) ?>">
      </div>

      <div class="form-group mb-3">
        <label>Website</label>
        <input type="text" name="website" class="form-control"
               value="<?= esc($data->website) ?>">
      </div>

      <div class="form-group mb-3">
        <label>Jam Buka</label>
        <input type="time" name="jam_buka" class="form-control"
               value="<?= esc($data->jam_buka) ?>">
      </div>

      <div class="form-group mb-4">
        <label>Jam Tutup</label>
        <input type="time" name="jam_tutup" class="form-control"
               value="<?= esc($data->jam_tutup) ?>">
      </div>

      <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
      <a href="<?= base_url('bioskop') ?>" class="btn btn-secondary">Kembali</a>
    </form>
  </div>
</div>

<?= $this->endSection() ?>
