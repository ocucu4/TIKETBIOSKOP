<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= esc($title ?? 'Dashboard') ?> | Admin</title>

<link rel="stylesheet" href="<?= base_url('assets/css/plugins/bootstrap.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/style-preset.css') ?>">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<link rel="icon" href="<?= base_url('assets/images/favicon.svg') ?>">

<style>
body {
    background: #f5f7fa;
    overflow-x: hidden;
    display: flex;
    height: 100%;
}

.pc-sidebar {
    width: 250px;
    height: 100vh;
    background: #eef1f5;
    border-right: 1px solid #d1d5db;
    position: fixed;
    top: 0;
    left: 0;
    transition: .1s;
    overflow-y: auto;
    z-index: 1040;
}

.pc-sidebar.closed {
    width: 0;
    overflow: hidden;
}

.pc-sidebar .nav-link {
    border-radius: 10px;
    padding: 10px 12px;
    transition: .2s;
}
.pc-sidebar .nav-link:hover {
    background: #edf0f5;
    color: #000 !important;
}

.pc-header {
    background: #f3f4f6;
    border: 1px solid #d1d5db;
    border-radius: 12px;
    padding: 12px 20px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    position: fixed;
    top: 0;
    left: 250px;
    right: 0;
    height: 70px;
    box-shadow: 0 3px 8px rgba(0,0,0,0.05);
    transition: .3s;
}
.pc-header.closed {
    left: 0;
}

.pc-content {
    margin-left: 250px;
    width: calc(100% - 250px);
    padding: 90px 20px 0px;
    min-height: 100vh;
    transition: .3s;

    display: flex;
    flex-direction: column;
}

.pc-content.closed {
    margin-left: 0;
    width: 100%;
}

.profile-card {
    position: fixed;
    top: 90px;
    right: -380px;
    width: 350px;
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 8px 25px rgba(0,0,0,.08);
    transition: .35s ease;
    padding: 20px;
    z-index: 4000;
}

.profile-card.show {
    right: 20px;
}

.profile-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,.35);
    display: none;
    z-index: 3000;
}

.profile-overlay.show {
    display: block;
}

.profile-menu .menu-item {
    display: flex;
    align-items: center;
    padding: 10px 8px;
    border-radius: 8px;
    cursor: pointer;
    transition: .2s;
}

.profile-menu .menu-item i {
    margin-right: 10px;
    font-size: 1.2rem;
}

.profile-menu .menu-item:hover {
    background: #f1f3f7;
}

</style>
</head>

<body>

<?= $this->include('layout/sidebar') ?>

<div class="pc-content">
    <div class="pc-header">
        <?= $this->include('layout/header') ?>
    </div>

    <div class="page-wrapper flex-fill">
        <?= $this->renderSection('content') ?>
    </div>

    <?= $this->include('layout/footer') ?>
</div>

<div id="profileCard" class="profile-card">
    <div class="card-inner">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="m-0">Profile</h5>
            <button class="btn-close" onclick="closeProfilePanel()"></button>
        </div>

        <div class="text-center mb-3">
            <img src="<?= base_url('assets/images/user/avatar-1.jpg') ?>" width="70" class="rounded-circle mb-2">
            <h6 class="fw-semibold"><?= session()->get('admin_name') ?></h6>
        </div>

        <hr>

        <a href="<?= base_url('logout') ?>" class="btn btn-danger w-100 mt-2" style="font-weight: 600;">
            <i class="bi bi-box-arrow-right"></i> Logout
        </a>

    </div>
</div>

<div id="profileOverlay" class="profile-overlay" onclick="closeProfilePanel()"></div>

<script src="<?= base_url('assets/js/plugins/popper.min.js') ?>"></script>
<script src="<?= base_url('assets/js/plugins/bootstrap.min.js') ?>"></script>
<script src="<?= base_url('assets/js/plugins/feather.min.js') ?>"></script>
<script src="<?= base_url('assets/js/script.js') ?>"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="<?= base_url('assets/js/plugins/apexcharts.min.js') ?>"></script>
<script src="<?= base_url('assets/js/pages/dashboard-default.js') ?>"></script>

<script>
const sidebar = document.querySelector(".pc-sidebar");
const content = document.querySelector(".pc-content");
const header = document.querySelector(".pc-header");
const toggleBtn = document.getElementById("toggleSidebar");

toggleBtn?.addEventListener("click", () => {
  sidebar.classList.toggle("closed");
  content.classList.toggle("closed");
  header.classList.toggle("closed");
});

function openProfilePanel() {
  document.getElementById("profileCard").classList.add("show");
  document.getElementById("profileOverlay").classList.add("show");
}
function closeProfilePanel() {
  document.getElementById("profileCard").classList.remove("show");
  document.getElementById("profileOverlay").classList.remove("show");
}
</script>

</body>
</html>
