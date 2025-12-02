<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="card shadow-sm p-4">
    <h5 class="fw-semibold mb-3">Daftar Kursi per Room</h5>

    <?php if (empty($data)): ?>
        <p class="text-muted">Data kursi belum tersedia.</p>
    <?php else: ?>

        <?php
        // DATA SUDAH DI-ORDER BY nama_room, kode_kursi DI CONTROLLER
        $currentRoom = null;
        ?>

        <?php foreach ($data as $k): ?>
            <?php
            // Deteksi pergantian room
            if ($currentRoom !== $k->nama_room):
                // Tutup grid room sebelumnya (kalau ada)
                if ($currentRoom !== null): ?>
                        </tbody>
                    </table>
                </div>
                <?php endif; ?>

                <!-- HEADER ROOM BARU -->
                <div class="mb-4">
                    <h6 class="fw-bold mb-2">
                        Room: <?= esc($k->nama_room) ?>
                    </h6>
                    <table class="table table-bordered align-middle text-center mb-0">
                        <tbody>
                <?php
                $currentRoom = $k->nama_room;
                $currentRowLetter = null;
            endif;

            // Dapatkan huruf baris (A, B, C) dan nomor kursi
            $rowLetter = substr($k->kode_kursi, 0, 1);
            $nomorKursi = substr($k->kode_kursi, 1);

            // Kalau huruf baris ganti, mulai baris <tr> baru
            if (!isset($currentRowLetter) || $currentRowLetter !== $rowLetter):
                // Kalau bukan baris pertama di room ini, tutup baris lama
                if (isset($currentRowLetter)): ?>
                            </tr>
                        <?php endif; ?>

                        <tr>
                            <th class="text-nowrap"><?= $rowLetter ?></th>
                <?php
                $currentRowLetter = $rowLetter;
            endif;
            ?>

            <!-- CELL KURSI -->
            <td class="text-nowrap">
                <button class="btn btn-sm <?= $k->status == 0 ? 'btn-success' : 'btn-danger' ?>"
                        data-bs-toggle="modal"
                        data-bs-target="#modal<?= $k->id_kursi ?>">
                    <?= esc($k->kode_kursi) ?>
                </button>
            </td>

            <!-- MODAL UPDATE STATUS -->
            <div class="modal fade" id="modal<?= $k->id_kursi ?>" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <form action="<?= site_url('kursi/update/'.$k->id_kursi) ?>" method="post">
                            <?= csrf_field() ?>

                            <div class="modal-header">
                                <h6 class="modal-title">
                                    Update Status Kursi <?= esc($k->kode_kursi) ?> (Room <?= esc($k->nama_room) ?>)
                                </h6>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <div class="modal-body">
                                <select name="status" class="form-select" required>
                                    <option value="0" <?= $k->status==0?'selected':'' ?>>Tersedia</option>
                                    <option value="1" <?= $k->status==1?'selected':'' ?>>Terisi</option>
                                </select>
                            </div>

                            <div class="modal-footer">
                                <button class="btn btn-primary w-100">
                                    Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        <?php endforeach; ?>

        <!-- TUTUP TR & TABLE ROOM TERAKHIR -->
                        </tr>
                    </tbody>
                </table>
            </div>

    <?php endif; ?>

</div>

<?= $this->endSection() ?>
