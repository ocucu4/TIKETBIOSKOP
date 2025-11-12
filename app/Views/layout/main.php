<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $title ?? 'Dashboard' ?></title>

<link rel="stylesheet" href="<?= base_url('assets/css/bootstrap/css/bootstrap.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/animate.css/css/animate.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/morris.js/css/morris.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/jquery.mCustomScrollbar.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">

<link rel="icon" href="<?= base_url('assets/images/favicon.ico') ?>" type="image/x-icon">

</head>

<body>

  <?= $this->include('layout/sidebar') ?>

  <?= $this->include('layout/header') ?>

  <div class="pcoded-main-container">
    <div class="pcoded-content">
      <?= $this->renderSection('content') ?>
    </div>
  </div>

  <?= $this->include('layout/footer') ?>

    <?= $this->renderSection('content') ?>
  </div>
</div>

<script src="<?= base_url('assets/js/jquery/jquery.min.js') ?>"></script>
<script src="<?= base_url('assets/js/popper.js/popper.min.js') ?>"></script>
<script src="<?= base_url('assets/js/bootstrap/js/bootstrap.min.js') ?>"></script>
<script src="<?= base_url('assets/js/jquery.mCustomScrollbar.concat.min.js') ?>"></script>
<script src="<?= base_url('assets/js/jquery.mousewheel.min.js') ?>"></script>
<script src="<?= base_url('assets/js/pcoded.min.js') ?>"></script>
<script src="<?= base_url('assets/js/script.min.js') ?>"></script>

</body>
</html>
