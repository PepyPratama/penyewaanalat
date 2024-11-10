<div class="content-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <?= $this->session->flashdata('pesan'); ?>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"><?= $title; ?></h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-responsive-sm">
                                <thead>
                                    <tr align="center">
                                        <th>Kode Pembelian</th>
                                        <th>Nama Alat</th>
                                        <th>Jumlah Pembelian</th>
                                        <th>Jenis Pembelian</th>
                                        <th>Status</th>
                                        <th width="15%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($pembelian as $key => $value) : ?>
                                        <tr align="center">
                                            <td><?= ucwords($value['kode_pembelian']); ?></td>
                                            <td><?= ucwords($value['nama_alat']); ?></td>
                                            <td><?= number_format($value['jumlah_pembelian']); ?></td>
                                            <td><?= ucwords($value['jenis_pembelian']); ?></td>
                                            <td>
                                                <?php
                                                $status = [
                                                    'pending'           => 'badge-warning',
                                                    'tidak disetujui'   => 'badge-danger',
                                                    'disetujui'         => 'badge-success',
                                                ];

                                                $statusClass = isset($status[$value['status']]) ? $status[$value['status']] : '';
                                                ?>

                                                <span class="badge rounded-pill <?= $statusClass; ?> fw-normal">
                                                    <?= ucwords($value['status']); ?>
                                                </span>
                                            </td>
                                            <td>
                                                <a href="<?= base_url('owner/detail_pembelian/' . $value['id_pembelian']); ?>" class="btn btn-sm btn-warning">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL EDIT -->
<?php foreach ($pembelian as $value) : ?>
    <div class="modal fade" id="edit<?= $value['id_pembelian']; ?>">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <?= form_open('owner/edit_pembelian/' . $value['id_pembelian']) ?>
                <?= form_hidden('id_pembelian', $value['id_pembelian']) ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="jumlah_pembelian">Jumlah Pembelian</label>
                        <input type="number" class="form-control" id="jumlah_pembelian" name="jumlah_pembelian" placeholder="Masukkan jumlah" value="<?= $value['jumlah_pembelian']; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select id="status" name="status" class="form-control" required>
                            <option selected disabled value="">Pilih</option>
                            <option value="disetujui" <?= $value['status'] == 'disetujui' ? 'selected' : '' ?>>Disetujui</option>
                            <option value="tidak disetujui" <?= $value['status'] == 'tidak disetujui' ? 'selected' : '' ?>>Tidak Disetujui</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
                <?= form_close() ?>
            </div>
        </div>
    </div>

    <!-- MODAL FOTO -->
    <div class="modal fade" id="foto<?= $value['id_pembelian']; ?>">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?= ucwords($value['nama_alat']); ?></h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img src="<?= base_url('assets/images/upload_pembelian/' . $value['foto']); ?>" style=" width: 100%; height: 450px; object-fit: contain;">
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL SPESIFIKASI -->
    <div class="modal fade" id="spesifikasi<?= $value['id_pembelian']; ?>">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?= ucwords($value['nama_alat']); ?></h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php
                    $spesifikasi = ucwords($value['spesifikasi']);
                    $spesifikasi_dengan_br = nl2br($spesifikasi);
                    $counter = 0;
                    $spesifikasi_bernomor = preg_replace_callback(
                        '/(.+?)(<br\s*\/?>\s*|$)/i',
                        function ($matches) use (&$counter) {
                            $counter++;
                            return $counter . '. ' . $matches[1] . $matches[2];
                        },
                        $spesifikasi_dengan_br
                    );
                    echo $spesifikasi_bernomor;
                    ?>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>