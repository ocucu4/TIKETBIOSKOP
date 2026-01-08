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
                    <th>Kode Kursi</th>
                    <th>Harga</th>
                    <th>Status</th>
                    <th>Tanggal Order</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>

            <?php $total = 0; ?>
            <?php foreach ($data as $i => $d): ?>
            <?php $total += $d->harga; ?>
            
            <tr>
                <td><?= $i + 1 ?></td>
                <td><?= esc($d->nama_pemesan) ?></td>
                <td><?= esc($d->kode_kursi) ?></td>
                <td>Rp <?= number_format($d->harga, 0, ',', '.') ?></td>
                <td>
                    <?= $d->status_order === 'lunas'
                        ? '<span class="badge bg-success">LUNAS</span>'
                        : '<span class="badge bg-warning text-dark">BELUM BAYAR</span>' ?>
                </td>
                <td><?= $d->tanggal_order ?></td>
                <td>
                    <a href="<?= base_url('detailorder/delete/'.$d->id_detail) ?>"
                       onclick="return confirm('Hapus kursi ini dari order?')"
                       class="btn btn-sm btn-outline-danger">
                       Hapus
                    </a>
                </td>
            </tr>
            <?php endforeach ?>
                <tr class="fw-bold">
                    <td colspan="3" class="text-end">TOTAL</td>
                    <td colspan="4">Rp <?= number_format($total, 0, ',', '.') ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>
