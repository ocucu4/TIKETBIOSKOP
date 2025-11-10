<?php
helper('url');
$session = session();

if (!$session->get('isLogin')) {
    header("Location: " . base_url('admin/login'));
    exit;
}

$admin = ($session->get('level') === 'admin') ? '' : 'hidden';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrator</title>

    <!-- Fonts dan CSS -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/css/back-end.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/thickbox.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/js/jquery-ui.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/dist/sweetalert.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/datatables/media/css/jquery.dataTables.css') ?>">
</head>

<body>
    <div class="bar-top"></div>

    <div class="side-menu">
        <div class="avatar">
            <img src="<?= base_url('assets/img/user.svg') ?>" alt="User">
            <p><?= esc($session->get('level')) ?></p>
        </div>

        <div class="main-menu">
            <p>Main Navigation</p>
        </div>

        <ul>
            <a href="<?= base_url('admin/dashboard') ?>"><li>Beranda</li></a>

            <div <?= $admin ?>>
                <a href="#"><li>Member</li></a>
                <a href="#"><li>Film</li></a>
                <a href="#"><li>Tiket</li></a>
                <a href="#"><li>Jadwal</li></a>
                <a href="#"><li>Ruang</li></a>
                <a href="#"><li>Sesi</li></a>
                <a href="#"><li>Pemesan</li></a>
            </div>

            <a href="#" id="laporan"><li>Laporan</li></a>
            <div class="main" hidden style="margin-left:20px;">
                <a href="#" style="color: #fff;">Laporan Pemesan Tiket</a>
            </div>

            <a href="<?= base_url('admin/logout') ?>"><li>Logout</li></a>
        </ul>
    </div>

    <div class="content">
        <h1>Selamat Datang di Dashboard Admin</h1>
        <p>Gunakan menu di sebelah kiri untuk mengelola data bioskop, tiket, dan lainnya. kalau tra mau ya tra usah.</p>
    </div>

    <!-- Script JS -->
    <script src="<?= base_url('assets/js/jquery.js') ?>"></script>
    <script src="<?= base_url('assets/js/jquery-ui.js') ?>"></script>
    <script src="<?= base_url('assets/js/function.js') ?>"></script>
    <script src="<?= base_url('assets/dist/sweetalert.min.js') ?>"></script>
    <script src="<?= base_url('assets/datatables/media/js/jquery.dataTables.js') ?>"></script>

    <script>
        $(document).ready(function(){
            $('#table').DataTable();
        });
        $("#laporan").click(function() {
            $(".main").toggle(400);
        });
    </script>
</body>
</html>
