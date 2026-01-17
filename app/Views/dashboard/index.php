<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="row dashboard-section">

  <div class="col-md-4">
    <div class="card dashboard-card delay-1">
      <div class="card-body">
        <h6>Total Kasir</h6>
        <h3><?= $totalKasir ?></h3>
      </div>
    </div>
  </div>

  <div class="col-md-4">
    <div class="card dashboard-card delay-2">
      <div class="card-body">
        <h6>Total Film</h6>
        <h3><?= $totalFilm ?></h3>
      </div>
    </div>
  </div>

  <div class="col-md-4">
    <div class="card dashboard-card delay-3">
      <div class="card-body">
        <h6>Tiket Terjual</h6>
        <h3><?= $tiketTerjual ?></h3>
      </div>
    </div>
  </div>

</div>

<div class="row">

  <div class="col-md-8">
    <div class="card">
      <div class="card-header">
        <h5 class="mb-1">Grafik Penjualan</h5>
        <small class="text-muted" id="chartInsight">
          Memuat insight penjualan...
        </small>
      </div>
      <div class="card-body">
        <div id="grafik-penjualan" class="chart-responsive"></div>
      </div>
    </div>
  </div>

  <div class="col-md-4">
    <div class="card dashboard-card delay-4">
      <div class="card-header d-flex justify-content-between align-items-center"
           style="cursor:pointer"
           onclick="toggleTopFilm()">
        <h5 class="mb-0">Top Film</h5>
        <i id="topFilmIcon" class="bi bi-chevron-down"></i>
      </div>

      <div class="collapse-body" id="topFilmBody">
       <ul class="list-group list-group-flush" id="topFilmList">
        <?php foreach ($topFilm as $index => $f): ?>
          <li class="list-group-item d-flex align-items-center top-film-item"
              data-film="<?= esc($f['judul_film']) ?>"
              data-total="<?= $f['total'] ?>">
        
            <span class="rank me-3"><?= $index + 1 ?></span>
        
            <span class="flex-grow-1">
              <?= esc($f['judul_film']) ?>
            </span>
        
            <span class="badge bg-primary rounded-pill">
              <?= $f['total'] ?>
            </span>
          </li>
        <?php endforeach ?>
      </ul>
      </div>
    </div>
  </div>

</div>

<div class="row mt-4">
  <div class="col-12">
    <div class="card dashboard-card delay-1">
      <div class="card-header">
        <h5 class="mb-0">Aktivitas Terakhir</h5>
      </div>

      <div class="card-body p-0">
        <ul class="list-group list-group-flush">
          <?php if (empty($recentActivity)): ?>
            <li class="list-group-item text-muted text-center py-4">
              Belum ada aktivitas terbaru
            </li>
          <?php else: ?>
            <?php foreach ($recentActivity as $a): ?>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                <div>
                  <strong><?= esc($a['film']) ?></strong><br>
                  <small class="text-muted">
                    <?= date('d M Y H:i', strtotime($a['waktu'])) ?>
                  </small>
                </div>
                <span class="badge bg-success">Lunas</span>
              </li>
            <?php endforeach ?>
          <?php endif ?>
        </ul>
      </div>
    </div>
  </div>
</div>

<div class="dashboard-spacer"></div>

<script>
function toggleTopFilm() {
  const body = document.getElementById('topFilmBody');
  const icon = document.getElementById('topFilmIcon');

  body.classList.toggle('collapsed');
  icon.classList.toggle('bi-chevron-down');
  icon.classList.toggle('bi-chevron-up');
}

document.addEventListener("DOMContentLoaded", function () {

  const dataPenjualan = <?= json_encode($grafikPenjualan) ?>;
  const tooltipFilm  = <?= json_encode($tooltipFilm) ?>;

  const options = {
    chart: {
      type: 'area',
      height: '100%',
      toolbar: { show: false },
      foreColor: getComputedStyle(document.body)
        .getPropertyValue('--text-muted')
    },
    theme: {
      mode: document.body.classList.contains('dark-mode')
        ? 'dark'
        : 'light'
    },
    series: [{
      name: 'Tiket Terjual',
      data: dataPenjualan
    }],
    xaxis: {
      categories: ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des']
    },
    yaxis: {
      min: 0,
      tickAmount: 5
    },
    stroke: {
      curve: 'smooth',
      width: 3
    },
    fill: {
      type: 'gradient',
      gradient: {
        opacityFrom: 0.45,
        opacityTo: 0.05
      }
    },
    tooltip: {
      custom: function({ series, dataPointIndex }) {
        const bulan = dataPointIndex + 1;
        let html = `<strong>Total: ${series[0][dataPointIndex]} Tiket</strong><br>`;

        if (tooltipFilm[bulan]) {
          tooltipFilm[bulan].forEach(f => {
            html += `• ${f.film}: ${f.total}<br>`;
          });
        }
        return `<div style="padding:8px">${html}</div>`;
      }
    }
  };

  new ApexCharts(
    document.querySelector("#grafik-penjualan"),
    options
  ).render();

  const maxValue = Math.max(...dataPenjualan);
  const maxMonthIndex = dataPenjualan.indexOf(maxValue);
  const month = maxMonthIndex + 1;

  const monthNames = [
    'Januari','Februari','Maret','April','Mei','Juni',
    'Juli','Agustus','September','Oktober','November','Desember'
  ];

  let topFilmName = '-';

  if (tooltipFilm[month]) {
    const sorted = [...tooltipFilm[month]].sort((a, b) => b.total - a.total);
    topFilmName = sorted[0].film;
  }

  const insightEl = document.getElementById('chartInsight');
  if (maxValue > 0) {
    insightEl.innerHTML = `
      📈 Puncak penjualan:
      <strong>${monthNames[maxMonthIndex]}</strong>
      (${maxValue} tiket)
      &nbsp;•&nbsp;
      🎬 Terlaris:
      <strong>${topFilmName}</strong>
    `;
  } else {
    insightEl.textContent = 'Belum ada penjualan pada periode ini';
  }

});
</script>

<?= $this->endSection() ?>
