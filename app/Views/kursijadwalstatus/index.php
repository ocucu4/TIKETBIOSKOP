<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<style>
.table-premium thead {
    background: #4a90e2;
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

    <h4 class="fw-semibold mb-4">
        Status Kursi
    </h4>

    <table class="table table-premium align-middle">
        <thead>
            <tr>
                <th style="width:60px">No</th>
                <th>Kode Kursi</th>
                <th>Status</th>
                <th class="text-center" style="width:120px">Aksi</th>
            </tr>
        </thead>
        <tbody>

        <?php if (!empty($data)): ?>
            <?php $no = 1; foreach ($data as $d): ?>
            <tr>
                <td><?= $no++ ?></td>

                <td class="fw-semibold"><?= esc($d->kode_kursi) ?></td>

                <td>
                    <?php if ($d->status == 1): ?>
                        <span class="badge bg-danger px-3">Terisi</span>
                    <?php else: ?>
                        <span class="badge bg-success px-3">Kosong</span>
                    <?php endif ?>
                </td>

                <td class="text-center">
                    <button class="btn btn-outline-primary action-btn"
                            data-bs-toggle="modal"
                            data-bs-target="#modalUbah"
                            onclick='editStatus(<?= json_encode($d) ?>)'>
                        <i data-feather="edit"></i>
                    </button>
                </td>
            </tr>
            <?php endforeach; ?>

        <?php else: ?>
            <tr>
                <td colspan="4" class="text-center text-muted py-3">
                    Tidak ada data kursi
                </td>
            </tr>
        <?php endif ?>

        </tbody>
    </table>
</div>

<!-- MODAL UPDATE -->
<div class="modal fade" id="modalUbah" tabindex="-1">
<div class="modal-dialog modal-dialog-centered">
<div class="modal-content">

<div class="modal-header">
<h5 class="modal-title fw-semibold">Ubah Status Kursi</h5>
<button class="btn-close" data-bs-dismiss="modal"></button>
</div>

<form id="formUbah" method="post">
<?= csrf_field() ?>

<div class="modal-body">
    <div class="mb-3">
        <label class="form-label fw-semibold">Status</label>
        <select name="status" id="u-status" class="form-select" required>
            <option value="0">Kosong</option>
            <option value="1">Terisi</option>
        </select>
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

<script>
function editStatus(d) {
    document.getElementById('u-status').value = d.status;
    document.getElementById('formUbah').action =
        "<?= base_url('kursijadwalstatus/update') ?>/" + d.id_status;
}
feather.replace();
</script>

<?= $this->endSection() ?>
