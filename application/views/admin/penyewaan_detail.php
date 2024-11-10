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
                            <table id="example2" class="display" style="width:100%">
                                <thead>
                                    <tr align="center">
                                        <th>Kode Penyewaan</th>
                                        <th>No Seri</th>
                                        <th>Nama Alat</th>
                                        <th>Jumlah</th>
                                        <th>Harga</th>
                                        <!-- <th>Aksi</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($penyewaan as $key => $value) : ?>
                                        <tr align="center">
                                            <td><?= $value['id_penyewaan']; ?></td>
                                            <td><?= number_format($value['no_seri']); ?></td>
                                            <td><?= ucwords($value['nama_alat']); ?></td>
                                            <td><?= number_format($value['jumlah']); ?></td>
                                            <td>Rp <?= number_format($value['harga_sewa']); ?></td>
                                            <!-- <td>
                                                <button type="button" class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#detail<?= $value['id_penyewaan']; ?>">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </button>
                                            </td> -->
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
<?php foreach ($penyewaan as $value) : ?>
    <div class="modal fade" id="edit<?= $value['id_penyewaan']; ?>">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data</h5>
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
                            <select id="status_pembayaran" name="status_pembayaran" class="form-control" required>
                                <option selected disabled value="">Pilih</option>
                                <option value="belum dibayar" <?= $value['status_pembayaran'] == 'belum dibayar' ? 'selected' : '' ?>>Belum Dibayar</option>
                                <option value="diterima" <?= $value['status_pembayaran'] == 'diterima' ? 'selected' : '' ?>>Diterima</option>
                                <option value="dibatalkan" <?= $value['status_pembayaran'] == 'dibatalkan' ? 'selected' : '' ?>>Dibatalkan</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="status_penyewaan">Status Penyewaan</label>
                            <select id="status_penyewaan" name="status_penyewaan" class="form-control" required>
                                <option selected disabled value="">Pilih</option>
                                <option value="disewakan" <?= $value['status_penyewaan'] == 'disewakan' ? 'selected' : '' ?>>Disewakan</option>
                                <option value="dikembalikan" <?= $value['status_penyewaan'] == 'dikembalikan' ? 'selected' : '' ?>>Dikembalikan</option>
                            </select>
                        </div>
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
<?php endforeach; ?>

<!-- MODAL DETAIL -->
<?php foreach ($penyewaan as $value) : ?>
    <div class="modal fade" id="detail<?= $value['id_penyewaan']; ?>">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data</h5>
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
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
                <?= form_close() ?>
            </div>
        </div>
    </div>
<?php endforeach; ?>