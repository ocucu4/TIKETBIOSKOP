<?= $this->extend('kasir/layout/main') ?>

<?= $this->section('style') ?>
<style>
.pilih-film-row {
    align-items: stretch;
}

.film-card {
    cursor: pointer;
    border-radius: 18px;
    overflow: hidden;
    background: transparent;
    transition: transform .35s ease, box-shadow .35s ease;
}

.film-card:hover {
    transform: translateY(-6px);
}

.film-card.active {
    transform: translateY(-8px) scale(1.02);
    box-shadow: 0 28px 60px rgba(0,0,0,.45);
    outline: 2px solid rgba(13,110,253,.7);
}

.poster-wrap {
    position: relative;
    height: 520px;
}

.poster-wrap img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

.glass-info {
    position: absolute;
    left: 0;
    right: 0;
    bottom: 0;
    height: 36%;
    padding: 18px 22px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    background: linear-gradient(
        to top,
        rgba(0,0,0,.88),
        rgba(0,0,0,.45),
        rgba(0,0,0,.18)
    );
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    border-top: 1px solid rgba(255,255,255,.25);
    color: #fff;
    text-align: center;
}

.glass-info::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(
        to bottom,
        rgba(255,255,255,.18),
        transparent 55%
    );
    pointer-events: none;
}

.glass-info .title {
    min-height: 2.6em;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.9rem;
    font-weight: 800;
    line-height: 1.2;
    margin-bottom: 14px;
    text-shadow: 0 4px 12px rgba(0,0,0,.9);
}

.glass-info .meta {
    font-size: 1.1rem;
    font-weight: 600;
    color: rgba(255,255,255,.95);
    margin-bottom: 10px;
}

.glass-info .room {
    font-size: .95rem;
    font-weight: 500;
    letter-spacing: 1.5px;
    text-transform: uppercase;
    color: rgba(255,255,255,.75);
}

.kursi-action {
    margin-top: 14px;
    opacity: 0;
    transform: translateY(14px);
    transition: all .35s ease;
    pointer-events: none;
}

.kursi-action.show {
    opacity: 1;
    transform: translateY(0);
    pointer-events: auto;
}

.btn-outline-secondary {
    border-radius: 10px;
    padding: 6px 14px;
    font-weight: 500;
}
</style>
<?= $this->endSection() ?>


<?= $this->section('content') ?>
<div class="container py-4">

    <div class="d-flex align-items-center gap-3 mb-4">
        <a href="<?= base_url('kasir/dashboard') ?>"
           class="btn btn-outline-secondary d-flex align-items-center gap-2">
            ← Kembali
        </a>
        <h4 class="fw-bold m-0">Pilih Film</h4>
    </div>

    <div class="row g-4 pilih-film-row">

        <?php if (empty($films)): ?>
            <div class="col-12 text-center text-muted py-5">
                <p class="fw-semibold mb-0">
                    Belum ada jadwal film yang tersedia saat ini.
                </p>
            </div>
        <?php endif; ?>

        <?php foreach ($films as $f): ?>
        <div class="col-12 col-md-6 col-lg-4">

            <div class="film-card card shadow-sm">
                <div class="poster-wrap">
                    <img
                        src="<?= base_url('posterfilm/'.$f->poster) ?>"
                        alt="<?= esc($f->judul_film) ?>">

                    <div class="glass-info">
                        <h5 class="title"><?= esc($f->judul_film) ?></h5>

                        <div class="meta">
                            <?= $f->tanggal ?> | <?= $f->jam_mulai ?> – <?= $f->jam_selesai ?>
                        </div>

                        <div class="room">
                            <?= esc($f->nama_room) ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="kursi-action">
                <a href="<?= base_url('kasir/pilih-kursi/'.$f->id_tayang) ?>"
                   class="btn btn-primary w-100 py-2 fw-semibold">
                    Pilih Kursi
                </a>
            </div>

        </div>
        <?php endforeach; ?>

    </div>
</div>
<?= $this->endSection() ?>


<?= $this->section('script') ?>
<script>
const cards = document.querySelectorAll('.film-card');

function resetAll() {
    cards.forEach(card => {
        card.classList.remove('active');
        card.parentElement
            .querySelector('.kursi-action')
            .classList.remove('show');
    });
}

cards.forEach(card => {
    card.addEventListener('click', e => {
        e.stopPropagation();

        const action = card.parentElement.querySelector('.kursi-action');
        const isActive = card.classList.contains('active');

        resetAll();

        if (!isActive) {
            card.classList.add('active');
            action.classList.add('show');
            action.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }
    });
});

window.addEventListener('click', resetAll);
</script>
<?= $this->endSection() ?>
