<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Film</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">🎬 Daftar Film Bioskop</h2>
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Judul Film</th>
                <th>Durasi</th>
                <th>Harga Tiket</th>
                <th>Tanggal masuk</th>
                <th>Tanggal keluar</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($film as $f): ?>
            <tr>
                <td><?= $f['id_film']; ?></td>
                <td><?= $f['judul_film']; ?></td>
                <td><?= $f['durasi']; ?> menit</td>
                <td>Rp <?= number_format($f['harga_tiket'], 0, ',', '.'); ?></td>
                <td><?= $f['tanggal_mulai']; ?></td>
                <td><?= $f['tanggal_selesai']; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
