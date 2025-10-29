<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Pemesanan Tiket - <?= esc($film['judul_film']) ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card shadow-sm">
        <div class="card-body">
          <h3 class="card-title mb-3">Pesan Tiket Film: <strong><?= esc($film['judul_film']) ?></strong></h3>

          <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
          <?php endif; ?>

          <form action="<?= base_url('/order/store') ?>" method="post" id="orderForm" autocomplete="off">
            <input type="hidden" name="id_film" value="<?= esc($film['id_film']) ?>">
            <input type="hidden" name="total_bayar" id="totalBayarHidden" value="0">

            <div class="mb-3">
              <label class="form-label">Nama Pemesan</label>
              <input type="text" name="nama_pemesan" class="form-control" required>
            </div>

            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label">Jumlah Tiket</label>
                <input type="number" name="jumlah_tiket" id="jumlahTiket" class="form-control" required min="1" value="1">
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label">Harga per Tiket</label>
                <input type="text" class="form-control" id="hargaTampil" value="Rp <?= number_format($film['harga_tiket'],0,',','.') ?>" readonly>
              </div>
            </div>

            <div class="mb-3">
              <label class="form-label">Total Bayar</label>
              <div class="d-flex gap-2">
                <input type="text" id="totalTampil" class="form-control fw-bold" value="Rp <?= number_format($film['harga_tiket'],0,',','.') ?>" readonly>
                <button type="button" id="btnReset" class="btn btn-outline-secondary">Reset</button>
              </div>
            </div>

            <div class="d-flex gap-2">
              <button type="submit" class="btn btn-primary">Pesan Sekarang</button>
              <a href="<?= base_url('/') ?>" class="btn btn-secondary">Kembali</a>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>

<script>
  (function(){
    const harga = Number(<?= (int)$film['harga_tiket'] ?>);
    const jumlahEl = document.getElementById('jumlahTiket');
    const totalTampil = document.getElementById('totalTampil');
    const totalHidden = document.getElementById('totalBayarHidden');
    const btnReset = document.getElementById('btnReset');

    function formatRupiah(n){
      return 'Rp ' + n.toLocaleString('id-ID');
    }

    function updateTotal(){
      const j = Number(jumlahEl.value) || 0;
      const total = j * harga;
      totalHidden.value = total;
      totalTampil.value = formatRupiah(total);
    }

    updateTotal();
    jumlahEl.addEventListener('input', updateTotal);
    btnReset.addEventListener('click', function(){
      jumlahEl.value = 1;
      updateTotal();
      jumlahEl.focus();
    });

    document.getElementById('orderForm').addEventListener('submit', function(e){
      if ((Number(jumlahEl.value) || 0) < 1) {
        e.preventDefault();
        alert('Masukkan jumlah tiket minimal 1.');
        jumlahEl.focus();
        return false;
      }
    });

  })();
</script>

</body>
</html>
