<?php
$uri = service('uri')->getSegment(1);
?>

<aside class="pc-sidebar bg-white border-end shadow-sm">

  <div class="text-center border-bottom">
    <img src="<?= base_url('assets/images/MYCINEMA.png') ?>" alt="Logo" height="55">
  </div>

  <nav class="nav flex-column px-3 py-3">

    <a href="<?= base_url('dashboard') ?>"
       class="nav-link mb-2 d-flex align-items-center <?= ($uri === 'dashboard' || $uri === '') ? 'active' : '' ?>">
      <img src="<?= base_url('assets/icons-sidebar/Dashboard.png') ?>" width="28" class="me-2">
      <span>Dashboard</span>
    </a>

    <a href="<?= base_url('film') ?>"
       class="nav-link mb-2 d-flex align-items-center <?= ($uri === 'film') ? 'active' : '' ?>">
      <img src="<?= base_url('assets/icons-sidebar/Film.png') ?>" width="28" class="me-2">
      <span>Film</span>
    </a>

    <a href="<?= base_url('genre') ?>"
       class="nav-link mb-2 d-flex align-items-center <?= ($uri === 'genre') ? 'active' : '' ?>">
      <img src="<?= base_url('assets/icons-sidebar/Genre.png') ?>" width="28" class="me-2">
      <span>Genre</span>
    </a>

    <a href="<?= base_url('room') ?>"
       class="nav-link mb-2 d-flex align-items-center <?= ($uri === 'room') ? 'active' : '' ?>">
      <img src="<?= base_url('assets/icons-sidebar/Room.png') ?>" width="28" class="me-2">
      <span>Room</span>
    </a>

    <a href="<?= base_url('jadwaltayang') ?>"
       class="nav-link mb-2 d-flex align-items-center <?= ($uri === 'jadwaltayang') ? 'active' : '' ?>">
      <img src="<?= base_url('assets/icons-sidebar/icon-airing-schedule.png') ?>" width="28" class="me-2">
      <span>Jadwal Tayang</span>
    </a>

    <a href="<?= base_url('kursi') ?>"
       class="nav-link mb-2 d-flex align-items-center <?= ($uri === 'kursi') ? 'active' : '' ?>">
      <img src="<?= base_url('assets/icons-sidebar/cinema-seats.png') ?>" width="28" class="me-2">
      <span>Kursi</span>
    </a>

    <hr>

  </nav>
</aside>
