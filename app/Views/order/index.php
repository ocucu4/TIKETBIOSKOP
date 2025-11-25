<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="card p-4 shadow-sm">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-semibold">Order</h4>
        <a href="<?= base_url('order/tambah') ?>" class="btn btn-primary">
            <i data-feather="plus"></i> Tambah Order
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Nama Pemesan</th>
                    <th>Film</th>
                    <th>Room</th>
                    <th>Jadwal Tayang</th>
                    <th>Tanggal Order</th>
                    <th>Status</th>
                    <th>Total Bayar</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($data as $i => $o): ?>
                <tr>
                    <td><?= $i + 1 ?></td>
                    <td><?= esc($o->nama_pemesan) ?></td>
                    <td><?= esc($o->judul_film) ?></td>
                    <td><?= esc($o->nama_room) ?></td>
                    <td>
                        <?= esc($o->tanggal) ?> <br>
                        <small><?= $o->jam_mulai ?> - <?= $o->jam_selesai ?></small>
                    </td>
                    <td><?= esc($o->tanggal_order) ?></td>

                    <td>
                        <span class="badge 
                            <?= $o->status_order == 'lunas' ? 'bg-success' : ($o->status_order == 'pending' ? 'bg-warning' : 'bg-danger') ?>">
                            <?= esc($o->status_order) ?>
                        </span>
                    </td>

                    <td>Rp <?= number_format($o->total_bayar, 0, ',', '.') ?></td>

                    <td class="text-center">
                        <a href="<?= base_url('order/ubah/'.$o->id_order) ?>" 
                           class="btn btn-outline-primary action-circle">
                            <i data-feather="edit"></i>
                        </a>

                        <button onclick="hapusOrder(<?= $o->id_order ?>)"
                            class="btn btn-outline-danger action-circle">
                            <i data-feather="trash-2"></i>
                        </button>
                    </td>
                </tr>
                <?php endforeach ?>
            </tbody>

        </table>
    </div>

</div>

<script>
function hapusOrder(id){
    Swal.fire({
        title: 'Hapus Order?',
        text: "Data akan dihapus permanen!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Hapus'
    }).then((result)=>{
        if(result.isConfirmed){
            window.location.href = "<?= base_url('order/hapus') ?>/" + id;
        }
    });
}
</script>

<?= $this->endSection() ?>
