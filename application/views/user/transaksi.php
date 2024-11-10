<!-- CSS Bootstrap -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">

<!-- JavaScript Bootstrap dan dependensi -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>

<div class="container" style="padding: 100px 0;">
    <div class="row">
        <h2 class="text-capitalize">transaksi</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('home'); ?>" class="text-decoration-none">Beranda</a></li>
                <li class="breadcrumb-item active" aria-current="page">Transaksi</li>
            </ol>
        </nav>
        <div class="col-12 mt-3">
            <?php if (!empty($penyewaan)) : ?>
                <?= $this->session->flashdata('pesan'); ?>
                <div class="card shadow-sm">
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr align="center">
                                    <th width="5%">No.</th>
                                    <th>Nama Lengkap</th>
                                    <th>Tanggal Sewa</th>
                                    <th>Status Pembayaran</th>
                                    <th>Status Pelunasan</th>
                                    <th>Total</th>
                                    <th>Rincian</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($penyewaan as $key => $value) : ?>
                                    <tr align="center">
                                        <td><?= $key + 1; ?>.</td>
                                        <td><?= ucwords($value['nama_lengkap']); ?></td>
                                        <td><?= tanggalIndonesia($value['tanggal_sewa']) . ' - ' . tanggalIndonesia($value['tanggal_kembali']); ?></td>
                                        <td>
                                            <?php
                                            $status_pembayaran = [
                                                'belum dibayar' => 'text-bg-warning',
                                                'diterima'      => 'text-bg-success',
                                                'ditolak'       => 'text-bg-danger',
                                                'dibatalkan'    => 'text-bg-danger',
                                            ];

                                            $statusClass = isset($status_pembayaran[$value['status_pembayaran']]) ? $status_pembayaran[$value['status_pembayaran']] : '';
                                            ?>
                                            <span class="badge rounded-pill <?= $statusClass; ?> fw-normal">
                                                <?= ucwords($value['status_pembayaran']); ?>
                                            </span>
                                        </td>
                                        <td>
                                            <?php
                                            $status_pelunasan = [
                                                'belum lunas'   => 'text-bg-warning',
                                                'sudah lunas'   => 'text-bg-success',
                                            ];

                                            $statusClass = isset($status_pelunasan[$value['status_pelunasan']]) ? $status_pelunasan[$value['status_pelunasan']] : '';
                                            ?>

                                            <span class="badge rounded-pill <?= $statusClass; ?> fw-normal">
                                                <?= ucwords($value['status_pelunasan']); ?>
                                            </span>
                                        </td>
                                        <td>Rp <?= number_format($value['sub_total']); ?></td>
                                        <td>
                                            <a href="<?= base_url('detail_penyewaan/' . $value['id_penyewaan']); ?>" class="btn btn-sm btn-secondary" title="Rincian">
                                                <i class="bi bi-eye-fill"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <!-- KONDISI UNTUK METODE PEMBAYARAN TRANSFER -->
                                            <!-- JIKA STATUS PEMBAYARAN BELUM DIBAYAR DAN STATUS PELUNASAN BELUM LUNAS -->
                                            <?php if ($value['status_pembayaran'] == 'belum dibayar' && $value['status_pelunasan'] == 'belum lunas') : ?>
                                                <a href="<?= base_url('pembayaran/' . $value['id_penyewaan']); ?>" class="btn btn-sm btn-primary" title="Bayar">
                                                    Bayar
                                                </a>
                                                <a href="<?= base_url('hapus_transaksi/' . $value['id_penyewaan']); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')" title="Hapus">
                                                    <i class="bi bi-trash3-fill"></i>
                                                </a>
                                                <!-- JIKA STATUS PEMBAYARAN DITERIMA DAN STATUS PELUNASAN BELUM LUNAS -->
                                            <?php elseif ($value['status_pembayaran'] == 'diterima' && $value['status_pelunasan'] == 'belum lunas') : ?>
                                                <a href="<?= base_url('pembayaran/' . $value['id_penyewaan']); ?>" class="btn btn-sm btn-primary" title="Bayar">
                                                    Bayar
                                                </a>
                                                <!-- JIKA STATUS PEMBAYARAN DITOLAK DAN STATUS PELUNASAN BELUM LUNAS -->
                                            <?php elseif ($value['status_pembayaran'] == 'ditolak' && $value['status_pelunasan'] == 'belum lunas') : ?>
                                                <a href="<?= base_url('pembayaran/' . $value['id_penyewaan']); ?>" class="btn btn-sm btn-primary" title="Bayar">
                                                    Bayar
                                                </a>
                                                <a href="<?= base_url('hapus_transaksi/' . $value['id_penyewaan']); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')" title="Hapus">
                                                    <i class="bi bi-trash3-fill"></i>
                                                </a>
                                                <!-- JIKA STATUS PEMBAYARAN DITERIMA DAN STATUS PELUNASAN SUDAH LUNAS -->
                                            <?php elseif ($value['status_pembayaran'] == 'diterima' && $value['status_pelunasan'] == 'sudah lunas') : ?>
                                                <a href="<?= base_url('user/cetak_nota/' . $value['id_penyewaan']); ?>" class="btn btn-sm btn-success" target="_blank" title="Nota">
                                                    Nota
                                                </a>
                                                <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#perpanjang<?= $value['id_penyewaan']; ?>" title="Perpanjang Sewa">
                                                    Perpanjang Sewa
                                            </button>
                                                <!-- <a href="#" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#perpanjangSewaModal" title="Perpanjang Sewa">
                                                    Perpanjang Sewa
                                                </a> -->
                                                <!-- JIKA STATUS PEMBAYARAN DIBATALKAN -->
                                            <?php elseif ($value['status_pembayaran'] == 'dibatalkan') : ?>
                                                <a href="<?= base_url('hapus_transaksi/' . $value['id_penyewaan']); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')" title="Hapus">
                                                    <i class="bi bi-trash3-fill"></i>
                                                </a>
                                                <!-- JIKA STATUS PENYEWAAN DIKEMBALIKAN -->
                                            <?php elseif ($value['status_penyewaan'] == 'dikembalikan') : ?>
                                                <a href="<?= base_url('hapus_transaksi/' . $value['id_penyewaan']); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')" title="Hapus">
                                                    <i class="bi bi-trash3-fill"></i>
                                                </a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php
                                endforeach; ?>
                            </tbody>
                        </table>
                    <?php else : ?>
                        <div class="alert alert-danger">
                            Transaksi Kosong
                        </div>
                        <a href="<?= base_url('home'); ?>" class="btn btn-primary">Lanjutkan Penyewaan</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- <script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('formPerpanjangSewa');

        document.querySelectorAll('.btn-perpanjang-sewa').forEach(button => {
            button.addEventListener('click', function () {
                const idPenyewaan = this.getAttribute('data-id');
                document.getElementById('id_penyewaan').value = idPenyewaan;
            });
        });

        form.addEventListener('submit', function (e) {
            e.preventDefault();
            const formData = new FormData(this);

            fetch('<?= base_url('user/perpanjang_sewa'); ?>', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.reload();
                } else {
                    alert('Gagal memperpanjang sewa');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    });
</script> -->


                    <!-- Modal Perpanjang Sewa -->
                    <?php
                    foreach ($penyewaan as $key => $value) : ?>
                        <div class="modal fade" id="perpanjang<?= $value['id_penyewaan']; ?>" tabindex="-1" aria-labelledby="perpanjangSewaModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="perpanjangSewaModalLabel">Perpanjang Sewa</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                        <?= form_open('user/perpanjang_sewa'); ?>
                                        <input type="hidden" id="id_penyewaan" name="id_penyewaan" value="<?= $value['id_penyewaan']; ?>">
                                        <div class="mb-3">
                                            <label for="tanggal_kembali" class="form-label">Tanggal Kembali Baru</label>
                                            <input type="date" class="form-control" id="tanggal_kembali" name="tanggal_kembali" required>
                                        </div>
                                    <button type="submit" class="btn btn-primary">Perpanjang Sewa</button>
                                    <?= form_close() ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    endforeach; ?>