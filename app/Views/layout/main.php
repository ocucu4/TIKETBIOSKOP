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
<link rel="icon" href="<?= base_url('assets/images/MYCINEMA.png') ?>">

<style>
/* ===============================
   BASE LAYOUT
   =============================== */
body {
    background: #f5f7fa;
    overflow-x: hidden;
    display: flex;
    min-height: 100vh;
}

/* ===============================
   SIDEBAR
   =============================== */
.pc-sidebar {
    width: 250px;
    height: 100vh;
    background: #eef1f5;
    border-right: 1px solid #d1d5db;
    position: fixed;
    top: 0;
    left: 0;
    overflow-y: auto;
    transition: .25s ease;
    z-index: 1040;
}

.pc-sidebar.mini {
    width: 80px;
}

.pc-sidebar .nav-link {
    border-radius: 10px;
    padding: 10px 12px;
    transition: .2s;
}

.pc-sidebar .nav-link:hover {
    background: #edf0f5;
}

.pc-sidebar .nav-link.active {
    background: #eef2ff;
    color: #1e3a8a !important;
    font-weight: 600;
}

.pc-sidebar .nav-link.active img {
    filter: brightness(0) saturate(100%) invert(20%) sepia(90%) saturate(300%) hue-rotate(210deg);
}

.pc-sidebar.mini .nav-link {
    justify-content: center;
}

.pc-sidebar.mini .nav-link span {
    display: none;
}

/* ===============================
   HEADER & CONTENT
   =============================== */
.pc-header {
    background: #f3f4f6;
    border: 1px solid #d1d5db;
    border-radius: 12px;
    padding: 12px 20px;
    position: fixed;
    top: 0;
    left: 250px;
    right: 0;
    height: 70px;
    box-shadow: 0 3px 8px rgba(0,0,0,.05);
    transition: .25s ease;
    z-index: 1030;
}

.pc-content {
    margin-left: 250px;
    width: calc(100% - 250px);
    padding: 80px 20px 0;
    min-height: calc(100vh - 70px);
    transition: .25s ease;
    display: flex;
    flex-direction: column;
}

.pc-sidebar.mini + .pc-content {
    margin-left: 80px;
    width: calc(100% - 80px);
}

.pc-sidebar.mini + .pc-content .pc-header {
    left: 80px;
}

/* ===============================
   PROFILE PANEL
   =============================== */
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
    inset: 0;
    background: rgba(0,0,0,.35);
    display: none;
    z-index: 3000;
}

.profile-overlay.show {
    display: block;
}

/* ===============================
   TABLE
   =============================== */
.table-premium {
    width: 100%;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 14px rgba(0,0,0,.06);
    background: #fff;
}

.table-premium thead {
    background: #f8fafc;
    color: #111827;
    font-weight: 600;
}

.table-premium th,
.table-premium td {
    padding: 12px;
    vertical-align: middle;
}

.table-premium thead th {
    text-transform: uppercase;
    font-size: 12px;
    letter-spacing: .4px;
}

.table-premium tbody tr:hover {
    background-color: #f0f6ff;
}

.empty-state {
    padding: 40px 0;
    color: #6b7280;
}

/* ===============================
   ACTION BUTTON
   =============================== */
.action-btn {
    width: 36px;
    height: 36px;
    padding: 6px;
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

/* ===============================
   JADWAL TAYANG
   =============================== */
.table-jadwal {
    table-layout: auto;
}

.table-jadwal .col-harga {
    white-space: nowrap;
    text-align: right;
}

/* ===============================
   CARD & DASHBOARD
   =============================== */
.card {
    height: auto;
}

.dashboard-card {
    opacity: 0;
    transform: translateY(20px);
    animation: cardFadeUp 0.6s ease forwards;
    transition: transform .2s ease, box-shadow .2s ease;
    background: linear-gradient(180deg, var(--bg-card), var(--bg-soft));
}

.dashboard-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 20px rgba(0,0,0,.08);
}

