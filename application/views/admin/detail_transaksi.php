<div class="content-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <?= $this->session->flashdata('pesan'); ?>

                <!-- RINCIAN PENYEWAAN -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="fw-semibold">Rincian Penyewaan</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3 text-capitalize">
                                <p>nama lengkap</p>
                                <p>tanggal sewa</p>
                                <p>tanggal kembali</p>
                                <p>no telp</p>
                                <p>metode pembayaran</p>
                                <p>opsi pembayaran</p>
                                <p>status pembayaran</p>
                                <p>status pelunasan</p>
                                <p>status penyewaan</p>
                                <p>Penerima Alat</p>
                                <p>Tanggal Alat Diterima</p>
                                <p>keterangan ditolak</p>
                                <p>keterangan pengembalian</p>
                                <p>detail pengembalian</p>
                                <p>total</p>
                            </div>
                            <div class="col-9">
                            <?php
                                $status_pembayaran = [
                                    'belum dibayar' => 'badge-dark',
                                    'diterima'      => 'badge-success',
                                    'ditolak'       => 'badge-danger',
                                    'dibatalkan'    => 'badge-secondary',
                                ];
                                $statusClass = isset($status_pembayaran[$penyewaan['status_pembayaran']]) ? $status_pembayaran[$penyewaan['status_pembayaran']] : '';
                                ?>
                                               
                                <p>: <?= ucwords($penyewaan['nama_lengkap']); ?></p>
                                <p>: <?= tanggalIndonesia($penyewaan['tanggal_sewa']); ?></p>
                                <p>: <?= tanggalIndonesia($penyewaan['tanggal_kembali']); ?></p>
                                <p>: <?= $penyewaan['no_telp']; ?></p>
                                <p>: <?= strtoupper($penyewaan['metode_pembayaran']); ?></p>
                                <p>: <?= strtoupper($penyewaan['opsi_pembayaran']); ?></p>
                                <p>: 
                                    <span class="badge badge-pill <?= $statusClass; ?> fs-normal">
                                        <?= ucwords($penyewaan['status_pembayaran']); ?>
                                    </span>
                                </p>
                                <p>: 
                                    <span class="badge badge-pill <?= $statusClass; ?> fs-normal">
                                        <?= ucwords($penyewaan['status_pelunasan']); ?>
                                    </span>
                                </p>
                                <p>: 
                                    <span class="badge badge-pill <?= $statusClass; ?> fs-normal">
                                        <?= ucwords($penyewaan['status_penyewaan']); ?>
                                    </span>
                                </p>
                                <p>: <?= ucwords($penyewaan['nama_penerima']); ?></p>
                                <p>: <?= tanggalIndonesia($penyewaan['tanggal_diterima']); ?> <?= date('H:i:s', strtotime($penyewaan['tanggal_diterima'])); ?></p>
                                <p>: <?= $penyewaan['keterangan_ditolak'] ? ucwords($penyewaan['keterangan_ditolak']) : '-'; ?></p>
                                <p>: <?= $penyewaan['keterangan_pengembalian'] ? ucwords($penyewaan['keterangan_pengembalian']) : '-'; ?></p>
                                <p>: <?= $penyewaan['detail_pengembalian'] ? ucwords($penyewaan['detail_pengembalian']) : '-'; ?></p>
                                <p>: Rp <?= number_format($penyewaan['sub_total']); ?>,-</p>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
                $dataTersedia = !empty($penyewaan['tgl_transfer_lunas']) || !empty($penyewaan['bukti_transfer_lunas']) || !empty($penyewaan['tgl_transfer_dp_awal']) || !empty($penyewaan['bukti_transfer_dp_awal']) || !empty($penyewaan['tgl_transfer_dp_akhir']) || !empty($penyewaan['bukti_transfer_dp_akhir']);
                ?>

                <!-- RINCIAN TRANSAKSI -->
                <?php if ($dataTersedia) : ?>
                    <div class="card">
                        <div class="card-header">
                            <h5 class="fw-semibold">Rincian Transaksi</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-2 text-capitalize">
                                    <p>Tanggal Transfer Lunas</p>
                                    <p>Bukti Transfer Lunas</p>
                                    <p>Tanggal Transfer DP Awal</p>
                                    <p>Bukti Transfer DP Awal</p>
                                    <p>Tanggal Transfer DP Akhir</p>
                                    <p>Bukti Transfer DP Akhir</p>
                                </div>
                                <div class="col-10">
                                    <p>: <?= $penyewaan['tgl_transfer_lunas'] ? tanggalIndonesia($penyewaan['tgl_transfer_lunas']) : '-'; ?></p>
                                    <p>:
                                        <?php if (!empty($penyewaan['bukti_transfer_lunas'])) : ?>
                                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#bukti_transfer_lunas<?= $penyewaan['id_penyewaan']; ?>" title="Lihat">
                                                Lihat
                                            </button>
                                            <a href="<?= base_url('assets/images/bukti_transfer/lunas/' . $penyewaan['bukti_transfer_lunas']); ?>" class="btn btn-sm btn-success" download="Bukti Transfer Lunas.jpg" title="Download">
                                                Download
                                            </a>
                                        <?php else : ?>
                                            -
                                        <?php endif; ?>
                                    </p>
                                    <p>: <?= $penyewaan['tgl_transfer_dp_awal'] ? tanggalIndonesia($penyewaan['tgl_transfer_dp_awal']) : '-'; ?></p>
                                    <p>:
                                        <?php if (!empty($penyewaan['bukti_transfer_dp_awal'])) : ?>
                                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#bukti_transfer_dp_awal<?= $penyewaan['id_penyewaan']; ?>" title="Lihat">
                                                Lihat
                                            </button>
                                            <a href="<?= base_url('assets/images/bukti_transfer/dp_awal/' . $penyewaan['bukti_transfer_dp_awal']); ?>" class="btn btn-sm btn-success" download="Bukti Transfer Lunas.jpg" title="Download">
                                                Download
                                            </a>
                                        <?php else : ?>
                                            -
                                        <?php endif; ?>
                                    </p>
                                    <p>: <?= $penyewaan['tgl_transfer_dp_akhir'] ? tanggalIndonesia($penyewaan['tgl_transfer_dp_akhir']) : '-'; ?></p>
                                    <p>:
                                        <?php if (!empty($penyewaan['bukti_transfer_dp_akhir'])) : ?>
                                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#bukti_transfer_dp_akhir<?= $penyewaan['id_penyewaan']; ?>" title="Lihat">
                                                Lihat
                                            </button>
                                            <a href="<?= base_url('assets/images/bukti_transfer/dp_akhir/' . $penyewaan['bukti_transfer_dp_akhir']); ?>" class="btn btn-sm btn-success" download="Bukti Transfer Lunas.jpg" title="Download">
                                                Download
                                            </a>
                                        <?php else : ?>
                                            -
                                        <?php endif; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- DETAIL PENYEWAAN -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="fw-semibold">Detail Penyewaan</h5>
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
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($penyewaan_detail as $key => $value) : ?>
                                        <tr align="center">
                                            <td><?= $value['id_penyewaan']; ?></td>
                                            <td><?= $value['no_seri']; ?></td>
                                            <td><?= ucwords($value['nama_alat']); ?></td>
                                            <td><?= number_format($value['jumlah']); ?></td>
                                            <td>Rp <?= number_format($value['harga_sewa']); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <?php if ($value['status_pembayaran'] !== 'diterima' || $value['status_pelunasan'] !== 'sudah lunas'): ?>
                    <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#edit<?= $value['id_penyewaan']; ?>" title="Edit Status">
                        Edit Status Pembayaran
                    </button>
                <?php endif; ?>
                <?php if ($value['status_penyewaan'] !== 'Dikembalikan'): ?>
                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#pengembalian<?= $value['id_penyewaan']; ?>" title="Pengembalian">
                        Edit Status Penyewaan
                    </button>
                <?php endif; ?>
                <a href="<?= base_url('admin/transaksi'); ?>" class="btn btn-sm btn-dark">Kembali</a>
            </div>
        </div>
    </div>
