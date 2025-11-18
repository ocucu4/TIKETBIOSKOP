<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Detail Order</h4>
        <a href="<?= base_url('detailorder/tambah') ?>" class="btn btn-primary">
            <i data-feather="plus" class="me-1"></i> Tambah
        </a>
    </div>

    <div class="card-body table-responsive">
        <table class="table table-bordered align-middle text-center">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>ID Order</th>
                    <th>Kursi</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                <?php if (!empty($data)): ?>
                    <?php $no = 1; foreach ($data as $d): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= esc($d->id_order) ?></td>
                            <td><?= esc($d->kode_kursi ?? '-') ?></td>
                            <td><?= esc($d->jumlah) ?></td>
                            <td>Rp <?= number_format($d->subtotal, 0, ',', '.') ?></td>
                            <td>
                                <div class="btn-group">
                                    <a href="<?= base_url('detailorder/ubah/'.$d->id_detail) ?>"
                                        class="btn btn-outline-primary action-circle">
                                        <i data-feather="edit"></i>
                                    </a>

                                    <button onclick="hapusData(<?= $d->id_detail ?>)"
                                        class="btn btn-outline-danger action-circle">
                                        <i data-feather="trash-2"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center">Belum ada detail order.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
function hapusData(id) {
    if (confirm("Apakah yakin ingin menghapus data ini?")) {
        window.location.href = "<?= base_url('detailorder/delete/') ?>" + id;
    }
}
</script>

<?= $this->endSection() ?>
