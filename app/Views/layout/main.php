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
    transition: .25s ease;
    overflow-y: auto;
    z-index: 1040;
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

.pc-sidebar.mini {
    width: 80px;
}

.pc-sidebar.mini .nav-link {
    justify-content: center;
    padding: 10px;
}

.pc-sidebar.mini .nav-link span {
    display: none;
}

.pc-sidebar.mini .nav-link img {
    margin-right: 0 !important;
    width: 28px;
    height: 28px;
    object-fit: contain;
}

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

.table-premium {
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 14px rgba(0,0,0,.06);
    table-layout: fixed;
    width: 100%;
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

.action-btn {
    width: 36px;
    height: 36px;
    padding: 6px;
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

.empty-state {
    padding: 40px 0;
    color: #6b7280;
}

.table-premium th:nth-child(2),
.table-premium td:nth-child(2) {
    max-width: 420px;
}

.table-premium td:nth-child(2) {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.dashboard-card {
  opacity: 0;
  transform: translateY(20px);
  animation: cardFadeUp 0.6s ease forwards;
  transition: transform .2s ease, box-shadow .2s ease;
  cursor: default;
  background: linear-gradient(
    180deg,
    var(--bg-card),
    var(--bg-soft)
  );
}

.dashboard-card h3 {
  transition: transform .2s ease;
}

.dashboard-card:hover h3 {
  transform: scale(1.05);
}

.dashboard-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 8px 20px rgba(0,0,0,.08);
  border-color: #c7d2fe;
}

.dashboard-card.delay-1 { animation-delay: .1s; }
.dashboard-card.delay-2 { animation-delay: .2s; }
.dashboard-card.delay-3 { animation-delay: .3s; }
.dashboard-card.delay-4 { animation-delay: .4s; }

@keyframes cardFadeUp {
  to { opacity: 1; transform: translateY(0); }
}

.dashboard-section { margin-bottom: 1.5rem; }

.collapse-body {
  overflow: hidden;
  max-height: 500px;
  transition: max-height .35s ease, padding .2s ease;
}

.collapse-body.collapsed {
  max-height: 0;
  padding-top: 0;
  padding-bottom: 0;
}

.card {
  height: auto;
}

.card-header {
  user-select: none;
}
.card-header:hover {
  background: #f8fafc;
}

.top-film-item {
  transition: transform 0.35s ease, background-color 0.2s ease;
}

.top-film-item.moving {
  background-color: #f1f5ff;
}

.rank {
  width: 22px;
  height: 22px;
  font-weight: 600;
  border-radius: 50%;
  background: #e0e7ff;
  color: #1e3a8a;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 13px;
}

#topFilmList.collapsed {
  max-height: 0;
  overflow: hidden;
}

.col-md-4 .dashboard-card {
  align-self: flex-start;
}

.list-group-item {
  transition: background-color .2s ease;
}

.list-group-item:hover {
  background-color: #f8fafc;
}

.chart-responsive {
  min-height: 260px;
  height: 35vh;
  max-height: 420px;
  overflow: hidden;
}

@media (max-width: 1200px) {
  .col-md-8, .col-md-4 {
    flex: 0 0 100%;
    max-width: 100%;
  }
}

html {
  font-size: clamp(14px, 1vw, 16px);
}

.dashboard-spacer {
  min-height: clamp(4vh, 8vh, 12vh);
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

if (localStorage.getItem('sidebarMini') === 'true') {
    sidebar.classList.add('mini');
}

toggleBtn?.addEventListener('click', () => {
    sidebar.classList.toggle('mini');
    localStorage.setItem(
        'sidebarMini',
        sidebar.classList.contains('mini')
    );
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
