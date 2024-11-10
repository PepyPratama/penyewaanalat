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
                                            <th width="15%">Aksi</th>
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
                                                <td>
                                                <a href="<?= base_url('admin/detail_transaksi/' . $value['id_penyewaan']); ?>" class="btn btn-sm btn-warning text-white" title="Detail">
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
</div>