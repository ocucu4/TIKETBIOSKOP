<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/log.css') ?>">
</head>
<body>
    <div class="box">
        <h2>ADMINISTRATOR</h2>

        <?php if (session()->getFlashdata('error')): ?>
            <div style="color:red;">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('admin/login') ?>" method="post">
            <?= csrf_field() ?>
            <input type="text" name="username" placeholder="Username" required maxlength="30">
            <input type="password" name="password" placeholder="Password" required maxlength="30">
            <input type="submit" value="Masuk !!">
        </form>
    </div>
</body>
</html>
