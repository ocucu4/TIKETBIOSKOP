<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<div class="page-header"></div>

<div class="row">

  <div class="col-md-4">
    <div class="card">
      <div class="card-body d-flex justify-content-between align-items-center">
        <div>
          <h6>Total Kasir</h6>
          <h3 class="mb-0">1</h3>
        </div>
        <i class="ti ti-building fs-2 text-primary"></i>
      </div>
    </div>
  </div>

  <div class="col-md-4">
    <div class="card">
      <div class="card-body d-flex justify-content-between align-items-center">
        <div>
          <h6>Total Film</h6>
          <h3 class="mb-0">0</h3>
        </div>
        <i class="ti ti-movie fs-2 text-success"></i>
      </div>
    </div>
  </div>

  <div class="col-md-4">
    <div class="card">
      <div class="card-body d-flex justify-content-between align-items-center">
        <div>
          <h6>Tiket Terjual</h6>
          <h3 class="mb-0">0</h3>
        </div>
        <i class="ti ti-ticket fs-2 text-warning"></i>
      </div>
    </div>
  </div>

</div>

<div class="row mt-4">

  <div class="col-md-8">
    <div class="card h-100">
      <div class="card-header">
        <h5>Grafik Penjualan</h5>
      </div>
      <div class="card-body">
        <div id="customer-rate-graph"></div>
      </div>
    </div>
  </div>

  <div class="col-md-4">
    <div class="card h-100">
      <div class="card-header">
        <h5>Top Film</h5>
      </div>
      <div class="card-body">
        <ul class="list-group list-group-flush">
          <li class="list-group-item d-flex justify-content-between align-items-center">
            Inside Out 2 <span class="badge bg-primary rounded-pill">0</span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            ZooTopia 2 <span class="badge bg-primary rounded-pill">0</span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            Joker 2 <span class="badge bg-primary rounded-pill">0</span>
          </li>
        </ul>
      </div>
    </div>
  </div>

</div>

<?= $this->endSection() ?>
