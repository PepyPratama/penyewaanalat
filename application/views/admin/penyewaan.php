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
                                        <th>Nama Lengkap</th>
                                        <th>Tanggal Sewa</th>
                                        <th>Tanggal Kembali</th>
                                        <th>Status Pembayaran</th>
                                        <th>Status Pelunasan</th>
                                        <th>Status Penyewaan</th>
                                        <th>Sub Total</th>
                                        <th width="15%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($penyewaan as $value) : ?>
                                        <tr align="center">
                                            <td><?= $value['id_penyewaan']; ?></td>
                                            <td><?= ucwords($value['nama_lengkap']); ?></td>
                                            <td><?= date('d F Y', strtotime($value['tanggal_sewa'])); ?></td>
                                            <td><?= date('d F Y', strtotime($value['tanggal_kembali'])); ?></td>
                                            <td>
                                                <?php
                                                $status_pembayaran = [
                                                    'belum dibayar' => 'badge-warning',
                                                    'diterima'      => 'badge-success',
                                                    'ditolak'       => 'badge-danger',
                                                    'dibatalkan'    => 'badge-secondary',
                                                ];

                                                $statusClass = isset($status_pembayaran[$value['status_pembayaran']]) ? $status_pembayaran[$value['status_pembayaran']] : '';
                                                ?>

                                                <span class="badge badge-pill <?= $statusClass; ?> fs-normal">
                                                    <?= ucwords($value['status_pembayaran']); ?>
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
                                                    'disewakan'     => 'badge-warning',
                                                    'dikembalikan'  => 'badge-success',
                                                ];

                                                $statusClass = isset($status_penyewaan[$value['status_penyewaan']]) ? $status_penyewaan[$value['status_penyewaan']] : '';
                                                ?>

                                                <span class="badge badge-pill <?= $statusClass; ?> fs-normal">
                                                    <?= ucwords($value['status_penyewaan']); ?>
                                                </span>
                                            </td>
                                            <td>Rp <?= number_format($value['sub_total']); ?></td>
                                            <td>
                                                <!-- KONDISI UNTUK METODE PEMBAYARAN TRANSFER -->
                                                <?php if ($value['metode_pembayaran'] == 'cash') : ?>
                                                    <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#edit<?= $value['id_penyewaan']; ?>">
                                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#detail<?= $value['id_penyewaan']; ?>">
                                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                                    </button>
                                                <?php endif; ?>

                                                <!-- KONDISI UNTUK METODE PEMBAYARAN TRANSFER -->
                                                <?php if ($value['metode_pembayaran'] == 'transfer') : ?>
                                                    <button type="button" class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#detail<?= $value['id_penyewaan']; ?>">
                                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                                    </button>
                                                <?php endif; ?>

                                                <!-- <a href="<?= base_url('admin/hapus_penyewaan/' . $value['id_penyewaan']); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data?')">
                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                </a> -->
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

