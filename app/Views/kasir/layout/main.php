<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'MYCINEMA | CASHIER' ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="icon" href="<?= base_url('assets/images/MYCINEMA.png') ?>">

    <style>
        body {
            background: #f5f6fa;
        }

        .kasir-content {
            padding: 24px;
        }

    </style>
</head>
<body>

    <?= $this->include('kasir/layout/header') ?>

    <main class="kasir-content">
        <?= $this->renderSection('content') ?>
    </main>

    <?= $this->include('kasir/layout/footer') ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
