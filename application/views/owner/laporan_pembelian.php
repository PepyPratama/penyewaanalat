<div class="content-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <?= $this->session->flashdata('pesan'); ?>
                <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title"><?= $title; ?></h4>
                        <div>
                            <a href="<?= base_url('owner/pembelian_excel'); ?>" class="btn btn-success text-white">Excel</a>
                            <a href="<?= base_url('owner/pembelian_pdf'); ?>" target="_blank" class="btn btn-danger text-white">PDF</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-responsive-sm">
                                <thead>
                                    <tr align="center">
                                        <th>Kode Pembelian</th>
                                        <th>Nama Alat</th>
                                        <th>Nama Toko</th>
                                        <th>Harga Beli</th>
                                        <th>Jumlah Pembelian</th>
                                        <th>Jumlah ACC</th>
                                        <th>Jenis Pembelian</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($pembelian as $key => $value) : ?>
                                        <tr align="center">
                                            <td><?= ucwords($value['kode_pembelian']); ?></td>
                                            <td><?= ucwords($value['nama_alat']); ?></td>
                                            <td><?= ucwords($value['nama_toko']); ?></td>
                                            <td>Rp <?= number_format($value['harga_beli']); ?>,-</td>
                                            <td><?= number_format($value['jumlah_pembelian']); ?></td>
                                            <td><?= number_format($value['jumlah_acc']); ?></td>
                                            <td><?= ucwords($value['jenis_pembelian']); ?></td>
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


<!-- MODAL FOTO -->
<?php foreach ($pembelian as $value) : ?>
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