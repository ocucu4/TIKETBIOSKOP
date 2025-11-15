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
      min-height: 100vh;
      background: #fff;
      border-right: 1px solid #e5e7eb;
      position: fixed;
      top: 0;
      left: 0;
      z-index: 3100;
      transition: .3s;
  }

  .pc-content {
      margin-left: 250px;
      width: calc(100% - 250px);
      padding: 0 20px;
      transition: .3s;
      min-height: calc(100vh - 100px);
      display: flex;
      flex-direction: column;
  }

  .pc-header {
      background: #fff;
      border: 1px solid #e5e7eb;
      border-radius: 12px;
      padding: 12px 20px;
      padding-right: 40px;
      margin-top: 20px;
      margin-bottom: 10px;
      display: flex;
      align-items: center;
      justify-content: space-between;

      position: static;
      top: 0;
      z-index: 2000;
  }

  footer {
    margin-top: auto;
  }

  .page-wrapper {
      margin-top: auto;
      margin-bottom: 20px;
  }

  @media (max-width: 992px) {
      .pc-sidebar {
          transform: translateX(-250px);
      }
      .pc-sidebar.active {
          transform: translateX(0);
      }
      .pc-content {
          margin-left: 0;
          width: 100%;
      }
      .pc-header {
          margin-top: 15px;
      }
      .page-wrapper {
          margin-top: 10px;
      }
  }

  .profile-panel {
      position: fixed;
      top: 0;
      right: -320px;
      width: 320px;
      height: 100vh;
      background: #fff;
      border-left: 1px solid #e5e7eb;
      padding: 20px;
      transition: .35s;
      z-index: 3300;
  }
  .profile-panel.open {
      right: 0;
  }

  .profile-overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0,0,0,.35);
      backdrop-filter: blur(2px);
      display: none;
      z-index: 3200;
      transition: 0.3s;
  }
  .profile-overlay.show {
      display: block;
  }

  #sidebarOverlay {
      position: fixed;
      top:0;
      left:0;
      width:100%;
      height:100%;
      background: rgba(0,0,0,0.25);
      backdrop-filter: blur(2px);
      display:none;
      z-index:3000;
      transition: 0.3s;
  }

  </style>
</head>

<body>

  <?= $this->include('layout/sidebar') ?>

  <div class="pc-content">

      <div class="pc-header">
          <?= $this->include('layout/header') ?>
      </div>

      <div class="page-wrapper">
          <?= $this->renderSection('content') ?>
      </div>

      <?= $this->include('layout/footer') ?>

      <div id="sidebarOverlay"></div>

  </div>

  <div id="profilePanel" class="profile-panel">
      <div class="d-flex justify-content-between">
          <h5>Profil</h5>
          <button class="btn-close" onclick="closeProfilePanel()"></button>
      </div>

      <div class="text-center mt-3">
          <img src="<?= base_url('assets/images/user/mypfp.jpg') ?>" width="70" class="rounded-circle mb-2">
          <h6 class="fw-semibold">Admin</h6>
          <p class="text-muted small">administrator@system.local</p>

          <hr>

          <a class="btn btn-outline-primary w-100 mb-2">Profil</a>
          <a class="btn btn-danger w-100">Keluar</a>
      </div>
  </div>

  <div id="profileOverlay" class="profile-overlay" onclick="closeProfilePanel()"></div>

  <script src="<?= base_url('assets/js/plugins/popper.min.js') ?>"></script>
  <script src="<?= base_url('assets/js/plugins/bootstrap.min.js') ?>"></script>
  <script src="<?= base_url('assets/js/plugins/feather.min.js') ?>"></script>
  <script src="<?= base_url('assets/js/script.js') ?>"></script>

  <script>
      const sidebar = document.querySelector('.pc-sidebar');
      const sidebarOverlay = document.getElementById('sidebarOverlay');

      document.getElementById('toggleSidebar')?.addEventListener('click', () => {
          sidebar.classList.add('active');
          sidebarOverlay.style.display = 'block';
      });

      sidebarOverlay.addEventListener('click', () => {
          sidebar.classList.remove('active');
          sidebarOverlay.style.display = 'none';
      });

      function openProfilePanel() {
          profilePanel.classList.add('open');
          profileOverlay.classList.add('show');
      }

      function closeProfilePanel() {
          profilePanel.classList.remove('open');
          profileOverlay.classList.remove('show');
      }
  </script>

</body>
</html>
