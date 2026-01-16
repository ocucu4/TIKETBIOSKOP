<?= $this->extend('kasir/layout/main') ?>

<?= $this->section('style') ?>
<style>
.pilih-kursi-layout {
    display: grid;
    grid-template-columns: 1fr 340px;
    gap: 32px;
    align-items: start;
}

@media (max-width: 992px) {
    .pilih-kursi-layout {
        grid-template-columns: 1fr;
    }
}

.panel {
    background: #fff;
    border-radius: 14px;
    padding: 24px;
    box-shadow: 0 10px 28px rgba(0,0,0,.08);
    max-width: 900px;
}

.screen {
    background: linear-gradient(180deg, #1f2937, #111827);
    color: #fff;
    text-align: center;
    padding: 10px;
    border-radius: 10px;
    font-weight: 600;
    letter-spacing: 2px;
    margin-bottom: 8px;
}

.screen-sub {
    text-align: center;
    font-size: 13px;
    color: #6b7280;
    margin-bottom: 20px;
}

.row-label {
    font-weight: 700;
    color: #374151;
    text-align: center;
}

.row-seats {
    display: grid;
    grid-template-columns: repeat(10, 64px);
    gap: 10px;
    justify-content: center;
}

.seat {
    height: 44px;
    border-radius: 10px;
    font-size: 13px;
    font-weight: 700;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    user-select: none;
    transition:
        transform .18s ease,
        box-shadow .18s ease,
        background-color .18s ease;
}

.seat.available {
    background: #16a34a;
    color: #fff;
}

.seat.booked {
    background: #dc2626;
    color: #fff;
    cursor: not-allowed;
}

.seat.selected {
    background: #2563eb;
    color: #fff;
    transform: scale(1.08);
    box-shadow: 0 6px 18px rgba(37,99,235,.45);
}

.seat.available:hover {
    transform: scale(1.08);
    box-shadow: 0 4px 14px rgba(22,163,74,.45);
}

.legend {
    display: flex;
    justify-content: center;
    gap: 18px;
    margin-top: 24px;
    font-size: 13px;
    font-weight: 600;
}

.legend span {
    display: flex;
    align-items: center;
    gap: 8px;
}

.legend i {
    width: 16px;
    height: 16px;
    border-radius: 4px;
    display: inline-block;
}

.summary-panel {
    position: sticky;
    top: 96px;
    align-self: start;
}

.summary-item {
    font-size: 14px;
    margin-bottom: 10px;
}

.summary-item strong {
    display: block;
    color: #111827;
}

.summary-item small {
    font-size: 12px;
    color: #6b7280;
}

.summary-item + .summary-item {
    margin-top: 8px;
}

hr {
    border-color: #e5e7eb;
}

.kursi-list {
    display: flex;
    flex-wrap: wrap;
    gap: 6px;
    margin-top: 6px;
}

.kursi-badge {
    background: #2563eb;
    color: #fff;
    font-size: 12px;
    padding: 4px 8px;
    border-radius: 6px;
}

.total {
    font-size: 20px;
    font-weight: 800;
    color: #2563eb;
    text-align: right;
}

.btn-primary {
    border-radius: 10px;
    padding: 10px;
    font-weight: 600;
}

#btnSubmit:disabled {
    background: #c7d2fe;
    cursor: not-allowed;
    box-shadow: none;
}
</style>
<?= $this->endSection() ?>


