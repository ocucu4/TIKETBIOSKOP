<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            width: 300px;
            margin: auto;
        }
        .center { text-align: center; }
        .bold { font-weight: bold; }
        .divider {
            border-top: 1px dashed #000;
            margin: 10px 0;
        }
        .seat span {
            display: inline-block;
            border: 1px solid #000;
            padding: 4px 6px;
            margin: 2px;
            font-weight: bold;
        }
        @media print {
            button { display: none; }
        }
    </style>
</head>
<body onload="window.print()">

    <div class="center bold">MYCINEMA</div>
    <div class="center">TIKET BIOSKOP</div>

    <div class="divider"></div>

    <p><strong>Order:</strong> #<?= $order->id_order ?></p>
    <p><strong>Film:</strong><br><?= esc($order->judul_film) ?></p>
    <p><strong>Tanggal:</strong> <?= $order->tanggal ?></p>
    <p><strong>Jam:</strong> <?= $order->jam_mulai ?></p>
    <p><strong>Studio:</strong> <?= esc($order->nama_room) ?></p>

    <div class="divider"></div>

    <p class="bold">Kursi:</p>
    <div class="seat">
        <?php foreach ($kursi as $k): ?>
            <span><?= esc($k->kode_kursi) ?></span>
        <?php endforeach; ?>
    </div>

    <div class="divider"></div>

    <p><strong>Metode:</strong> <?= esc($order->metode_bayar ?? '-') ?></p>
    <p class="bold">Total:
        Rp <?= number_format($order->total_bayar, 0, ',', '.') ?>
    </p>

    <div class="divider"></div>

    <div class="center">Terima kasih</div>
    <div class="center">Simpan tiket ini & Jangan sampai hilang!!</div>

    <button onclick="window.print()">Cetak</button>

</body>
</html>
