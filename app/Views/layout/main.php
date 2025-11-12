<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= esc($title ?? 'Dashboard') ?> | Tiket Bioskop</title>

  <link rel="stylesheet" href="<?= base_url('assets/css/plugins/bootstrap.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/css/style-preset.css') ?>">
  <link rel="icon" type="image/svg+xml" href="<?= base_url('assets/images/favicon.svg') ?>">
</head>

<body>
  <div class="pc-container">
    <div class="pcoded-wrapper">
      <?= $this->include('layout/sidebar') ?>

      <div class="pcoded-main-container">
        <?= $this->include('layout/header') ?>

        <div class="pcoded-content">
          <div class="pcoded-inner-content">
            <div class="page-wrapper">
              <?= $this->renderSection('content') ?>
            </div>
          </div>
        </div>

        <?= $this->include('layout/footer') ?>
      </div>
    </div>
  </div>

    <style>
    body {
      min-height: 100vh;
      overflow-x: hidden;
      background-color: #f8f9fa;
      display: flex;
    }

     .pc-sidebar {
    width: 250px;
    min-height: 100vh;
    position: fixed;
    top: 0;
    left: 0;
    background: #fff;
    border-right: 1px solid #dee2e6;
    z-index: 1000;
  }

  .pcoded-main-container {
    flex: 1;
    margin-left: 250px;
    padding: 20px;
    background-color: #f8f9fa;
  }

    .pc-header {
      position: sticky;
      top: 0;
      background: #fff;
      border-radius: 12px;
      margin-bottom: 20px;
      padding: 10px 20px;
      box-shadow: 0 1px 5px rgba(0, 0, 0, 0.05);
      z-index: 999;
    }

    footer {
      border-radius: 12px;
      background: #fff;
      box-shadow: 0 -1px 5px rgba(0, 0, 0, 0.03);
      margin-top: 20px;
    }
  </style>

  <script src="<?= base_url('assets/js/plugins/popper.min.js') ?>"></script>
  <script src="<?= base_url('assets/js/plugins/bootstrap.min.js') ?>"></script>
  <script src="<?= base_url('assets/js/plugins/simplebar.min.js') ?>"></script>
  <script src="<?= base_url('assets/js/plugins/feather.min.js') ?>"></script>
  <script src="<?= base_url('assets/js/plugins/apexcharts.min.js') ?>"></script>
  <script src="<?= base_url('assets/js/plugins/clipboard.min.js') ?>"></script>
  <script src="<?= base_url('assets/js/script.js') ?>"></script>
  <script src="<?= base_url('assets/js/theme.js') ?>"></script>
  <script src="<?= base_url('assets/js/fonts/custom-font.js') ?>"></script>

  <?php if (current_url() == base_url('dashboard')) : ?>
    <script src="<?= base_url('assets/js/pages/dashboard-default.js') ?>"></script>
  <?php endif; ?>
</body>
</html>
