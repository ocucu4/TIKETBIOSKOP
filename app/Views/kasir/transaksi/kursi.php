<?= $this->extend('layoutkasir/main') ?>
<?= $this->section('content') ?>

<h4 class="fw-semibold mb-4">Pilih Kursi</h4>

<form method="post" action="<?= base_url('kasir/buat-order') ?>" id="formOrder">
    <?= csrf_field() ?>

    <input type="hidden" name="id_tayang" value="<?= esc($id_tayang) ?>">
    <input type="hidden" name="kursi_terpilih" id="kursiTerpilih">

    <div class="row">
        <!-- AREA KURSI -->
        <div class="col-md-8">

            <div class="bg-white rounded p-4 mb-3 shadow-sm">
                <div class="text-center mb-3 fw-semibold text-muted">
                    SCREEN
                    <div style="height:6px;background:#d1d5db;border-radius:10px;margin-top:10px"></div>
                </div>

                <?php
                $rows = [];
                foreach ($kursi as $k) {
                    $row = substr($k->kode_kursi, 0, 1);
                    $rows[$row][] = $k;
                }
                ?>

                <?php foreach ($rows as $row => $list): ?>
                    <div class="d-flex align-items-center mb-2">
                        <strong style="width:25px"><?= $row ?></strong>

                        <?php foreach ($list as $k): ?>
                            <div
                                class="seat 
                                    <?= $k->status ? 'occupied' : 'available' ?>"
                                data-id="<?= $k->id_kursi ?>"
                                data-kode="<?= $k->kode_kursi ?>"
                                <?= $k->status ? '' : 'onclick="toggleSeat(this)"' ?>
                            >
                                <?= substr($k->kode_kursi, 1) ?>
                            </div>
                        <?php endforeach ?>
                    </div>
                <?php endforeach ?>
            </div>

            <div class="mt-2 text-muted small">
                <span class="me-3"><span class="legend available"></span> Available</span>
                <span class="me-3"><span class="legend occupied"></span> Occupied</span>
                <span><span class="legend selected"></span> Selected</span>
            </div>
        </div>

        <!-- RINGKASAN -->
        <div class="col-md-4">
            <div class="bg-white rounded p-4 shadow-sm">
                <h6 class="fw-semibold mb-3">Selected Seats</h6>

                <div id="seatList" class="mb-3 text-muted">
                    No seats selected
                </div>

                <hr>

                <div class="d-flex justify-content-between mb-2">
                    <span>Seats (<span id="seatCount">0</span>)</span>
                    <strong>Rp <span id="totalHarga">0</span></strong>
                </div>

                <div class="d-flex justify-content-between mb-3">
                    <span>Price per seat</span>
                    <strong>Rp 55.000</strong>
                </div>

                <button type="submit" class="btn btn-primary w-100" id="btnSubmit" disabled>
                    Confirm Selection
                </button>
            </div>
        </div>
    </div>
</form>

<style>
.seat{
    width:42px;
    height:42px;
    border-radius:10px;
    margin:4px;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:13px;
    cursor:pointer;
    user-select:none;
}
.available{background:#22c55e;color:#fff}
.occupied{background:#ef4444;color:#fff;cursor:not-allowed}
.selected{background:#3b82f6 !important;color:#fff}

.legend{
    display:inline-block;
    width:16px;
    height:16px;
    border-radius:4px;
}
.legend.available{background:#22c55e}
.legend.occupied{background:#ef4444}
.legend.selected{background:#3b82f6}
</style>

<script>
let selected = [];
const harga = 55000;

function toggleSeat(el) {
    const id = el.dataset.id;
    const kode = el.dataset.kode;

    if (el.classList.contains('selected')) {
        el.classList.remove('selected');
        selected = selected.filter(s => s.id !== id);
    } else {
        el.classList.add('selected');
        selected.push({id, kode});
    }

    updateSummary();
}

function updateSummary() {
    const list = document.getElementById('seatList');
    const count = document.getElementById('seatCount');
    const total = document.getElementById('totalHarga');
    const input = document.getElementById('kursiTerpilih');
    const btn = document.getElementById('btnSubmit');

    if (selected.length === 0) {
        list.innerText = 'No seats selected';
        btn.disabled = true;
    } else {
        list.innerText = selected.map(s => s.kode).join(', ');
        btn.disabled = false;
    }

    count.innerText = selected.length;
    total.innerText = selected.length * harga;
    input.value = selected.map(s => s.id).join(',');
}
</script>

<?= $this->endSection() ?>