<?php foreach ($penyewaan as $value) : ?>
    <!-- MODAL EDIT -->
    <div class="modal fade" id="edit<?= $value['id_penyewaan']; ?>">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <?= form_open('admin/edit_penyewaan/' . $value['id_penyewaan']) ?>
                <?= form_hidden('id_penyewaan', $value['id_penyewaan']) ?>
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="status_pembayaran">Status Pembayaran</label>
                            <select id="status_pembayaran" name="status_pembayaran" class="form-control status_pembayaran" required>
                                <option selected disabled value="">Pilih</option>
                                <option value="belum dibayar" <?= $value['status_pembayaran'] == 'belum dibayar' ? 'selected' : '' ?>>Belum Dibayar</option>
                                <option value="diterima" <?= $value['status_pembayaran'] == 'diterima' ? 'selected' : '' ?>>Diterima</option>
                                <option value="ditolak" <?= $value['status_pembayaran'] == 'ditolak' ? 'selected' : '' ?>>Ditolak</option>
                                <option value="dibatalkan" <?= $value['status_pembayaran'] == 'dibatalkan' ? 'selected' : '' ?>>Dibatalkan</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="status_pelunasan">Status Pelunasan</label>
                            <select id="status_pelunasan" name="status_pelunasan" class="form-control" required>
                                <option selected disabled value="">Pilih</option>
                                <option value="belum lunas" <?= $value['status_pelunasan'] == 'belum lunas' ? 'selected' : '' ?>>Belum Lunas</option>
                                <option value="sudah lunas" <?= $value['status_pelunasan'] == 'sudah lunas' ? 'selected' : '' ?>>Sudah Lunas</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6 keteranganDitolak" style="display: none;">
                            <label for="keterangan_ditolak">Keterangan Ditolak</label>
                            <select name="keterangan_ditolak" class="form-control keterangan_ditolak">
                                <option selected disabled value="">Pilih</option>
                                <option value="Nominal pembayaran tidak sesuai">Nominal pembayaran tidak sesuai</option>
                                <option value="Rekening yang Dituju salah">Rekening yang Dituju salah</option>
                                <option value="Bukti Pembayaran Tidak Jelas">Bukti Pembayaran Tidak Jelas</option>
                                <option value="Uang tidak masuk ke Rekening PT. Mezzo Kreasi Utama">Uang tidak masuk ke Rekening PT. Mezzo Kreasi Utama</option>
                                <option value="DLL">DLL</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="status_penyewaan">Status Penyewaan</label>
                            <select id="status_penyewaan" name="status_penyewaan" class="form-control status_penyewaan" required>
                                <option selected disabled value="">Pilih</option>
                                <option value="disewakan" <?= $value['status_penyewaan'] == 'disewakan' ? 'selected' : '' ?>>Disewakan</option>
                                <option value="dikembalikan" <?= $value['status_penyewaan'] == 'dikembalikan' ? 'selected' : '' ?>>Dikembalikan</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6 keteranganDikembalikan" style="display: none;">
                            <label for="keterangan_pengembalian">Keterangan Pengembalian</label>
                            <select name="keterangan_pengembalian" class="form-control keterangan_pengembalian">
                                <option selected disabled value="">Pilih</option>
                                <option value="baik">Baik</option>
                                <option value="kurang baik">Kurang Baik</option>
                                <option value="tidak baik">Tidak Baik</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6 detailPengembalian" style="display: none;">
                            <label for="detail_pengembalian">Detail Pengembalian</label>
                            <textarea id="detail_pengembalian" name="detail_pengembalian" class="form-control" row="5" placeholder="Masukkan detail pengembalian"></textarea>
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

    <!-- MODAL DETAIL -->
    <div class="modal fade" id="detail<?= $value['id_penyewaan']; ?>">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Data</h5>
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var statusPembayaran = document.querySelectorAll('.status_pembayaran');
        var keteranganDitolak = document.querySelectorAll('.keteranganDitolak');
        var keterangan = document.querySelectorAll('.keterangan_ditolak');

        statusPembayaran.forEach(function(statusPembayaran, index) {
            statusPembayaran.addEventListener('change', function() {
                if (this.value === 'ditolak') {
                    keteranganDitolak[index].style.display = 'block';
                    keterangan[index].setAttribute('required', 'required');
                } else {
                    keteranganDitolak[index].style.display = 'none';
                    keterangan[index].removeAttribute('required');
                    keterangan[index].value = '';
                }
            });
        });

        var statusPenyewaan = document.querySelectorAll('.status_penyewaan');
        var keteranganDikembalikan = document.querySelectorAll('.keteranganDikembalikan');
        var keterangan_pengembalian = document.querySelectorAll('.keterangan_pengembalian');
        var detailPengembalian = document.querySelectorAll('.detailPengembalian');
        var detail_pengembalian = document.querySelectorAll('#detail_pengembalian');

        statusPenyewaan.forEach(function(statusPenyewaan, index) {
            statusPenyewaan.addEventListener('change', function() {
                if (this.value === 'dikembalikan') {
                    keteranganDikembalikan[index].style.display = 'block';
                    keterangan_pengembalian[index].setAttribute('required', 'required');
                } else {
                    keteranganDikembalikan[index].style.display = 'none';
                    keterangan_pengembalian[index].removeAttribute('required');
                    keterangan_pengembalian[index].value = '';
                    detailPengembalian[index].style.display = 'none';
                    detail_pengembalian[index].value = '';
                }
            });
        });

        keterangan_pengembalian.forEach(function(keterangan_pengembalian, index) {
            keterangan_pengembalian.addEventListener('change', function() {
                if (this.value === 'kurang baik' || this.value === 'tidak baik') {
                    detailPengembalian[index].style.display = 'block';
                    detail_pengembalian[index].setAttribute('required', 'required');
                } else {
                    detailPengembalian[index].style.display = 'none';
                    detail_pengembalian[index].removeAttribute('required');
                    detail_pengembalian[index].value = '';
                }
            });
        });
    });
</script>