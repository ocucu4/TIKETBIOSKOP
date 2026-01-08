<nav class="navbar navbar-dark bg-dark px-4">
    <div class="d-flex align-items-center">
        <img src="<?= base_url('assets/images/MYCINEMA.png') ?>" alt="Logo"
             style="height:32px" class="me-2">
        <span class="navbar-brand mb-0 h5">Kasir Bioskop</span>
    </div>

    <div class="d-flex align-items-center text-white">
        <span class="me-3">
            <?= session('nama_user') ?> (Kasir)
        </span>
        <a href="<?= base_url('logout') ?>" class="btn btn-sm btn-outline-light">
            Logout
        </a>
    </div>
</nav>
