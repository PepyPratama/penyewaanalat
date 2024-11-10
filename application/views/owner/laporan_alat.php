<div class="content-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <?= $this->session->flashdata('pesan'); ?>
                <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title"><?= $title; ?></h4>
                        <div>
                            <a href="<?= base_url('owner/alat_excel'); ?>" class="btn btn-success text-white">Excel</a>
                            <a href="<?= base_url('owner/alat_pdf'); ?>" target="_blank" class="btn btn-danger text-white">PDF</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-responsive-sm">
                                <thead>
                                    <tr align="center">
                                        <th width="5%">No</th>
                                        <th width="10%">No Seri</th>
                                        <th>Nama</th>
                                        <th>Kategori</th>
                                        <th width="10%">Harga Sewa</th>
                                        <th>Stok Keseluruhan</th>
                                        <th>Stok Rusak</th>
                                        <th>Stok Tersedia</th>
                                        <th>Stok Disewa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($alat as $key => $value) : ?>
                                        <tr align="center">
                                            <td><?= $key + 1; ?>.</td>
                                            <td><?= ucwords($value['no_seri']); ?></td>
                                            <td><?= ucwords($value['nama_alat']); ?></td>
                                            <td><?= ucwords($value['nama_kategori']); ?></td>
                                            <td>Rp <?= number_format($value['harga_sewa']); ?></td>
                                            <td><?= number_format($value['stok_keseluruhan']); ?></td>
                                            <td><?= number_format($value['stok_rusak']); ?></td>
                                            <td><?= number_format(max(0, $value['stok_tersedia'])); ?></td>
                                            <td><?= number_format(max(0, $value['stok_disewa'])); ?></td>
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