</div>

<!-- MODAL EDIT PENGEMBALIAN -->
<div class="modal fade" id="pengembalian<?= $value['id_penyewaan']; ?>">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Status Penyewaan</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <?= form_open('admin/edit_pengembalian/' . $value['id_penyewaan']) ?>
                <?= form_hidden('id_penyewaan', $value['id_penyewaan']) ?>
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="status_penyewaan">Status Penyewaan</label>
                            <select id="status_penyewaan" name="status_penyewaan" class="form-control status_penyewaan">
                                <option selected disabled value="">Pilih</option>
                                <option value="disewakan" <?= $value['status_penyewaan'] == 'disewakan' ? 'selected' : '' ?>>Disewakan</option>
                                <option value="diterima" <?= $value['status_penyewaan'] == 'diterima' ? 'selected' : '' ?>>Diterima</option>
                                <option value="dikembalikan" <?= $value['status_penyewaan'] == 'dikembalikan' ? 'selected' : '' ?>>Dikembalikan</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6 waktuPengembalian" style="display: none;">
                            <label for="waktu_pengembalian">Waktu Pengembalian</label>
                            <select id="waktu_pengembalian" name="waktu_pengembalian" class="form-control waktu_pengembalian">
                                <option selected disabled value="">Pilih</option>
                                <option value="Tepat Waktu">Tepat Waktu</option>
                                <option value="Tidak Tepat Waktu">Tidak Tepat Waktu</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6 keteranganPengembalian" style="display: none;">
                            <label for="keterangan_pengembalian">Keterangan Pengembalian</label>
                            <select id="keterangan_pengembalian" name="keterangan_pengembalian" class="form-control keterangan_pengembalian">
                                <option selected disabled value="">Pilih</option>
                                <option value="Tidak Ada Kerusakan">Tidak Ada Kerusakan</option>
                                <option value="Kerusakan Ringan">Kerusakan Ringan</option>
                                <option value="Kerusakan Berat">Kerusakan Berat</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6 dendaKeterlambatan" style="display: none;">
                            <label for="denda_keterlambatan">Denda Keterlambatan</label>
                            <textarea id="denda_keterlambatan" name="denda_keterlambatan" class="form-control" rows="5" placeholder="Masukkan detail pengembalian"></textarea>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6 detailPengembalian" style="display: none;">
                            <label for="detail_pengembalian">Detail Pengembalian</label>
                            <textarea id="detail_pengembalian" name="detail_pengembalian" class="form-control" rows="5" placeholder="Masukkan detail pengembalian"></textarea>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6 namaPenerima" style="display: none;">
                            <label for="nama_penerima">Diterima Oleh</label>
                            <input type="text" class="form-control" id="nama_penerima" name="nama_penerima" placeholder="Masukkan nama penerima">
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

    <!-- MODAL EDIT STATUS -->
    <div class="modal fade" id="edit<?= $value['id_penyewaan']; ?>">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <?= form_open('admin/edit_status/' . $value['id_penyewaan']) ?>
                <?= form_hidden('id_penyewaan', $value['id_penyewaan']) ?>
                <div class="modal-body">
                    <div class="form-group col-md-12">
                        <label for="status_pelunasan">Status Pelunasan</label>
                        <select id="status_pelunasan" name="status_pelunasan" class="form-control" required>
                            <option selected disabled value="">Pilih</option>
                            <option value="belum lunas" <?= $value['status_pelunasan'] == 'belum lunas' ? 'selected' : '' ?>>Belum Lunas</option>
                            <option value="sudah lunas" <?= $value['status_pelunasan'] == 'sudah lunas' ? 'selected' : '' ?>>Sudah Lunas</option>
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="status_pembayaran">Status Pembayaran</label>
                        <select id="status_pembayaran" name="status_pembayaran" class="form-control status_pembayaran" required>
                            <option selected disabled value="">Pilih</option>
                            <option value="belum dibayar" <?= $value['status_pembayaran'] == 'belum dibayar' ? 'selected' : '' ?>>Belum Dibayar</option>
                            <option value="diterima" <?= $value['status_pembayaran'] == 'diterima' ? 'selected' : '' ?>>Diterima</option>
                            <option value="ditolak" <?= $value['status_pembayaran'] == 'ditolak' ? 'selected' : '' ?>>Ditolak</option>
                            <option value="dibatalkan" <?= $value['status_pembayaran'] == 'dibatalkan' ? 'selected' : '' ?>>Dibatalkan</option>
                        </select>
                    </div>
                    <div class="form-group col-md-12 keteranganDitolak" style="display: none;">
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
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
                <?= form_close() ?>
            </div>
        </div>
    </div>

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
        var keteranganPengembalian = document.querySelectorAll('.keteranganPengembalian');
        var keterangan_pengembalian = document.querySelectorAll('.keterangan_pengembalian');
        var waktuPengembalian = document.querySelectorAll('.waktuPengembalian');
        var waktu_pengembalian = document.querySelectorAll('.waktu_pengembalian');
        var dendaKeterlambatan = document.querySelectorAll('.dendaKeterlambatan');
        var denda_keterlambatan = document.querySelectorAll('.denda_keterlambatan');
        var namaPenerima = document.querySelectorAll('.namaPenerima');
        var nama_penerima = document.querySelectorAll('.nama_penerima');
        var detailPengembalian = document.querySelectorAll('.detailPengembalian');
        var detail_pengembalian = document.querySelectorAll('#detail_pengembalian');

        statusPenyewaan.forEach(function(statusPenyewaan, index) {
            statusPenyewaan.addEventListener('change', function() {
                if (this.value === 'disewakan') {
                    keteranganPengembalian[index].style.display = 'none';
                    keterangan_pengembalian[index].setAttribute('required', 'required');
                } else {
                    keteranganPengembalian[index].style.display = 'none';
                    keterangan_pengembalian[index].removeAttribute('required');
                    keterangan_pengembalian[index].value = '';
                    detailPengembalian[index].style.display = 'none';
                    detail_pengembalian[index].value = '';
                }
            });
        });

        statusPenyewaan.forEach(function(statusPenyewaan, index) {
            statusPenyewaan.addEventListener('change', function() {
                if (this.value === 'diterima') {
                    namaPenerima[index].style.display = 'block';
                    nama_penerima[index].setAttribute('required', 'required');
                } else {
                    namaPenerima[index].style.display = 'none';
                    nama_penerima[index].removeAttribute('required');
                    nama_penerima[index].value = '';
                }
            });
        });

        statusPenyewaan.forEach(function(statusPenyewaan, index) {
            statusPenyewaan.addEventListener('change', function() {
                if (this.value === 'dikembalikan') {
                    keteranganPengembalian[index].style.display = 'block';
                    keterangan_pengembalian[index].setAttribute('required', 'required');
                    waktuPengembalian[index].style.display = 'block';
                    waktu_pengembalian[index].setAttribute('required', 'required');
                } else {
                    keteranganPengembalian[index].style.display = 'none';
                    keterangan_pengembalian[index].removeAttribute('required');
                    keterangan_pengembalian[index].value = '';
                    detailPengembalian[index].style.display = 'none';
                    detail_pengembalian[index].value = '';
                    waktuPengembalian[index].style.display = 'none';
                    waktu_pengembalian[index].value = '';
                }
            });
        });

        keterangan_pengembalian.forEach(function(keterangan_pengembalian, index) {
            keterangan_pengembalian.addEventListener('change', function() {
                if (this.value === 'Kerusakan Ringan' || this.value === 'Kerusakan Berat') {
                    detailPengembalian[index].style.display = 'block';
                    detail_pengembalian[index].setAttribute('required', 'required');
                } else {
                    detailPengembalian[index].style.display = 'none';
                    detail_pengembalian[index].removeAttribute('required');
                    detail_pengembalian[index].value = '';
                }
            });
        });
        
        waktu_pengembalian.forEach(function(waktu_pengembalian, index) {
            waktu_pengembalian.addEventListener('change', function() {
                if (this.value === 'Tidak Tepat Waktu') {
                    dendaKeterlambatan[index].style.display = 'block';
                    denda_keterlambatan[index].setAttribute('required', 'required');
                } else {
                    dendaKeterlambatan[index].style.display = 'none';
                    denda_keterlambatan[index].removeAttribute('required');
                    denda_keterlambatan[index].value = '';
                }
            });
        });

    });
