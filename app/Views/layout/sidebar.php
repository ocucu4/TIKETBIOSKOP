<aside class="pc-sidebar bg-white border-end shadow-sm">
  <div class="p-3 text-center border-bottom">
    <img src="<?= base_url('assets/images/tiket-logo.ico') ?>" alt="Logo" height="115">
    <h6>MYCINEMA</h6>
  </div>

  <nav class="nav flex-column p-3">
    <a href="<?= base_url('dashboard') ?>" class="nav-link text-dark mb-2 d-flex align-items-center">
    <img src="<?= base_url('assets/icons-sidebar/Dashboard.png') ?>" 
         width="24" height="24" 
         class="me-2" 
         alt="kursi">Dashboard
    </a>
    <a href="<?= base_url('bioskop') ?>" class="nav-link text-dark mb-2 d-flex align-items-center">
    <img src="<?= base_url('assets/icons-sidebar/Cinema.png') ?>" 
         width="24" height="24" 
         class="me-2" 
         alt="kursi">Bioskop
    </a>
    <a href="<?= base_url('film') ?>" class="nav-link text-dark mb-2 d-flex align-items-center">
    <img src="<?= base_url('assets/icons-sidebar/Film.png') ?>" 
         width="24" height="24" 
         class="me-2" 
         alt="kursi">Film
    </a>
    <a href="<?= base_url('genre') ?>" class="nav-link text-dark mb-2 d-flex align-items-center">
    <img src="<?= base_url('assets/icons-sidebar/Genre.png') ?>" 
         width="24" height="24" 
         class="me-2" 
         alt="kursi">Genre
    </a>
    <a href="<?= base_url('room') ?>" class="nav-link text-dark mb-2 d-flex align-items-center">
    <img src="<?= base_url('assets/icons-sidebar/Room.png') ?>" 
         width="24" height="24" 
         class="me-2" 
         alt="kursi">Room
    </a>
    <a href="<?= base_url('kursi') ?>" class="nav-link text-dark mb-2 d-flex align-items-center">
    <img src="<?= base_url('assets/icons-sidebar/cinema-seats.png') ?>" 
         width="24" height="24" 
         class="me-2" 
         alt="kursi">Kursi
    </a>

    <hr>
    <p class="menu-title">PROSES PENJUALAN TIKET</p>
    <a href="<?= base_url('order') ?>" class="nav-link text-dark mb-2 d-flex align-items-center">
    <img src="<?= base_url('assets/icons-sidebar/Order.png') ?>" 
         width="28" height="28" 
         class="me-2" 
         alt="kursi">Order
    </a>
    <a href="<?= base_url('detailorder') ?>" class="nav-link text-dark mb-2 d-flex align-items-center">
    <img src="<?= base_url('assets/icons-sidebar/Orderdetail.png') ?>" 
         width="24" height="24" 
         class="me-2" 
         alt="kursi">Detail Order
    </a>
    <a href="<?= base_url('pembayaran') ?>" class="nav-link text-dark mb-2 d-flex align-items-center">
    <img src="<?= base_url('assets/icons-sidebar/Payment.png') ?>" 
         width="24" height="24" 
         class="me-2" 
         alt="kursi">Pembayaran
    </a>
    <hr>
    <p class="menu-title">LAINNYA</p>
    <a href="#" class="nav-link text-dark mb-2">
      <i data-feather="users" class="me-2"></i> Pengguna
    </a>
  </nav>
</aside>