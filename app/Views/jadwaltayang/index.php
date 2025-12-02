<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<style>
.table-premium thead {
    background: #6fb3ff;
    color: white;
    font-weight: bold;
}
.table-premium tbody tr:hover {
    background-color: #f0f6ff !important;
}
.table-premium {
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 3px 12px rgba(0,0,0,0.08);
}
.action-btn {
    width: 38px;
    height: 38px;
    padding: 6px;
    border-radius: 50%;
}
</style>

<div class="card p-4 shadow-sm">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-semibold">Jadwal Tayang</h4>
        <button class="btn btn-primary px-4" data-bs-toggle="modal" data-bs-target="#modalTambah">
            Tambah Jadwal
        </button>
    </div>

    <table class="table table-premium align-middle">
        <thead>
            <tr>
                <th>No</th>
                <th>Film</th>
                <th>Room</th>
                <th>Tanggal</th>
                <th>Jam</th>
                <th>Harga</th>
                <th class="text-center" style="width:120px">Aksi</th>
            </tr>
        </thead>

        <tbody>
        <?php if (!empty($data)): ?>
            <?php $no=1; foreach($data as $d): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= esc($d->judul_film) ?></td>
                <td><?= esc($d->nama_room) ?></td>
                <td><?= esc($d->tanggal) ?></td>
                <td><?= esc($d->jam_mulai) ?> - <?= esc($d->jam_selesai) ?></td>
                <td>Rp <?= number_format($d->harga,0,',','.') ?></td>

                <td class="text-center">
                    <button class="btn btn-outline-primary action-btn me-2"
                        data-bs-toggle="modal"
                        data-bs-target="#modalUbah<?= $d->id_tayang ?>">
                        <i data-feather="edit"></i>
                    </button>

                    <button class="btn btn-outline-danger action-btn"
                        onclick="hapusJadwal(<?= $d->id_tayang ?>)">
                        <i data-feather="trash-2"></i>
                    </button>
                </td>
            </tr>

            <!-- UBAH -->
            <div class="modal fade" id="modalUbah<?= $d->id_tayang ?>" tabindex="-1">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 class="modal-title fw-semibold">Ubah Jadwal</h5>
                            <button class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <form action="<?= base_url('jadwaltayang/update/'.$d->id_tayang) ?>" method="post">
                            <?= csrf_field() ?>
                            <div class="modal-body">
                                <div class="row g-3">

                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Film</label>
                                        <select name="id_film" class="form-select" required>
                                            <?php foreach($film as $f): ?>
                                                <option value="<?= $f->id_film ?>"
                                                    <?= $f->id_film==$d->id_film?'selected':'' ?>>
                                                    <?= $f->judul_film ?>
                                                </option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Room</label>
                                        <select name="id_room" class="form-select" required>
                                            <?php foreach($room as $r): ?>
                                                <option value="<?= $r->id_room ?>"
                                                    <?= $r->id_room==$d->id_room?'selected':'' ?>>
                                                    <?= $r->nama_room ?>
                                                </option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Tanggal</label>
                                        <input type="date" name="tanggal" value="<?= $d->tanggal ?>" class="form-control" required>
                                    </div>

                                    <div class="col-md-3">
                                        <label class="form-label fw-semibold">Jam Mulai</label>
                                        <input type="time" name="jam_mulai" value="<?= $d->jam_mulai ?>" class="form-control" required>
                                    </div>

                                    <div class="col-md-3">
                                        <label class="form-label fw-semibold">Jam Selesai</label>
                                        <input type="time" name="jam_selesai" value="<?= $d->jam_selesai ?>" class="form-control" required>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">Harga</label>
                                        <input type="number" name="harga" value="<?= $d->harga ?>" class="form-control" required>
                                    </div>

                                </div>
                            </div>

                            <div class="modal-footer">
                                <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button class="btn btn-primary">Update</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
            <?php endforeach ?>
        <?php else: ?>
            <tr>
                <td colspan="7" class="text-center py-3 text-muted">Belum ada jadwal.</td>
            </tr>
        <?php endif ?>
        </tbody>
    </table>
</div>

<!-- TAMBAH -->
<div class="modal fade" id="modalTambah" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title fw-semibold">Tambah Jadwal</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="<?= base_url('jadwaltayang/simpan') ?>" method="post">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Film</label>
                            <select name="id_film" class="form-select" required>
                                <?php foreach($film as $f): ?>
                                    <option value="<?= $f->id_film ?>"><?= $f->judul_film ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Room</label>
                            <select name="id_room" class="form-select" required>
                                <?php foreach($room as $r): ?>
                                    <option value="<?= $r->id_room ?>"><?= $r->nama_room ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Tanggal</label>
                            <input type="date" name="tanggal" class="form-control" required>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Jam Mulai</label>
                            <input type="time" name="jam_mulai" class="form-control" required>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Jam Selesai</label>
                            <input type="time" name="jam_selesai" class="form-control" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Harga</label>
                            <input type="number" name="harga" class="form-control" required>
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-success">Simpan</button>
                </div>
            </form>

        </div>
    </div>
</div>

<script>
function hapusJadwal(id) {
    Swal.fire({
        title: 'Hapus Jadwal?',
        text: "Data akan dihapus permanen!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#666',
        confirmButtonText: 'Hapus'
    }).then((result)=>{
        if(result.isConfirmed){
            window.location.href = "<?= base_url('jadwaltayang/hapus') ?>/" + id;
        }
    });
}
feather.replace();
</script>

<?= $this->endSection() ?>
