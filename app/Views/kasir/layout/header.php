<nav class="kasir-header">
    <div class="kasir-left">
        <img src="<?= base_url('assets/images/MYCINEMA.png') ?>" alt="Logo">
        <span class="brand">
            MYCINEMA <small>CASHIER</small>
        </span>
    </div>

    <button class="kasir-user" onclick="openKasirProfile()">
        <img src="<?= base_url('assets/images/user/avatar-2.jpg') ?>">
        <span><?= esc(session('nama_user')) ?></span>
    </button>
</nav>