@keyframes cardFadeUp {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* ===============================
   RESPONSIVE
   =============================== */
@media (max-width: 1200px) {
    .col-md-8,
    .col-md-4 {
        flex: 0 0 100%;
        max-width: 100%;
    }
}

html {
    font-size: clamp(14px, 1vw, 16px);
}

/* ===============================
   RESPONSIVE TABLE
   =============================== */
@media (max-width: 768px) {

    .pc-header {
        left: 0 !important;
        border-radius: 0;
    }

    .pc-content {
        margin-left: 0 !important;
        width: 100%;
        padding: 90px 12px 12px;
    }

    .pc-sidebar {
        transform: translateX(-100%);
        position: fixed;
    }

    .pc-sidebar.show {
        transform: translateX(0);
    }

    /* ===== TABLE STACK MODE ===== */
    .table-premium thead {
        display: none;
    }

    .table-premium,
    .table-premium tbody,
    .table-premium tr,
    .table-premium td {
        display: block;
        width: 100%;
    }

    .table-premium tr {
        margin-bottom: 12px;
        border-radius: 12px;
        background: #fff;
        box-shadow: 0 2px 10px rgba(0,0,0,.05);
        padding: 12px;
    }

    .table-premium td {
        padding: 6px 0;
        border: none;
        text-align: left !important;
    }

    .table-premium td::before {
        content: attr(data-label);
        font-size: 11px;
        font-weight: 600;
        color: #6b7280;
        display: block;
        text-transform: uppercase;
        margin-bottom: 2px;
    }

    .table-premium .action-group {
        display: flex;
        justify-content: flex-start;
        gap: 8px;
        margin-top: 8px;
    }

    .action-btn {
        width: 34px;
        height: 34px;
    }
}

/* ===============================
   SIDEBAR OVERLAY
   =============================== */
.sidebar-overlay {
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,.35);
    z-index: 1035;
    display: none;
}

.sidebar-overlay.show {
    display: block;
}

/* ===============================
   SIDEBAR ACTIVE UX POLISH
   =============================== */

.pc-sidebar .nav-link {
    position: relative;
    overflow: hidden;
}

/* indicator bar */
.pc-sidebar .nav-link::before {
    content: "";
    position: absolute;
    left: -6px;
    top: 50%;
    width: 4px;
    height: 0;
    background: #4f46e5; /* indigo-600 */
    border-radius: 4px;
    transform: translateY(-50%);
    transition: height .25s ease, left .25s ease;
}

/* active state */
.pc-sidebar .nav-link.active::before {
    height: 60%;
    left: 0;
}

/* subtle slide effect */
.pc-sidebar .nav-link.active {
    transform: translateX(4px);
}

/* smooth hover (non-active) */
.pc-sidebar .nav-link:not(.active):hover {
    transform: translateX(2px);
}

.pc-sidebar.mini .nav-link.active {
    transform: none;
}

.pc-sidebar.mini .nav-link.active::before {
    height: 70%;
    left: 2px;
}

</style>
</head>

<body>

<?= $this->include('layout/sidebar') ?>
<div id="sidebarOverlay" class="sidebar-overlay"></div>

<div class="pc-content">
    <div class="pc-header">
        <?= $this->include('layout/header') ?>
    </div>

    <div class="page-wrapper flex-fill">
        <?= $this->renderSection('content') ?>
    </div>

    <?= $this->include('layout/footer') ?>
</div>

<div id="profileCard" class="profile-card"></div>
<div id="profileOverlay" class="profile-overlay" onclick="closeProfilePanel()"></div>

<script src="<?= base_url('assets/js/plugins/popper.min.js') ?>"></script>
<script src="<?= base_url('assets/js/plugins/bootstrap.min.js') ?>"></script>
<script src="<?= base_url('assets/js/plugins/feather.min.js') ?>"></script>
<script src="<?= base_url('assets/js/script.js') ?>"></script>
<script src="<?= base_url('assets/js/plugins/apexcharts.min.js') ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
const sidebar   = document.querySelector('.pc-sidebar');
const toggleBtn = document.getElementById('toggleSidebar');
const overlay   = document.getElementById('sidebarOverlay');

/* restore desktop mini state */
if (window.innerWidth > 768 && localStorage.getItem('sidebarMini') === 'true') {
    sidebar.classList.add('mini');
}

toggleBtn?.addEventListener('click', () => {

    /* MOBILE */
    if (window.innerWidth <= 768) {
        sidebar.classList.toggle('show');
        overlay.classList.toggle('show');
        return;
    }

    /* DESKTOP */
    sidebar.classList.toggle('mini');
    localStorage.setItem(
        'sidebarMini',
        sidebar.classList.contains('mini')
    );
});

/* click outside */
overlay?.addEventListener('click', () => {
    sidebar.classList.remove('show');
    overlay.classList.remove('show');
});

/* reset state on resize */
window.addEventListener('resize', () => {
    if (window.innerWidth > 768) {
        sidebar.classList.remove('show');
        overlay.classList.remove('show');
    }
});
</script>

</body>
</html>
