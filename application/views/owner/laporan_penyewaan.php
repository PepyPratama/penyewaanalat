<div class="content-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <?= $this->session->flashdata('pesan'); ?>
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title"><?= $title; ?></h4>
                        <?= form_open('', ['id' => 'penyewaan_form']) ?>
                            <div style="display: flex; align-items: flex-end; gap: 8px;">
                                <div class="form-group">
                                    <label for="tanggal_awal">Tanggal Awal</label>
                                    <input type="date" class="form-control" id="tanggal_awal" name="tanggal_awal" required>
                                </div>
                                <div class="form-group">
                                    <label for="tanggal_akhir">Tanggal Akhir</label>
                                    <input type="date" class="form-control" id="tanggal_akhir" name="tanggal_akhir" required>
                                </div>
                                <div class="form-group">
                                    <label for="status_pembayaran">Jenis Pembayaran</label>
                                    <select class="form-control" id="status_pembayaran" name="status_pembayaran">
                                        <option value="">Semua</option>
                                        <option value="lunas">Lunas</option>
                                        <option value="dp">DP</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="status_penyewaan">Status Penyewaan</label>
                                    <select class="form-control" id="status_penyewaan" name="status_penyewaan">
                                        <option value="">Semua</option>
                                        <option value="pending">Pending</option>
                                        <option value="disewakan">Disewakan</option>
                                        <option value="diterima">Diterima</option>
                                        <option value="dikembalikan">Dikembalikan</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <button type="submit" formaction="<?= base_url('owner/penyewaan_excel') ?>" formtarget="_blank" class="btn btn-success text-white">Excel</button>
                                    <button type="submit" formaction="<?= base_url('owner/penyewaan_pdf') ?>" formtarget="_blank" class="btn btn-danger text-white">PDF</button>
                                </div>
                            </div>
                        <?= form_close() ?>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="table-responsive">
                                <table class="table table-striped table-responsive-sm">
                                    <thead>
                                        <tr align="center">
                                            <th width="15%">Kode Penyewaan</th>
                                            <th>Nama Lengkap</th>
                                            <th>Tanggal Sewa</th>
                                            <th>Metode Pembayaran</th>
                                            <th>Opsi Pembayaran</th>
                                            <th>Status Pembayaran</th>
                                            <th>Status Pelunasan</th>
                                            <th>Status Penyewaan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($penyewaan as $value) : ?>
                                            <tr align="center">
                                                <td><?= $value['kode_penyewaan']; ?></td>
                                                <td><?= ucwords($value['nama_lengkap']); ?></td>
                                                <td><?= tanggalIndonesia($value['tanggal_sewa']); ?></td>
                                                <td><?= ucwords($value['metode_pembayaran']); ?></td>
                                                <td><?= ucwords($value['opsi_pembayaran']); ?></td>
                                                <td>
                                                    <?php
                                                    $status_pembayaran = [
                                                        'belum dibayar' => 'badge-warning',
                                                        'diterima'      => 'badge-success',
                                                        'ditolak'       => 'badge-danger',
                                                        'dibatalkan'    => 'badge-secondary',
                                                    ];
                                                
                                                    $statusClass = isset($opsi_pembayaran[$value['opsi_pembayaran']]) ? $opsi_pembayaran[$value['opsi_pembayaran']] : '';
                                                    ?>
                                                    <span class="badge badge-pill <?= $statusClass; ?> fs-normal">
                                                        <?= ucwords($value['opsi_pembayaran']); ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <?php
                                                    $status_pelunasan = [
                                                        'belum lunas'   => 'badge-warning',
                                                        'sudah lunas'   => 'badge-success',
                                                    ];
                                                    $statusClass = isset($status_pelunasan[$value['status_pelunasan']]) ? $status_pelunasan[$value['status_pelunasan']] : '';
                                                    ?>
                                                    <span class="badge rounded-pill <?= $statusClass; ?> fw-normal">
                                                        <?= ucwords($value['status_pelunasan']); ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <?php
                                                    $status_penyewaan = [
                                                        'pending'   => 'badge-dark',
                                                        'disewakan'   => 'badge-warning',
                                                        'diterima'      => 'badge-success',
                                                        'Dikembalikan'   => 'badge-secondary',
                                                    ];                                                                   
                                                    $statusClass = isset($status_penyewaan[$value['status_penyewaan']]) ? $status_penyewaan[$value['status_penyewaan']] : '';
                                                    ?>
                                                    <span class="badge rounded-pill <?= $statusClass; ?> fw-normal">
                                                    <?= ucwords($value['status_penyewaan']); ?>
                                                    </span>
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
</div>

<!-- MODAL DETAIL -->
<?php foreach ($penyewaan as $value) : ?>
    <div class="modal fade" id="detail<?= $value['id_penyewaan']; ?>">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Penyewaan</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <?= form_open('admin/penyewaan/edit/' . $value['id_penyewaan']) ?>
                <?= form_hidden('id_penyewaan', $value['id_penyewaan']) ?>
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="nama_lengkap">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" placeholder="Masukkan nama kategori" value="<?= ucwords($value['nama_lengkap']); ?>" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="tanggal_sewa">Tanggal Sewa</label>
                            <input type="date" class="form-control" id="tanggal_sewa" name="tanggal_sewa" placeholder="Masukkan nama kategori" value="<?= ucwords($value['tanggal_sewa']); ?>" readonly>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="tanggal_kembali">Tanggal Kembali</label>
                            <input type="date" class="form-control" id="tanggal_kembali" name="tanggal_kembali" placeholder="Masukkan nama kategori" value="<?= ucwords($value['tanggal_kembali']); ?>" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="no_telp">No Telp</label>
                            <input type="tel" class="form-control" id="no_telp" name="no_telp" placeholder="Masukkan nama kategori" value="<?= ucwords($value['no_telp']); ?>" readonly>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="metode_pembayaran">Metode Pembayaran</label>
                            <input type="text" class="form-control" id="metode_pembayaran" name="metode_pembayaran" placeholder="Masukkan nama kategori" value="<?= ucwords($value['metode_pembayaran']); ?>" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="opsi_pembayaran">Opsi Pembayaran</label>
                            <input type="text" class="form-control" id="opsi_pembayaran" name="opsi_pembayaran" placeholder="Masukkan nama kategori" value="<?= ucwords($value['opsi_pembayaran']); ?>" readonly>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="status_pembayaran">Status Pembayaran</label>
                            <input type="text" class="form-control" id="status_pembayaran" name="status_pembayaran" placeholder="Masukkan nama kategori" value="<?= ucwords($value['status_pembayaran']); ?>" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="status_penyewaan">Status Penyewaan</label>
                            <input type="text" class="form-control" id="status_penyewaan" name="status_penyewaan" placeholder="Masukkan nama kategori" value="<?= ucwords($value['status_penyewaan']); ?>" readonly>
                        </div>
                    </div>
                </div>
                <?= form_close() ?>
            </div>
        </div>
    </div>
<?php endforeach; ?>