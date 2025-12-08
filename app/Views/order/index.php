<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="card p-4 shadow-sm">

  <!-- HEADER -->
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="fw-semibold">Order</h4>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAdd">
      Tambah Order
    </button>
  </div>

  <!-- TABLE -->
  <div class="table-responsive">
    <table class="table table-hover align-middle">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama Pemesan</th>
          <th>Film</th>
          <th>Room</th>
          <th>Jadwal</th>
          <th>Tanggal Order</th>
          <th>Status</th>
          <th>Total</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($data as $i => $o): ?>
        <tr>
          <td><?= $i + 1 ?></td>
          <td><?= esc($o->nama_pemesan) ?></td>
          <td><?= esc($o->judul_film) ?></td>
          <td><?= esc($o->nama_room) ?></td>
          <td>
            <?= $o->tanggal ?><br>
            <small><?= $o->jam_mulai ?> - <?= $o->jam_selesai ?></small>
          </td>
          <td><?= $o->tanggal_order ?></td>
          <td>
  <?php if ($o->status_order === 'lunas'): ?>
    <span class="badge bg-success px-3 py-2 fw-semibold text-white">
      LUNAS
    </span>
  <?php else: ?>
    <span class="badge bg-warning px-3 py-2 fw-semibold text-dark">
      PENDING
    </span>
  <?php endif; ?>
</td>

          <td>Rp <?= number_format($o->total_bayar,0,',','.') ?></td>
          <td>
            <a href="<?= base_url('detailorder/order/'.$o->id_order) ?>"
               class="btn btn-sm btn-outline-secondary action-btn">
              <title="Detail Order"></title>
              <i data-feather="list"></i>
            </a>

            <a href="<?= base_url('kursijadwalstatus/index/'.$o->id_tayang) ?>"
                  class="btn btn-sm btn-outline-info action-btn"
                  title="Status Kursi">
              <i data-feather="grid"></i>
            </a>
            
            <button class="btn btn-sm btn-outline-primary"
              onclick='editOrder(<?= json_encode($o) ?>)'>
              Edit
            </button>
            
            <button class="btn btn-sm btn-outline-danger"
              onclick="hapusOrder(<?= $o->id_order ?>)">
              Hapus
            </button>
          </td>
        </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  </div>
</div>

<!-- ======================= -->
<!-- MODAL ADD -->
<!-- ======================= -->
<div class="modal fade" id="modalAdd" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <form method="post" action="<?= base_url('order/add') ?>" class="modal-content"> <?=  csrf_field() ?>
      <div class="modal-header">
        <h5 class="modal-title">Tambah Order</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">

        <input class="form-control mb-2" name="nama_pemesan" placeholder="Nama Pemesan" required>

        <select name="id_tayang" class="form-select mb-2" required>
          <option value="">-- Pilih Jadwal --</option>
          <?php foreach ($jadwal as $j): ?>
            <option value="<?= $j->id_tayang ?>">
              <?= $j->judul_film ?> | <?= $j->nama_room ?> |
              <?= $j->tanggal ?> (<?= $j->jam_mulai ?>–<?= $j->jam_selesai ?>)
            </option>
          <?php endforeach ?>
        </select>

        <input type="datetime-local" name="tanggal_order" class="form-control mb-2" required>
        <input type="number" name="total_bayar" class="form-control mb-2" placeholder="Total Bayar" required>

        <select name="status_order" class="form-select">
          <option value="pending">Pending</option>
          <option value="lunas">Lunas</option>
        </select>

      </div>
      <div class="modal-footer">
        <button class="btn btn-primary">Simpan</button>
      </div>
    </form>
  </div>
</div>

<!-- ======================= -->
<!-- MODAL EDIT -->
<!-- ======================= -->
<div class="modal fade" id="modalEdit" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <form method="post" id="formEdit" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Ubah Order</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">

        <input type="text" id="e-nama" name="nama_pemesan" class="form-control mb-2" required>

        <select id="e-tayang" name="id_tayang" class="form-select mb-2" required>
          <?php foreach ($jadwal as $j): ?>
          <option value="<?= $j->id_tayang ?>">
            <?= $j->judul_film ?> | <?= $j->nama_room ?> |
            <?= $j->tanggal ?> (<?= $j->jam_mulai ?>–<?= $j->jam_selesai ?>)
          </option>
          <?php endforeach ?>
        </select>

        <input type="datetime-local" id="e-tanggal" name="tanggal_order" class="form-control mb-2" required>
        <input type="number" id="e-total" name="total_bayar" class="form-control mb-2" required>

        <select id="e-status" name="status_order" class="form-select">
          <option value="pending">Pending</option>
          <option value="lunas">Lunas</option>
        </select>

      </div>
      <div class="modal-footer">
        <button class="btn btn-primary">Update</button>
      </div>
    </form>
  </div>
</div>

<!-- ======================= -->
<!-- SCRIPT -->
<!-- ======================= -->
<script>
function editOrder(o) {
  document.getElementById('formEdit').action = "<?= base_url('order/update') ?>/" + o.id_order;

  document.getElementById('e-nama').value = o.nama_pemesan;
  document.getElementById('e-total').value = o.total_bayar;
  document.getElementById('e-status').value = o.status_order;
  document.getElementById('e-tayang').value = o.id_tayang;
  const dt = new Date(o.tanggal_order.replace(' ', 'T'));

  const yyyy = dt.getFullYear();
  const mm = String(dt.getMonth()+1).padStart(2,'0');
  const dd = String(dt.getDate()).padStart(2,'0');
  const hh = String(dt.getHours()).padStart(2,'0');
  const mi = String(dt.getMinutes()).padStart(2,'0');

  document.getElementById('e-tanggal').value =
    `${yyyy}-${mm}-${dd}T${hh}:${mi}`;

  new bootstrap.Modal(document.getElementById('modalEdit')).show();
}

function hapusOrder(id) {
  Swal.fire({
    title: 'Hapus Order?',
    text: 'Data akan dihapus permanen',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Hapus'
  }).then((r)=>{
    if (r.isConfirmed) {
      window.location.href = "<?= base_url('order/delete') ?>/" + id;
    }
  });
}

feather.replace();
</script>

<?= $this->endSection() ?>
