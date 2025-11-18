<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="card p-4 shadow-sm">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-semibold">Daftar Genre</h4>
        <a href="<?= base_url('genre/tambah') ?>" class="btn btn-primary px-4">
            Tambah Genre
        </a>
    </div>

    <table class="table align-middle">
        <thead>
            <tr>
                <th style="width: 70px;">No</th>
                <th>Nama Genre</th>
                <th style="width: 120px;" class="text-center">Aksi</th>
            </tr>
        </thead>

        <tbody>

            <?php if (!empty($data)): ?>
                <?php $no = 1; foreach ($data as $g): ?>
                <tr style="border-bottom: 1px solid #eee;">
                    <td><?= $no++ ?></td>

                    <td class="fw-semibold"><?= esc($g->nama_genre) ?></td>

                    <td class="text-center">

                        <a href="<?= base_url('genre/ubah/'.$g->id_genre) ?>"
                            class="btn btn-outline-primary rounded-circle me-2"
                            style="width: 40px; height: 40px; padding: 8px;">
                            <i data-feather="edit"></i>
                        </a>

                        <a href="<?= base_url('genre/hapus/'.$g->id_genre) ?>"
                            onclick="return confirm('Yakin ingin menghapus genre ini?')"
                            class="btn btn-outline-danger rounded-circle"
                            style="width: 40px; height: 40px; padding: 8px;">
                            <i data-feather="trash-2"></i>
                        </a>

                    </td>
                </tr>
                <?php endforeach; ?>

            <?php else: ?>
                <tr>
                    <td colspan="3" class="text-center py-3 text-muted">
                        Belum ada data genre.
                    </td>
                </tr>
            <?php endif; ?>

        </tbody>
    </table>

</div>

<script>
    feather.replace();
</script>

<?= $this->endSection() ?>