</script>


<!-- MODAL BUKTI TRANSFER LUNAS -->
<?php if (!empty($penyewaan['bukti_transfer_lunas'])) : ?>
    <div class="modal fade" id="bukti_transfer_lunas<?= $penyewaan['id_penyewaan']; ?>" tabindex="-1" role="dialog" aria-labelledby="modalBuktiTransferLabel<?= $penyewaan['id_transaksi']; ?>" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalBuktiTransferLabel<?= $penyewaan['id_transaksi']; ?>">Bukti Transfer Lunas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img src="<?= base_url('assets/images/bukti_transfer/lunas/' . $penyewaan['bukti_transfer_lunas']); ?>" style=" width: 100%; height: 450px; object-fit: contain;">
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<!-- MODAL BUKTI TRANSFER DP AWAL -->
<?php if (!empty($penyewaan['bukti_transfer_dp_awal'])) : ?>
    <div class="modal fade" id="bukti_transfer_dp_awal<?= $penyewaan['id_penyewaan']; ?>" tabindex="-1" role="dialog" aria-labelledby="modalBuktiDpAwalLabel<?= $penyewaan['id_transaksi']; ?>" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalBuktiDpAwalLabel<?= $penyewaan['id_transaksi']; ?>">Bukti Transfer DP Awal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img src="<?= base_url('assets/images/bukti_transfer/dp_awal/' . $penyewaan['bukti_transfer_dp_awal']); ?>" style=" width: 100%; height: 450px; object-fit: contain;">
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<!-- MODAL BUKTI TRANSFER DP AKHIR -->
<?php if (!empty($penyewaan['bukti_transfer_dp_akhir'])) : ?>
    <div class="modal fade" id="bukti_transfer_dp_akhir<?= $penyewaan['id_penyewaan']; ?>" tabindex="-1" role="dialog" aria-labelledby="modalBuktiDpAkhirLabel<?= $penyewaan['id_transaksi']; ?>" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalBuktiDpAkhirLabel<?= $penyewaan['id_transaksi']; ?>">Bukti Transfer DP Akhir</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img src="<?= base_url('assets/images/bukti_transfer/dp_akhir/' . $penyewaan['bukti_transfer_dp_akhir']); ?>" style=" width: 100%; height: 450px; object-fit: contain;">
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>