<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="card p-4 shadow-sm">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-semibold">Jadwal Tayang</h4>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">
            Tambah Jadwal
        </button>
    </div>
    
<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('error') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

    <table class="table table-premium align-middle table-jadwal">
        <thead>
            <tr>
                <th style="width:60px" class="text-center">No</th>
                <th>Film</th>
                <th class="text-center">Room</th>
                <th class="text-center">Tanggal</th>
                <th class="text-center">Jam</th>
                <th style="width:140px" class="text-end col-harga">Harga</th>
                <th style="width:150px" class="text-center">Aksi</th>
            </tr>
        </thead>

        <tbody>
        <?php if (!empty($data)): ?>
            <?php $no=1; foreach ($data as $d): ?>
            <tr>
                <td class="text-center"><?= $no++ ?></td>

                <td><?= esc($d->judul_film) ?></td>

                <td class="text-center"><?= esc($d->nama_room) ?></td>

                <td class="text-center"><?= esc($d->tanggal) ?></td>

                <td class="text-center">
                    <?= esc($d->jam_mulai) ?> - <?= esc($d->jam_selesai) ?>
                </td>

                <td class="text-end col-harga">
                    Rp <?= number_format($d->harga, 0, ',', '.') ?>
                </td>

                <td class="text-center">
                    <div class="d-flex justify-content-center gap-1">

                        <button class="btn btn-outline-primary action-btn"
                            data-bs-toggle="modal"
                            data-bs-target="#modalEdit<?= $d->id_tayang ?>">
                            <i data-feather="edit"></i>
                        </button>

                        <a href="<?= base_url('jadwaltayang/delete/'.$d->id_tayang) ?>"
                           class="btn btn-outline-danger action-btn"
                           onclick="return confirm('Hapus jadwal?')">
                            <i data-feather="trash-2"></i>
                        </a>

                        <a href="<?= base_url('kursijadwalstatus/'.$d->id_tayang) ?>"
                           class="btn btn-outline-secondary action-btn"
                           title="Status Kursi">
                            <img src="<?= base_url('assets/icons-sidebar/seat-schedule-status.png') ?>"
                                 width="18"
                                 alt="Status Kursi">
                        </a>

                    </div>
                </td>
            </tr>
            <?php endforeach ?>
        <?php else: ?>
            <tr>
                <td colspan="7" class="text-center text-muted">Belum ada jadwal tayang</td>
            </tr>
        <?php endif ?>
        </tbody>
    </table>
</div>

<div class="modal fade" id="modalTambah" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form action="<?= base_url('jadwaltayang/create') ?>" method="post">
                <?= csrf_field() ?>

                <div class="modal-header">
                    <h5 class="modal-title">Tambah Jadwal</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="row g-3">

                        <div class="col-md-6">
                            <label>Film</label>
                            <select name="id_film" class="form-select" required>
                                <?php foreach ($film as $f): ?>
                                    <option value="<?= $f->id_film ?>">
                                        <?= $f->judul_film ?>
                                    </option>
                                <?php endforeach ?>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label>Room</label>
                            <select name="id_room" class="form-select" required>
                                <?php foreach ($room as $r): ?>
                                    <option value="<?= $r->id_room ?>">
                                        <?= $r->nama_room ?>
                                    </option>
                                <?php endforeach ?>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label>Tanggal</label>
                            <input type="date" name="tanggal" class="form-control" required>
                        </div>

                        <div class="col-md-3">
                            <label>Jam Mulai</label>
                            <input type="time" name="jam_mulai" class="form-control" required>
                        </div>

                        <div class="col-md-3">
                            <label>Jam Selesai</label>
                            <input type="time" name="jam_selesai" class="form-control" required>
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php foreach ($data as $d): ?>
<div class="modal fade" id="modalEdit<?= $d->id_tayang ?>" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form action="<?= base_url('jadwaltayang/update/'.$d->id_tayang) ?>" method="post">
                <?= csrf_field() ?>

                <div class="modal-header">
                    <h5 class="modal-title">Ubah Jadwal</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="row g-3">

                        <div class="col-md-6">
                            <label>Film</label>
                            <select name="id_film" class="form-select">
                                <?php foreach ($film as $f): ?>
                                    <option value="<?= $f->id_film ?>"
                                        <?= $f->id_film == $d->id_film ? 'selected' : '' ?>>
                                        <?= $f->judul_film ?>
                                    </option>
                                <?php endforeach ?>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label>Room</label>
                            <select name="id_room" class="form-select">
                                <?php foreach ($room as $r): ?>
                                    <option value="<?= $r->id_room ?>"
                                        <?= $r->id_room == $d->id_room ? 'selected' : '' ?>>
                                        <?= $r->nama_room ?>
                                    </option>
                                <?php endforeach ?>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label>Tanggal</label>
                            <input type="date" name="tanggal" value="<?= $d->tanggal ?>" class="form-control">
                        </div>

                        <div class="col-md-3">
                            <label>Jam Mulai</label>
                            <input type="time" name="jam_mulai" value="<?= $d->jam_mulai ?>" class="form-control">
                        </div>

                        <div class="col-md-3">
                            <label>Jam Selesai</label>
                            <input type="time" name="jam_selesai" value="<?= $d->jam_selesai ?>" class="form-control">
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach ?>

<?= $this->endSection() ?>