<?= $this->section('content') ?>
<div class="container py-4">

    <div class="d-flex align-items-center gap-3 mb-4">
        <a href="<?= base_url('kasir/pilih-film') ?>"
           class="btn btn-outline-secondary btn-sm">
            ← Kembali
        </a>
        <h4 class="fw-bold m-0">Pilih Kursi</h4>
    </div>

    <form method="post" action="<?= base_url('kasir/konfirmasi-pembayaran') ?>">
        <?= csrf_field() ?>
        <input type="hidden" name="id_tayang" value="<?= $id_tayang ?>">
        <input type="hidden" name="kursi_terpilih" id="kursiTerpilih">

        <div class="pilih-kursi-layout">

            <div class="panel">
                <div class="screen">LAYAR</div>
                <div class="screen-sub">Pandangan ke layar</div>

                <?php
                $grouped = [];
                foreach ($kursi as $k) {
                    $row = substr($k->kode_kursi, 0, 1);
                    $grouped[$row][] = $k;
                }
                ?>

                <?php foreach ($grouped as $row => $items): ?>
                    <div class="mb-2">
                        <div class="row-label mb-1"><?= $row ?></div>
                        <div class="row-seats">
                            <?php foreach ($items as $k): ?>
                                <div
                                    class="seat <?= $k->status == 1 ? 'booked' : 'available' ?>"
                                    data-id="<?= $k->id_kursi ?>"
                                    data-code="<?= esc($k->kode_kursi) ?>">
                                    <?= substr($k->kode_kursi, 1) ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>

                <div class="legend">
                    <span><i style="background:#16a34a"></i> Tersedia</span>
                    <span><i style="background:#dc2626"></i> Terisi</span>
                    <span><i style="background:#2563eb"></i> Dipilih</span>
                </div>
            </div>

            <div class="panel summary-panel">
                <h6 class="fw-bold mb-3">Ringkasan</h6>

                <div class="summary-item">
                    <small>Film</small>
                    <strong><?= esc($jadwal->judul_film) ?></strong>
                </div>

                <div class="summary-item">
                    <small>Tanggal</small>
                    <div><?= date('d F Y', strtotime($jadwal->tanggal)) ?></div>
                </div>

                <div class="summary-item">
                    <small>Jam</small>
                    <div><?= substr($jadwal->jam_mulai, 0, 5) ?> WIB</div>
                </div>

                <div class="summary-item">
                    <small>Ruang</small>
                    <div><?= esc($jadwal->nama_room) ?></div>
                </div>

                <hr>

                <div class="summary-item">
                    <strong>Kursi Dipilih</strong>
                    <div class="kursi-list" id="kursiList">
                        <span class="text-muted">Belum ada kursi</span>
                    </div>
                    <small class="text-muted d-block mt-1">
                        Harga per kursi: Rp <?= number_format($harga, 0, ',', '.') ?>
                    </small>
                </div>

                <div class="summary-item">
                    <small class="text-muted" id="subtotalInfo">Subtotal</small>
                    <div class="d-flex justify-content-between align-items-center">
                        <strong>Total</strong>
                        <div class="total" id="totalHarga">Rp 0</div>
                    </div>
                </div>

                <button class="btn btn-primary w-100 mt-3" id="btnSubmit" disabled>
                    <span class="btn-text">Lanjut Pembayaran</span>
                    <span class="spinner-border spinner-border-sm d-none" id="btnLoading"></span>
                </button>
            </div>

        </div>
    </form>
</div>
<?= $this->endSection() ?>


<?= $this->section('script') ?>
<script>
const selected = new Map();
const harga = <?= (int) $harga ?>;

document.querySelectorAll('.seat').forEach(seat => {
    if (seat.classList.contains('booked')) return;

    seat.addEventListener('click', () => {
        const id = seat.dataset.id;
        const code = seat.dataset.code;

        if (selected.has(id)) {
            selected.delete(id);
            seat.classList.remove('selected');
            seat.classList.add('available');
        } else {
            selected.set(id, code);
            seat.classList.remove('available');
            seat.classList.add('selected');
        }

        renderSummary();
    });
});

function renderSummary() {
    const list = document.getElementById('kursiList');
    const total = document.getElementById('totalHarga');
    const input = document.getElementById('kursiTerpilih');
    const btn = document.getElementById('btnSubmit');

    list.innerHTML = '';

    if (selected.size === 0) {
        list.innerHTML = '<span class="text-muted">Belum ada kursi</span>';
        total.textContent = 'Rp 0';
        btn.disabled = true;
        input.value = '';
        return;
    }

    selected.forEach(code => {
        const span = document.createElement('span');
        span.className = 'kursi-badge';
        span.textContent = code;
        list.appendChild(span);
    });

    input.value = Array.from(selected.keys()).join(',');
    const subtotal = selected.size * harga;

    document.getElementById('subtotalInfo').textContent =
        `Subtotal (${selected.size} × Rp ${harga.toLocaleString('id-ID')})`;

    total.textContent = 'Rp ' + subtotal.toLocaleString('id-ID');
    btn.disabled = false;
}

const form = document.querySelector('form');
const btn = document.getElementById('btnSubmit');
const btnText = document.querySelector('.btn-text');
const btnLoading = document.getElementById('btnLoading');

form.addEventListener('submit', () => {
    btn.disabled = true;
    btnText.textContent = 'Memproses...';
    btnLoading.classList.remove('d-none');
});
</script>
<?= $this->endSection() ?>
