<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Bioskop</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2 class="mb-4 text-center">Daftar Bioskop</h2>
    <a href="<?= base_url('bioskop/tambah') ?>" class="btn btn-primary btn-sm mb-3">+ Tambah Bioskop</a>

    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
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
        <?php if (!empty($bioskop)): ?>
            <?php $no = 1; foreach ($bioskop as $b): ?>
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
                    <a href="<?= base_url('bioskop/ubah/'.$b->id_bioskop) ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="<?= base_url('bioskop/hapus/'.$b->id_bioskop) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</a>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="10" class="text-center text-muted">Belum ada data bioskop</td></tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
