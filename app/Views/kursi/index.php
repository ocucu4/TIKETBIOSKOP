<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<style>
.seat-btn {
    width: 44px;
    height: 36px;
    padding: 0;
    font-size: 13px;
    font-weight: 600;
    border-radius: 8px;
    white-space: nowrap;
    line-height: 1;
    pointer-events: none; /* READ ONLY */
    
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

.seat-empty {
    background: #dc3545; /* MERAH = Kosong */
    color: white;
}

.seat-filled {
    background: #28a745; /* HIJAU = Terisi */
    color: white;
}

.row-label {
    font-size: 15px;
    color: #6c757d;
    font-weight: 600;
}

.room-title {
    background: #f8f9fa;
    padding: 8px 12px;
    border-radius: 6px;
}
</style>

<div class="card shadow-sm p-4">
    <h4 class="fw-semibold mb-4">Layout Kursi (Read Only)</h4>

    <div class="mb-3">
        <span class="badge bg-danger px-3">Kosong</span>
        <span class="badge bg-success px-3 ms-2">Terisi</span>
    </div>

    <?php if (empty($data)): ?>
        <p class="text-muted">Data kursi belum tersedia.</p>
    <?php else: ?>

        <?php
        $currentRoom = null;
        $seatIndex   = 0;
        $rowIndex    = 0;
        $PER_ROW     = 10;
        ?>

        <?php foreach ($data as $k): ?>

            <?php
            if ($currentRoom !== $k->nama_room):
                if ($currentRoom !== null): ?>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <?php endif;

                $currentRoom = $k->nama_room;
                $seatIndex   = 0;
                $rowIndex    = 0;
            ?>
                <div class="mb-4">
                    <div class="room-title mb-2 fw-semibold">
                        <?= esc($currentRoom) ?>
                    </div>

                    <table class="table table-borderless text-center align-middle mb-0">
                        <tbody>
            <?php endif; ?>

            <?php
            if ($seatIndex % $PER_ROW === 0):
                if ($seatIndex !== 0): ?>
                        </tr>
                <?php endif; ?>
                <tr>
                    <th class="row-label"><?= chr(65 + $rowIndex) ?></th>
                <?php $rowIndex++; ?>
            <?php endif; ?>

            <?php
            $label = chr(65 + $rowIndex - 1) . (($seatIndex % $PER_ROW) + 1);
            ?>

            <td>
                <span class="btn seat-btn <?= $k->status == 1 ? 'seat-filled' : 'seat-empty' ?>">
                    <?= $label ?>
                </span>
            </td>

            <?php $seatIndex++; ?>

        <?php endforeach; ?>

                        </tr>
                    </tbody>
                </table>
            </div>

    <?php endif; ?>
</div>

<?= $this->endSection() ?>
