<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="card p-4 shadow-sm">

    <div class="d-flex justify-content-between mb-3">
        <h4 class="fw-semibold">Jadwal Tayang</h4>

        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">
            Tambah Jadwal
        </button>
    </div>

    <table class="table table-bordered align-middle">
        <thead class="table-light">
            <tr>
                <th>No</th>
                <th>Film</th>
                <th>Tanggal</th>
                <th>Jam Mulai</th>
                <th>Jam Selesai</th>
                <th>Harga</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>

        <tbody>
            <?php $no=1; foreach($data as $d): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $d->judul_film ?></td>
                <td><?= $d->tanggal ?></td>
                <td><?= $d->jam_mulai ?></td>
                <td><?= $d->jam_selesai ?></td>
                <td><?= number_format($d->harga) ?></td>

                <td class="text-center">
                    <button 
                        class="btn btn-sm btn-outline-primary"
                        data-bs-toggle="modal"
                        data-bs-target="#modalUbah<?= $d->id_tayang ?>">
                        Edit
                    </button>

                    <a onclick="return confirm('Hapus jadwal ini?')" 
                       href="<?= base_url('jadwaltayang/delete/'.$d->id_tayang) ?>"
                       class="btn btn-sm btn-outline-danger">
                        Hapus
                    </a>
                </td>
            </tr>

            <div class="modal fade" id="modalUbah<?= $d->id_tayang ?>">
                <div class="modal-dialog">
                    <form method="post" action="<?= base_url('jadwaltayang/update/'.$d->id_tayang) ?>" class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Ubah Jadwal</h5>
                        </div>

                        <div class="modal-body">

                            <label class="mb-1">Film</label>
                            <select name="id_film" class="form-control mb-2">
                                <?php foreach($film as $f): ?>
                                <option value="<?= $f->id_film ?>" <?= $f->id_film==$d->id_film?'selected':'' ?>>
                                    <?= $f->judul_film ?>
                                </option>
                                <?php endforeach; ?>
                            </select>

                            <label class="mb-1">Tanggal</label>
                            <input type="date" name="tanggal" value="<?= $d->tanggal ?>" class="form-control mb-2">

                            <label class="mb-1">Jam Mulai</label>
                            <input type="time" name="jam_mulai" value="<?= $d->jam_mulai ?>" class="form-control mb-2">

                            <label class="mb-1">Jam Selesai</label>
                            <input type="time" name="jam_selesai" value="<?= $d->jam_selesai ?>" class="form-control mb-2">

                            <label class="mb-1">Harga</label>
                            <input type="number" name="harga" value="<?= $d->harga ?>" class="form-control mb-2">

                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>

            <?php endforeach; ?>
        </tbody>
    </table>

</div>

<div class="modal fade" id="modalTambah">
    <div class="modal-dialog">
        <form method="post" action="<?= base_url('jadwaltayang/simpan') ?>" class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Tambah Jadwal</h5>
            </div>

            <div class="modal-body">

                <label class="mb-1">Film</label>
                <select name="id_film" class="form-control mb-2" required>
                    <?php foreach($film as $f): ?>
                    <option value="<?= $f->id_film ?>"><?= $f->judul_film ?></option>
                    <?php endforeach; ?>
                </select>

                <label class="mb-1">Tanggal</label>
                <input type="date" name="tanggal" class="form-control mb-2" required>

                <label class="mb-1">Jam Mulai</label>
                <input type="time" name="jam_mulai" class="form-control mb-2" required>

                <label class="mb-1">Jam Selesai</label>
                <input type="time" name="jam_selesai" class="form-control mb-2" required>

                <label class="mb-1">Harga</label>
                <input type="number" name="harga" class="form-control mb-2" required>

            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button class="btn btn-primary">Simpan</button>
            </div>

        </form>
    </div>
</div>

<?= $this->endSection() ?>
