<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Tiket Bioskop</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container py-5">
    <h2 class="text-center mb-4">🎬 Daftar Film yang Sedang Tayang</h2>

    <div class="row">
        <?php foreach($film as $f): ?>
        <div class="col-md-3 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"><?= $f['judul_film'] ?></h5>
                    <p><strong>Durasi:</strong> <?= $f['durasi'] ?> menit</p>
                    <p><strong>Harga:</strong> Rp <?= number_format($f['harga_tiket'], 0, ',', '.') ?></p>
                    <p><strong>Tayang:</strong><br><?= $f['tanggal_mulai'] ?> - <?= $f['tanggal_selesai'] ?></p>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
</body>
</html>
