<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Film Bioskop</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="p-4">

<div class="container">
    <h2 class="mb-4">🎬 Daftar Film Bioskop</h2>
    <a href="<?= base_url('film/create') ?>" class="btn btn-success mb-3">+ Tambah Film</a>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Judul Film</th>
                <th>Durasi</th>
                <th>Harga Tiket</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Selesai</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($film as $f): ?>
            <tr>
                <td><?= $f['id_film'] ?></td>
                <td><?= $f['judul_film'] ?></td>
                <td><?= $f['durasi'] ?> menit</td>
                <td>Rp <?= number_format($f['harga_tiket'], 0, ',', '.') ?></td>
                <td><?= $f['tanggal_mulai'] ?></td>
                <td><?= $f['tanggal_selesai'] ?></td>
                <td>
                    <a href="<?= base_url('film/edit/'.$f['id_film']) ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="<?= base_url('film/delete/'.$f['id_film']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus film ini?')">Hapus</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

</body>
</html>
