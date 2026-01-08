<?= $this->extend('kasir/layout/main') ?>
<?= $this->section('content') ?>

<style>
/* WRAPPER */
.kursi-wrapper {
    max-width: 900px;
    margin: auto;
}

/* GRID KURSI */
.kursi-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(60px, 1fr));
    gap: 10px;
    justify-items: center;
}

/* TOMBOL KURSI */
.seat-btn {
    width: 60px;
    height: 60px;
    font-size: 14px;
    font-weight: 700;
    border-radius: 10px;
    padding: 0;
    text-align: center;
    line-height: 1;
}

/* STATUS */
.seat-btn.btn-success {
    background-color: #198754;
}

.seat-btn.btn-danger {
    background-color: #dc3545;
}

.seat-btn.btn-primary {
    background-color: #0d6efd;
}

/* HOVER */
.seat-btn:not(:disabled):hover {
    transform: scale(1.08);
    transition: 0.15s ease-in-out;
}

/* LEGEND */
.kursi-legend span {
    display: inline-block;
    padding: 6px 12px;
    border-radius: 6px;
    font-size: 13px;
    font-weight: 600;
}
</style>


<div class="container py-4">
    <h4 class="fw-bold text-center mb-3">Pilih Kursi</h4>

    <div class="d-flex justify-content-center gap-2 mb-4 kursi-legend">
        <span class="bg-success text-white">Tersedia</span>
        <span class="bg-danger text-white">Terisi</span>
        <span class="bg-primary text-white">Dipilih</span>
    </div>

    <form method="post" action="<?= base_url('kasir/konfirmasi-pembayaran') ?>">
        <?= csrf_field() ?>
        <input type="hidden" name="id_tayang" value="<?= $id_tayang ?>">
        <input type="hidden" name="kursi_terpilih" id="kursiTerpilih">

        <div class="kursi-wrapper">
            <div class="kursi-grid">

                <?php foreach ($kursi as $k): ?>
                    <button
                        type="button"
                        class="btn seat-btn
                            <?= $k->status == 1 ? 'btn-danger' : 'btn-success' ?>"
                        <?= $k->status == 1 ? 'disabled' : '' ?>
                        data-id="<?= $k->id_kursi ?>"
                    >
                        <?= esc($k->kode_kursi) ?>
                    </button>
                <?php endforeach; ?>

            </div>
        </div>

        <div class="text-center mt-4">
            <button class="btn btn-primary px-4">
                Lanjut Pembayaran
            </button>
        </div>
    </form>
</div>

<script>
const selected = new Set();
document.querySelectorAll('.seat-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        const id = btn.dataset.id;

        if (selected.has(id)) {
            selected.delete(id);
            btn.classList.remove('btn-primary');
            btn.classList.add('btn-success');
        } else {
            selected.add(id);
            btn.classList.remove('btn-success');
            btn.classList.add('btn-primary');
        }

        document.getElementById('kursiTerpilih').value =
            Array.from(selected).join(',');
    });
});

document.querySelector('form').addEventListener('submit', e => {
    if (selected.size === 0) {
        e.preventDefault();
        alert('Pilih minimal 1 kursi!');
    }
});
</script>

<?= $this->endSection() ?>
