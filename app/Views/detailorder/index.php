<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="card p-4 shadow-sm">

    <h4 class="fw-semibold mb-3">Detail Order</h4>

    <div class="table-responsive">
        <table class="table table-hover align-middle text-center">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pemesan</th>
                    <th>Jumlah Kursi</th>
                    <th>Subtotal</th>
                    <th>Status</th>
                    <th>Tanggal Order</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>

            <?php if (!empty($data)): ?>
                <?php foreach ($data as $i => $d): ?>
                <tr>
                    <td><?= $i + 1 ?></td>
                    <td><?= esc($d->nama_pemesan) ?></td>
                    <td><?= esc($d->jumlah) ?></td>
                    <td>Rp <?= number_format($d->subtotal, 0, ',', '.') ?></td>
                    <td>
                        <?= $d->status_order === 'lunas'
                            ? '<span class="badge bg-success">LUNAS</span>'
                            : '<span class="badge bg-warning text-dark">PENDING</span>' ?>
                    </td>
                    <td><?= $d->tanggal_order ?></td>
                    <td>
                        <a href="<?= base_url('detailorder/delete/'.$d->id_detail) ?>"
                           onclick="return confirm('Hapus detail order?')"
                           class="btn btn-sm btn-outline-danger">
                            Hapus
                        </a>
                    </td>
                </tr>
                <?php endforeach ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" class="text-muted">Belum ada detail order</td>
                </tr>
            <?php endif ?>

            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>
