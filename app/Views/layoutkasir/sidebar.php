<aside class="pc-sidebar bg-white border-end shadow-sm">

  <div class="p-3 text-center border-bottom">
    <img src="<?= base_url('assets/images/tiket-logo.ico') ?>" alt="Logo" height="115">
    <h6>MYCINEMA</h6>
  </div>

  <nav class="nav flex-column p-3">

    <a href="<?= base_url('kasir/dashboard') ?>" 
       class="nav-link text-dark mb-2 d-flex align-items-center">
      <img src="<?= base_url('assets/icons-sidebar-kasir/Dashboard.png') ?>" width="24" class="me-2">
      Dashboard
    </a>

    <a href="<?= base_url('kasir/transaksi') ?>" 
       class="nav-link text-dark mb-2 d-flex align-items-center">
      <img src="<?= base_url('assets/icons-sidebar-kasir/transaksi.png') ?>" width="24" class="me-2">
      Transaksi
    </a>

  </nav>
</aside>
