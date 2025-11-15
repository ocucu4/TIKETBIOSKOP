<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<div class="page-header"></div>

<div class="row">

  <div class="col-md-4">
    <div class="card">
      <div class="card-body d-flex justify-content-between align-items-center">
        <div>
          <h6>Total Bioskop</h6>
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
          <h3 class="mb-0">6</h3>
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
          <h3 class="mb-0">100</h3>
        </div>
        <i class="ti ti-ticket fs-2 text-warning"></i>
      </div>
    </div>
  </div>
</div>

<div class="row mt-4">
  <div class="col-md-8">
    <div class="card">
      <div class="card-header">
        <h5>Grafik Penjualan Tiket</h5>
      </div>
      <div class="card-body">
        <div id="chart-sales" style="min-height: 320px;"></div>
      </div>
    </div>
  </div>

  <div class="col-md-4">
    <div class="card">
      <div class="card-header">
        <h5>Top Film</h5>
      </div>
      <div class="card-body">
        <ul class="list-group list-group-flush">
          <li class="list-group-item d-flex justify-content-between align-items-center">
            Avatar 2 <span class="badge bg-primary rounded-pill">120</span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            Fast X <span class="badge bg-primary rounded-pill">98</span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            The Marvels <span class="badge bg-primary rounded-pill">85</span>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
  if (typeof ApexCharts !== 'undefined') {
    var options = {
      chart: {
        type: 'area',
        height: 320
      },
      series: [{
        name: 'Tiket Terjual',
        data: [120, 200, 180, 250, 300, 350, 400]
      }],
      xaxis: {
        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul']
      },
      colors: ['#3B82F6']
    };
    var chart = new ApexCharts(document.querySelector("#chart-sales"), options);
    chart.render();
  }
});
</script>

<?= $this->endSection() ?>
