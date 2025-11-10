<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Data Bioskop</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2 class="mb-4 text-center">Ubah Data Bioskop</h2>
    <a href="<?= base_url('bioskop') ?>" class="btn btn-secondary btn-sm mb-3">Kembali</a>

    <form action="<?= base_url('bioskop/update/' . $bioskop->id_bioskop) ?>" method="post">
        <?= csrf_field() ?>
        <input type="hidden" name="id_bioskop" value="<?= $bioskop->id_bioskop ?>">

        <div class="form-group">
            <label for="nama_bioskop">Nama Bioskop</label>
            <input type="text" class="form-control" id="nama_bioskop" name="nama_bioskop" value="<?= esc($bioskop->nama_bioskop) ?>" required>
        </div>

        <div class="form-group">
            <label for="alamat">Alamat</label>
            <textarea class="form-control" id="alamat" name="alamat" rows="3" required><?= esc($bioskop->alamat) ?></textarea>
        </div>

        <div class="form-group">
            <label for="kota">Kota</label>
            <input type="text" class="form-control" id="kota" name="kota" value="<?= esc($bioskop->kota) ?>" required>
        </div>

        <div class="form-group">
            <label for="telepon">Telepon</label>
            <input type="text" class="form-control" id="telepon" name="telepon" value="<?= esc($bioskop->telepon) ?>">
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?= esc($bioskop->email) ?>">
        </div>

        <div class="form-group">
            <label for="website">Website</label>
            <input type="text" class="form-control" id="website" name="website" value="<?= esc($bioskop->website) ?>">
        </div>

        <div class="form-group">
            <label for="jam_buka">Jam Buka</label>
            <input type="time" class="form-control" id="jam_buka" name="jam_buka" value="<?= esc($bioskop->jam_buka) ?>">
        </div>

        <div class="form-group">
            <label for="jam_tutup">Jam Tutup</label>
            <input type="time" class="form-control" id="jam_tutup" name="jam_tutup" value="<?= esc($bioskop->jam_tutup) ?>">
        </div>

        <button type="submit" class="btn btn-primary btn-block">Simpan Perubahan</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
