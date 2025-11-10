<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Bioskop</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2 class="mb-4 text-center">Tambah Data Bioskop</h2>
    <a href="<?= base_url('bioskop') ?>" class="btn btn-secondary btn-sm mb-3">Kembali</a>

    <form action="<?= base_url('bioskop/simpan') ?>" method="post">
        <?= csrf_field() ?>

        <div class="form-group">
            <label for="nama_bioskop">Nama Bioskop</label>
            <input type="text" class="form-control" id="nama_bioskop" name="nama_bioskop" placeholder="Contoh: CGV Paris Van Java" required>
        </div>

        <div class="form-group">
            <label for="alamat">Alamat</label>
            <textarea class="form-control" id="alamat" name="alamat" rows="3" placeholder="Masukkan alamat lengkap bioskop..." required></textarea>
        </div>

        <div class="form-group">
            <label for="kota">Kota</label>
            <input type="text" class="form-control" id="kota" name="kota" placeholder="Contoh: Bandung" required>
        </div>

        <div class="form-group">
            <label for="telepon">Telepon</label>
            <input type="text" class="form-control" id="telepon" name="telepon" placeholder="0812-3456-7890">
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="bioskop@email.com">
        </div>

        <div class="form-group">
            <label for="website">Website</label>
            <input type="text" class="form-control" id="website" name="website" placeholder="https://www.cgv.id">
        </div>

        <div class="form-group">
            <label for="jam_buka">Jam Buka</label>
            <input type="time" class="form-control" id="jam_buka" name="jam_buka">
        </div>

        <div class="form-group">
            <label for="jam_tutup">Jam Tutup</label>
            <input type="time" class="form-control" id="jam_tutup" name="jam_tutup">
        </div>

        <button type="submit" class="btn btn-primary btn-block">Simpan Data</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
