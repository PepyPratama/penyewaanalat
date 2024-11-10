<div class="content-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <?= $this->session->flashdata('pesan'); ?>

                <!-- RINCIAN PENYEWAAN -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="fw-semibold">Rincian Pembelian</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3 text-capitalize">
                                <p>kode pembelian</p>
                                <p>nama alat</p>
                                <p>harga beli</p>
                                <p>jumlah pembelian</p>
                                <p>status</p>
                                <p>jenis pembelian</p>
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
                                <p>: <?= ucwords($pembelian['nama_alat']); ?></p>
                                <p>: Rp <?= number_format($pembelian['harga_beli']); ?>,-</p>
                                <p>: <?= $pembelian['jumlah_pembelian']; ?></p>
                                <p>:
                                    <span class="badge rounded-pill <?= $statusClass; ?> fw-normal">
                                        <?= ucwords($pembelian['status']); ?>
                                    </span>
                                </p>
                                <p>: <?= ucwords($pembelian['jenis_pembelian']); ?></p>
                                <p>: <?= tanggalIndonesia($pembelian['tanggal_pembelian']); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="<?= base_url('admin/pembelian'); ?>" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
</div>