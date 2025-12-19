<?= $this->extend('layoutkasir/main') ?>
<?= $this->section('content') ?>

<h4 class="mb-4 fw-semibold">Pilih Jadwal Tayang</h4>

<div class="table-responsive">
    <table class="table table-bordered align-middle bg-white">
        <thead class="table-light">
            <tr>
                <th>No</th>
                <th>Film</th>
                <th>Room</th>
                <th>Tanggal</th>
                <th>Jam</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; foreach ($jadwal as $j): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= esc($j->judul_film) ?></td>
                <td><?= esc($j->nama_room) ?></td>
                <td><?= esc($j->tanggal) ?></td>
                <td><?= esc($j->jam_mulai) ?> - <?= esc($j->jam_selesai) ?></td>
                <td>
                    <a href="<?= base_url('kasir/transaksi/'.$j->id_tayang) ?>"
                       class="btn btn-primary btn-sm">
                        Pilih
                    </a>
                </td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>

<?= $this->endSection() ?>
