<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Film</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="p-4">
<div class="container">
    <h2><?= isset($film) ? 'Edit Film' : 'Tambah Film' ?></h2>

    <form method="post" action="<?= isset($film) ? base_url('film/update/'.$film['id_film']) : base_url('film/store') ?>">
        <div class="mb-3">
            <label>Judul Film</label>
            <input type="text" name="judul_film" value="<?= $film['judul_film'] ?? '' ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Durasi (menit)</label>
            <input type="number" name="durasi" value="<?= $film['durasi'] ?? '' ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Harga Tiket</label>
            <input type="number" name="harga_tiket" value="<?= $film['harga_tiket'] ?? '' ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Tanggal Mulai</label>
            <input type="date" name="tanggal_mulai" value="<?= $film['tanggal_mulai'] ?? '' ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Tanggal Selesai</label>
            <input type="date" name="tanggal_selesai" value="<?= $film['tanggal_selesai'] ?? '' ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Sinopsis</label>
            <textarea name="sinopsis" class="form-control" rows="3"><?= $film['sinopsis'] ?? '' ?></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="<?= base_url('film') ?>" class="btn btn-secondary">Kembali</a>
    </form>
</div>
</body>
</html>
