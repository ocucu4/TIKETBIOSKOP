<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="row g-4">

    <div class="col-12">
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <?= esc(session()->getFlashdata('error')) ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success">
                <?= esc(session()->getFlashdata('success')) ?>
            </div>
        <?php endif; ?>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm p-4">
            <h5 class="fw-semibold mb-3">Tambah Room</h5>

            <form action="<?= site_url('room/add') ?>" method="post">
                <?= csrf_field() ?>

                <div class="mb-3">
                    <label class="form-label">Nama Room</label>
                    <input type="text" name="nama_room" class="form-control" required autofocus>
                </div>

                <div class="mb-3">
                    <label class="form-label">Kapasitas Kursi</label>
                    <input type="number" name="kapasitas" class="form-control" min="1" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Jumlah Kursi per Baris</label>
                    <input type="number" name="panjang" class="form-control" min="1" required>
                </div>

                <button type="submit" class="btn btn-primary w-100">
                    Simpan Room
                </button>
            </form>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card shadow-sm p-4">
            <h5 class="fw-semibold mb-3">Daftar Room</h5>

                <div class="table-responsive">
                    <table class="table table-premium align-middle">
                        <thead class="table-light">
                            <tr>
                                <th style="width:60px" class="text-center">No.</th>
                                <th>Nama Room</th>
                                <th class="text-center">Kapasitas</th>
                                <th class="text-center">Panjang Baris</th>
                                <th style="width:100px" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($data)): ?>
                                <tr>
                                    <td colspan="5" class="text-center text-muted">
                                        Belum ada room.
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php $no = 1; foreach ($data as $r): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= esc($r->nama_room) ?></td>
                                        <td class="text-center"><?= esc($r->kapasitas) ?></td>
                                        <td class="text-center"><?= esc($r->panjang) ?></td>
                                        <td class="text-center">
                                        <div class="d-flex justify-content-center">
                                            <button class="btn btn-outline-danger action-btn"
                                                    onclick="hapusRoom(<?= $r->id_room ?>)">
                                                <i data-feather="trash-2"></i>
                                            </button>
                                        </div>
                                    </td>                       
                                    </tr>
                                <?php endforeach ?>
                            <?php endif ?>
                        </tbody>
                    </table>
                </div>
              </div>
            </div>
        </div>

<script>

function hapusRoom(id) {
    Swal.fire({
        title: 'Hapus Room?',
        text: 'Room dan kursinya akan dihapus permanen!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        confirmButtonText: 'Hapus'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "<?= base_url('room/delete') ?>/" + id;
        }
    });
}

feather.replace();

</script>


<?= $this->endSection() ?>
