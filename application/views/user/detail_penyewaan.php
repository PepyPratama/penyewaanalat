<div class="container" style="padding: 100px 0;">
    <div class="row">
        <h2 class="text-capitalize">detail penyewaan</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('home'); ?>" class="text-decoration-none">Beranda</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detail</li>
            </ol>
        </nav>
        <div class="col-12 mt-3">
            <?= $this->session->flashdata('pesan'); ?>
            <div class="card shadow-sm">
                <div class="card-body">

                    <!-- RINCIAN PENYEWAAN -->
                    <h5 class="text-capitalize">rincian penyewaan</h5>
                    <hr>
                    <table class="table table-striped">
                        <thead>
                            <tr align="center">
                                <th width="10%">Foto</th>
                                <th>No Seri</th>
                                <th>Nama Alat</th>
                                <th>Tanggal Sewa</th>
                                <th>Jumlah Hari</th>
                                <th>Spesifikasi</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $total_semua = 0;

                            foreach ($penyewaan as $key => $value) :
                                // Hitung jumlah hari sewa
                                $tanggal_sewa       = new DateTime($value['tanggal_sewa']);
                                $tanggal_kembali    = new DateTime($value['tanggal_kembali']);
                                
                                // Calculate the difference in days
                                $interval           = $tanggal_sewa->diff($tanggal_kembali);
                                $jumlah_hari        = ($tanggal_sewa == $tanggal_kembali) ? 1 : ($interval->days + 1); // If the dates are the same, set jumlah_hari to 1

                                // Hitung total biaya sewa untuk item ini
                                $total_biaya_item = $value['harga_sewa'] * $value['jumlah'] * $jumlah_hari;
                                $total_semua += $total_biaya_item; // Tambahkan total biaya item ini ke total keseluruhan
                            ?>
                                <tr align="center">
                                    <th>
                                        <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#foto<?= $value['id_alat']; ?>" title="foto">
                                            <i class="bi bi-image"></i>
                                        </button>
                                    </th>
                                    <td><?= strtoupper($value['no_seri']); ?></td>
                                    <td><?= ucwords($value['nama_alat']); ?></td>
                                    <td><?= tanggalIndonesia($value['tanggal_sewa']) . ' - ' . tanggalIndonesia($value['tanggal_kembali']); ?></td>
                                    <td><?= $jumlah_hari . ''; ?></td>
                                    <th>
                                        <button type="button" class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#spesifikasi<?= $value['id_alat']; ?>" title="Spesifikasi">
                                            <i class="bi bi-eye-fill"></i>
                                        </button>
                                    </th>
                                    <td><?= number_format($value['jumlah']); ?></td>
                                    <td>Rp. <?= number_format($value['harga_sewa']); ?>/Hari</td>
                                    <td>Rp. <?= number_format($total_biaya_item); ?></td>
                                </tr>
                            <?php
                            endforeach;
                            ?>
                            <tr align="center">
                                <th colspan="8">Sub Total</th>
                                <td>Rp. <?= number_format($total_semua); ?></td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- RINCIAN PEMBAYARAN -->
                    <h5 class="text-capitalize pt-5">rincian pembayaran</h5>
                    <hr>

                    <!-- KONDISI METODE TRANSFER OPSI DP -->
                    <?php if ($value['metode_pembayaran'] == 'transfer' && $value['opsi_pembayaran'] == 'dp') : ?>
                        <table class="table table-striped">
                            <thead>
                                <tr align="center">
                                    <th>Tanggal Pembayaran DP</th>
                                    <th>Jumlah DP</th>
                                    <th>Bukti DP</th>
                                    <th>Sisa Bayar</th>
                                    <th>Bukti Pelunasan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr align="center">
                                    <td><?= $value['tgl_transfer_dp_awal'] ? tanggalIndonesia($value['tgl_transfer_dp_awal']) : '-'; ?></td>
                                    <td>Rp <?= number_format($value['sub_total'] / 2); ?></td>
                                    <td>
                                        <?php if ($value['bukti_transfer_dp_awal']) : ?>
                                            <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#bukti_dp_awal<?= $value['id_transaksi']; ?>" title="foto">
                                                <i class="bi bi-image"></i>
                                            </button>
                                        <?php else : ?>
                                            -
                                        <?php endif; ?>
                                    </td>
                                    <td>Rp <?= number_format($value['sub_total'] / 2); ?></td>
                                    <td>
                                        <?php if ($value['bukti_transfer_dp_akhir']) : ?>
                                            <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#bukti_dp_akhir<?= $value['id_transaksi']; ?>" title="foto">
                                                <i class="bi bi-image"></i>
                                            </button>
                                        <?php else : ?>
                                            -
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <!-- KONDISI METODE TRANSFER OPSI LUNAS -->
                    <?php elseif ($value['metode_pembayaran'] == 'transfer' && $value['opsi_pembayaran'] == 'lunas') : ?>
                        <table class="table table-striped">
                            <thead>
                                <tr align="center">
                                    <th>Tanggal Pelunasan</th>
                                    <th>Jumlah Pelunasan</th>
                                    <th>Bukti Pelunasan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr align="center">
                                    <td><?= $value['tgl_transfer_lunas'] ? tanggalIndonesia($value['tgl_transfer_lunas']) : '-'; ?></td>
                                    <td>Rp <?= number_format($value['sub_total']); ?></td>
                                    <td>
                                        <?php if ($value['bukti_transfer_lunas']) : ?>
                                            <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#bukti_lunas<?= $value['id_transaksi']; ?>" title="foto">
                                                <i class="bi bi-image"></i>
                                            </button>
                                        <?php else : ?>
                                            -
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <!-- KONDISI METODE TRANSFER OPSI DP -->
                    <?php elseif ($value['metode_pembayaran'] == 'cash' && $value['opsi_pembayaran'] == 'dp') : ?>
                        <table class="table table-striped">
                            <thead>
                                <tr align="center">
                                    <th>Jumlah Pembayaran</th>
                                    <th>Status Pembayaran</th>
                                    <th>Jumlah Pelunasan</th>
                                    <th>Status Pelusan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr align="center">
                                    <td>Rp <?= number_format($value['sub_total'] / 2); ?></td>
                                    <td><?= ucwords($value['status_pembayaran']); ?></td>
                                    <td>Rp <?= number_format($value['sub_total'] / 2); ?></td>
                                    <td><?= ucwords($value['status_pelunasan']); ?></td>
                                </tr>
                            </tbody>
                        </table>

                        <!-- KONDISI METODE TRANSFER OPSI LUNAS -->
                    <?php elseif ($value['metode_pembayaran'] == 'cash' && $value['opsi_pembayaran'] == 'lunas') : ?>
                        <table class="table table-striped">
                            <thead>
                                <tr align="center">
                                    <th>Jumlah Pelunasan</th>
                                    <th>Status Pelusan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr align="center">
                                    <td>Rp <?= number_format($value['sub_total']); ?></td>
                                    <td><?= ucwords($value['status_pelunasan']); ?></td>
                                </tr>
                            </tbody>
                        </table>
                    <?php endif; ?>

                    <!-- INFORMASI PEMESANAN -->
                    <h5 class="text-capitalize pt-5">informasi pemesanan</h5>
                    <hr>
                    <?= form_open('checkout_penyewaan'); ?>
                    <fieldset disabled>
                        <div class="mb-3">
                            <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?= ucwords($value['nama_lengkap']); ?>">
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_sewa" class="form-label">Tanggal Sewa</label>
                            <input type="text" class="form-control" id="tanggal_sewa" name="tanggal_sewa" value="<?= tanggalIndonesia($value['tanggal_sewa']); ?>">
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_kembali" class="form-label">Tanggal Kembali</label>
                            <input type="text" class="form-control" id="tanggal_kembali" name="tanggal_kembali" value="<?= tanggalIndonesia($value['tanggal_kembali']); ?>">
                        </div>
                        <div class="mb-3">
                            <label for="no_telp" class="form-label">No Telp</label>
                            <input type="text" class="form-control" id="no_telp" name="no_telp" value="<?= ucwords($value['no_telp']); ?>">
                        </div>
                        <div class="mb-3">
                            <label for="metode_pembayaran" class="form-label">Metode Pembayaran</label>
                            <input type="text" class="form-control" id="metode_pembayaran" name="metode_pembayaran" value="<?= ucwords($value['metode_pembayaran']); ?>">
                        </div>
                        <div class="mb-3">
                            <label for="opsi_pembayaran" class="form-label">Opsi Pembayaran</label>
                            <input type="text" class="form-control" id="opsi_pembayaran" name="opsi_pembayaran" value="<?= ucwords($value['opsi_pembayaran']); ?>">
                        </div>
                    </fieldset>
                    <a href="<?= base_url('transaksi'); ?>" class="btn btn-secondary mt-2">Kembali</a>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php foreach ($penyewaan as $value) : ?>
    <!-- MODAL FOTO -->
    <div class="modal fade" id="foto<?= $value['id_alat']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Foto</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img src="<?= base_url('assets/images/upload_alat/' . $value['foto']); ?>" style=" width: 100%; height: 450px; object-fit: contain;">
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL SPESIFIKASI -->
    <div class="modal fade" id="spesifikasi<?= $value['id_alat']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Spesifikasi</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>
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
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL BUKTI DP AWAL -->
    <div class="modal fade" id="bukti_dp_awal<?= $value['id_transaksi']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Foto</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img src="<?= base_url('assets/images/bukti_transfer/dp_awal/' . $value['bukti_transfer_dp_awal']); ?>" style=" width: 100%; height: 450px; object-fit: contain;">
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL BUKTI DP AKHIR -->
    <div class="modal fade" id="bukti_dp_akhir<?= $value['id_transaksi']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Foto</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img src="<?= base_url('assets/images/bukti_transfer/dp_akhir/' . $value['bukti_transfer_dp_akhir']); ?>" style=" width: 100%; height: 450px; object-fit: contain;">
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL BUKTI DP LUNAS -->
    <div class="modal fade" id="bukti_lunas<?= $value['id_transaksi']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Foto</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img src="<?= base_url('assets/images/bukti_transfer/lunas/' . $value['bukti_transfer_lunas']); ?>" style=" width: 100%; height: 450px; object-fit: contain;">
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
