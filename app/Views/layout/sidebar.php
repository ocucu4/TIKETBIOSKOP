<aside class="pc-sidebar bg-white border-end shadow-sm">
  <div class="p-3 text-center border-bottom">
    <img src="<?= base_url('assets/images/tiket-logo.ico') ?>" alt="Logo" height="115">
    <h6>MYCINEMA</h6>
  </div>

  <nav class="nav flex-column p-3">
    <a href="<?= base_url('dashboard') ?>" class="nav-link text-dark fw-semibold mb-2">
      <i data-feather="home" class="me-2"></i> Dashboard
    </a>
    <a href="<?= base_url('bioskop') ?>" class="nav-link text-dark mb-2">
      <i data-feather="map-pin" class="me-2"></i> Bioskop
    </a>
    <a href="<?= base_url('film') ?>" class="nav-link text-dark mb-2">
      <i data-feather="film" class="me-2"></i> Film
    </a>
    <a href="<?= base_url('genre') ?>" class="nav-link text-dark mb-2">
      <i data-feather="sliders" class="me-2"></i> Genre
    </a>
    <a href="<?= base_url('kursi') ?>" class="nav-link text-dark mb-2 d-flex align-items-center">
    <img src="<?= base_url('assets/icons-sidebar/cinema-seats.png') ?>" 
         width="24" height="24" 
         class="me-2" 
         alt="kursi">Kursi
    </a>
    <a href="<?= base_url('pesanan') ?>" class="nav-link text-dark mb-2">
      <i data-feather="shopping-cart" class="me-2"></i> Pesanan
    </a>
    <a href="<?= base_url('detailorder') ?>" class="nav-link text-dark mb-2">
      <i data-feather="shopping-cart" class="me-2"></i> DetailOrder
    </a>
    <hr>
    <a href="#" class="nav-link text-muted small mb-1">LAINNYA</a>
    <a href="#" class="nav-link text-dark mb-2">
      <i data-feather="users" class="me-2"></i> Pengguna
    </a>
    <a href="#" class="nav-link text-dark mb-2">
      <i data-feather="settings" class="me-2"></i> Pengaturan
    </a>
  </nav>
</aside>
