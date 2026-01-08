<?= $this->extend('kasir/layout/main') ?>
<?= $this->section('content') ?>

<div class="container py-4">
    <h4 class="fw-bold mb-4">Pilih Film</h4>

    <div class="row g-4">

        <?php if (empty($films)): ?>
            <p class="text-muted">Belum ada film yang tayang.</p>
        <?php endif; ?>

        <?php foreach ($films as $f): ?>
        <div class="col-md-4">
            <div class="card shadow-sm h-100">

                <img src="<?= base_url('posterfilm/'.$f->poster) ?>"
                     class="card-img-top"
                     alt="<?= esc($f->judul_film) ?>">

                <div class="card-body d-flex flex-column">
                    <h5 class="fw-semibold"><?= esc($f->judul_film) ?></h5>

                    <small class="text-muted mb-2">
                        <?= $f->tanggal ?> |
                        <?= $f->jam_mulai ?> - <?= $f->jam_selesai ?>
                    </small>

                    <small class="text-muted mb-3">
                        Room: <?= esc($f->nama_room) ?>
                    </small>

                    <a href="<?= base_url('kasir/pilih-kursi/'.$f->id_tayang) ?>"
                       class="btn btn-primary mt-auto w-100">
                        Pilih Kursi
                    </a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>

    </div>
</div>

<?= $this->endSection() ?>
