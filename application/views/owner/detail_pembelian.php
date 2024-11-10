<div class="content-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
            <?= $this->session->flashdata('pesan'); ?>

                <div class="card">
                    <div class="card-header">
                        <h5 class="fw-semibold">Rincian Pembelian</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3 text-capitalize">
                                <p>kode pembelian</p>
                                <p>tanggal pembelian</p>
                            </div>
                            <div class="col-9">
                                <?php
                                $status_pembelian = [
                                    'pending'   => 'badge-secondary',
                                    'diterima'  => 'badge-success',
                                    'ditolak'   => 'badge-danger',
                                ];

                                $statusClass = isset($status_pembelian[$pembelian['status']]) ? $status_pembelian[$pembelian['status']] : '';
                                ?>
                                <p>: <?= strtoupper($pembelian['kode_pembelian']); ?></p>
                                <p>: <?= tanggalIndonesia($pembelian['tanggal_pembelian']); ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-responsive-sm">
                                <thead>
                                    <tr align="center">
                                        <th>Nama Alat</th>
                                        <th>Jenis Pembelian</th>
                                        <th>Harga Beli</th>
                                        <th>Jumlah Pengajuan</th>
                                        <th>Status</th>
                                        <th width="15%">Jumlah Pembelian</th>
                                        <th>Ubah Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        <tr align="center">
                                            <td><?= ucwords($pembelian['nama_alat']); ?></td>
                                            <td><?= ucwords($pembelian['jenis_pembelian']); ?></td>
                                            <td><?= number_format($pembelian['harga_beli']); ?></td>
                                            <td><?= number_format($pembelian['jumlah_pembelian']); ?></td>
                                            <td>
                                                <?php
                                                $status = [
                                                    'pending'          => 'badge-warning',
                                                    'tidak disetujui'  => 'badge-danger',
                                                    'disetujui'        => 'badge-success',
                                                ];

                                                $statusClass = isset($status[$pembelian['status']]) ? $status[$pembelian['status']] : '';
                                                ?>

                                                <span class="badge rounded-pill <?= $statusClass; ?> fw-normal">
                                                    <?= ucwords($pembelian['status']); ?>
                                                </span>
                                            </td>
                                            <td>
                                                <?= form_open('owner/edit_jumlah_acc/' . $pembelian['id_pembelian']); ?>
                                                <?= form_hidden('id_pembelian', $pembelian['id_pembelian']); ?>
                                                <div class="input-group">
                                                    <input type="number" min="1" id="jumlah_acc" name="jumlah_acc" class="form-control" value="<?= $pembelian['jumlah_acc'] ?>" required>
                                                    <button type="submit" class="btn btn-warning" title="Edit">
                                                        <i class="fa fa-refresh" aria-hidden="true"></i>
                                                    </button>
                                                </div>
                                                <?= form_close() ?>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#edit<?= $pembelian['id_pembelian']; ?>">
                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                </button>
                                            </td>
                                        </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <a href="<?= base_url('owner/detail_pembelian'); ?>" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
</div>

<!-- MODAL EDIT -->
    <div class="modal fade" id="edit<?= $pembelian['id_pembelian']; ?>">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <?= form_open('owner/edit_status_pembelian/' . $pembelian['id_pembelian']) ?>
                <?= form_hidden('id_pembelian', $pembelian['id_pembelian']) ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select id="status" name="status" class="form-control" required>
                            <option selected disabled value="">Pilih</option>
                            <option value="disetujui" <?= $pembelian['status'] == 'disetujui' ? 'selected' : '' ?>>Disetujui</option>
                            <option value="tidak disetujui" <?= $pembelian['status'] == 'tidak disetujui' ? 'selected' : '' ?>>Tidak Disetujui</option>
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