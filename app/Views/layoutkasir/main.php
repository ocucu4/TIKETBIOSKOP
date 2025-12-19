<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= esc($title ?? 'Kasir') ?> | Kasir</title>

    <link rel="stylesheet" href="<?= base_url('assets/css/plugins/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/style-preset.css') ?>">

    <style>
        body {
            background: #f5f7fa;
            overflow-x: hidden;
            display: flex;
            height: 100%;
            margin: 0;
        }

        /* SIDEBAR (ikuti gaya admin) */
        .pc-sidebar {
            width: 250px;
            height: 100vh;
            background: #fff;
            border-right: 1px solid #e5e7eb;
            position: fixed;
            top: 0;
            left: 0;
            overflow-y: auto;
            z-index: 3000;
        }

        /* AREA KANAN: HEADER + CONTENT + FOOTER */
        .pc-content {
            margin-left: 250px;
            width: calc(100% - 250px);
            padding: 90px 20px 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            transition: .3s;
        }

        .pc-header {
            background: #fff;
            border: 1px solid #e5e7eb;
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
            z-index: 3100;
        }

        .page-wrapper {
            flex: 1;
            padding: 0 0 20px 0;
            margin-top: 0;
        }

        footer {
            background: #fff;
            border-top: 1px solid #e5e7eb;
            padding: 10px;
            text-align: center;
            font-size: 13px;
            color: #6b7280;
            margin-top: 10px;
            border-radius: 10px;
        }

        .kasir-header-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
        }
    </style>
</head>

<body>

<?= $this->include('layoutkasir/sidebar') ?>

<div class="pc-content">
    <!-- HEADER -->
    <div class="pc-header">
        <?= $this->include('layoutkasir/header') ?>
    </div>

    <!-- CONTENT -->
    <div class="page-wrapper">
        <?= $this->renderSection('content') ?>
    </div>

    <!-- FOOTER -->
    <?= $this->include('layoutkasir/footer') ?>
</div>

</body>
</html>
