<div class="kasir-header-inner">
    <div>
        <h5 class="mb-0 fw-semibold">Kasir Panel</h5>
        <small class="text-muted">
            Login sebagai: <?= esc(session()->get('nama_user')) ?>
        </small>
    </div>

    <div class="d-flex align-items-center gap-2">
        <span class="badge bg-secondary">
            <?= strtoupper(session()->get('role')) ?>
        </span>
        <a href="<?= base_url('logout') ?>" class="btn btn-sm btn-danger">
            Logout
        </a>
    </div>
</div>
