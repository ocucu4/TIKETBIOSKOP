<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title><?= $title ?? 'MYCINEMA | CASHIER' ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<link rel="icon" href="<?= base_url('assets/images/MYCINEMA.png') ?>">

<style>
html, body {
    height: 100%;
}

body {
    background: #f5f6fa;
    display: flex;
    flex-direction: column;
}

.kasir-header {
    height: 64px;
    background: linear-gradient(90deg, #1f2933, #111827);
    color: #fff;
    padding: 0 24px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.kasir-left {
    display: flex;
    align-items: center;
    gap: 10px;
}

.kasir-left img {
    height: 34px;
}

.brand {
    font-weight: 600;
}
.brand small {
    color: #9ca3af;
}

/* user button */
.kasir-user {
    background: rgba(255,255,255,.08);
    border: none;
    border-radius: 999px;
    padding: 6px 14px;
    display: flex;
    align-items: center;
    gap: 10px;
    color: #fff;
    cursor: pointer;
}

.kasir-user img {
    width: 32px;
    height: 32px;
    border-radius: 50%;
}

main.kasir-content {
    flex: 1;
    padding: 28px;
}

.kasir-profile {
    position: fixed;
    top: 80px;
    right: -360px;
    width: 320px;
    background: #fff;
    border-radius: 14px;
    box-shadow: 0 10px 30px rgba(0,0,0,.15);
    padding: 20px;
    transition: .35s ease;
    z-index: 3000;
}

.kasir-profile.show {
    right: 20px;
}

.kasir-profile img {
    width: 72px;
    border-radius: 50%;
}

.kasir-overlay {
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,.4);
    display: none;
    z-index: 2000;
}

.kasir-overlay.show {
    display: block;
}

/* logout */
.btn-logout {
    background: #dc2626;
    border: none;
    color: #fff;
    font-weight: 600;
}
.btn-logout:hover {
    background: #b91c1c;
}
</style>

<?= $this->renderSection('style') ?>
</head>

<body>

<?= $this->include('kasir/layout/header') ?>

<main class="kasir-content">
    <?= $this->renderSection('content') ?>
</main>

<footer class="text-center text-muted py-3 small">
    © <?= date('Y') ?> MYCINEMA — Sistem Kasir Bioskop
</footer>

<div id="kasirProfile" class="kasir-profile">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="m-0">Profile</h6>
        <button class="btn-close" onclick="closeKasirProfile()"></button>
    </div>

    <div class="text-center mb-3">
        <img src="<?= base_url('assets/images/user/avatar-2.jpg') ?>">
        <h6 class="mt-2 mb-0"><?= esc(session('nama_user')) ?></h6>
    </div>

    <a href="<?= base_url('logout') ?>" class="btn btn-logout w-100 mt-2">
        <i class="bi bi-box-arrow-right me-2"></i> Logout
    </a>
</div>

<div id="kasirOverlay" class="kasir-overlay" onclick="closeKasirProfile()"></div>

<script>
function openKasirProfile() {
    document.getElementById('kasirProfile').classList.add('show');
    document.getElementById('kasirOverlay').classList.add('show');
}
function closeKasirProfile() {
    document.getElementById('kasirProfile').classList.remove('show');
    document.getElementById('kasirOverlay').classList.remove('show');
}
</script>

<?= $this->renderSection('script') ?>
</body>
</html>
