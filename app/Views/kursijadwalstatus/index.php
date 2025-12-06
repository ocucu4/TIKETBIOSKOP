<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<style>
.seat-btn {
    width: 44px;
    height: 36px;
    padding: 0;
    font-size: 13px;
    font-weight: 600;
    border-radius: 8px;
    line-height: 1;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border: none;
    cursor: pointer;
}

.seat-empty {
    background: #dc3545;
    color: white;
}

.seat-filled {
    background: #28a745;
    color: white;
}

.row-label {
    font-size: 15px;
    color: #6c757d;
    font-weight: 600;
}

.room-title {
    background: #f8f9fa;
    padding: 8px 12px;
    border-radius: 6px;
}
</style>

<div class="card shadow-sm p-4">
    <h4 class="fw-semibold mb-4">Status Kursi (Admin)</h4>

    <!-- PILIH ROOM -->
    <form method="get" class="mb-3">
        <select name="room"
                class="form-select w-25"
                onchange="this.form.submit()">
            <?php foreach ($rooms as $r): ?>
                <option value="<?= $r->id_room ?>"
                    <?= $r->id_room == $active_room ? 'selected' : '' ?>>
                    <?= esc($r->nama_room) ?>
                </option>
            <?php endforeach ?>
        </select>
    </form>

    <div class="mb-3">
        <span class="badge bg-danger px-3">Kosong</span>
        <span class="badge bg-success px-3 ms-2">Terisi</span>
    </div>

    <?php if (empty($data)): ?>
        <p class="text-muted">Data kursi belum tersedia.</p>
    <?php else: ?>

        <?php
        $seatIndex = 0;
        $rowIndex  = 0;
        $PER_ROW   = 10;
        ?>

        <div class="mb-4">
            <div class="room-title mb-2 fw-semibold">
                <?= esc(
                    $activeRoomName
                ) ?>
            </div>

            <table class="table table-borderless text-center align-middle mb-0">
                <tbody>

                <?php foreach ($data as $d): ?>

                    <?php
                    if ($seatIndex % $PER_ROW === 0):
                        if ($seatIndex !== 0): ?>
                            </tr>
                        <?php endif; ?>
                        <tr>
                            <th class="row-label">
                                <?= chr(65 + $rowIndex) ?>
                            </th>
                        <?php $rowIndex++; ?>
                    <?php endif; ?>

                    <?php
                    $label = chr(65 + $rowIndex - 1)
                           . (($seatIndex % $PER_ROW) + 1);
                    ?>

                    <td>
                        <button
                            type="button"
                            class="seat-btn <?= $d->status == 1 ? 'seat-filled' : 'seat-empty' ?>"
                            data-bs-toggle="modal"
                            data-bs-target="#modalUbah"
                            onclick="setKursi(<?= $d->id_kursi ?>, <?= $d->status ?>)">
                            <?= $label ?>
                        </button>
                    </td>

                    <?php $seatIndex++; ?>

                <?php endforeach; ?>

                    </tr>
                </tbody>
            </table>
        </div>

    <?php endif; ?>
</div>

<!-- MODAL -->
<div class="modal fade" id="modalUbah" tabindex="-1">
<div class="modal-dialog modal-dialog-centered">
<div class="modal-content">

<div class="modal-header">
    <h5 class="modal-title">Ubah Status Kursi</h5>
    <button class="btn-close" data-bs-dismiss="modal"></button>
</div>

<form method="post" action="<?= base_url('kursijadwalstatus/update') ?>">
<?= csrf_field() ?>
<input type="hidden" name="id_kursi" id="u-id-kursi">

<div class="modal-body">
    <select name="status" id="u-status" class="form-select" required>
        <option value="0">Kosong</option>
        <option value="1">Terisi</option>
    </select>
</div>

<div class="modal-footer">
    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
    <button class="btn btn-primary">Simpan</button>
</div>

</form>

</div>
</div>
</div>

<script>
function setKursi(id, status) {
    document.getElementById('u-id-kursi').value = id;
    document.getElementById('u-status').value = status;
}
</script>

<?= $this->endSection() ?>
