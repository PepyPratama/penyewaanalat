<div class="container" style="padding: 100px 0;">
    <div class="row">
        <h2 class="text-capitalize">checkout</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('home'); ?>" class="text-decoration-none">Beranda</a></li>
                <li class="breadcrumb-item active" aria-current="page">Checkout</li>
            </ol>
        </nav>
        <div class="col-12 mt-3">
            <?= $this->session->flashdata('pesan'); ?>
            <div class="card shadow-sm">
                <div class="card-body">
                    <?= form_open('user/checkout_penyewaan'); ?>
                    <h6 class="text-capitalize">rincian penyewaan</h6>
                    <hr>
                    <table class="table table-striped">
                        <thead>
                            <tr align="center">
                                <th width="10%">Foto</th>
                                <th>No Seri</th>
                                <th>Nama Alat</th>
                                <th>Spesifikasi</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $subtotal = 0;
                            foreach ($cart as $value) : ?>
                                <tr align="center">
                                    <th scope="row">
                                        <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#foto<?= $value['id_alat']; ?>" title="Foto">
                                            <i class="bi bi-image"></i></button>
                                    </th>
                                    <td><?= strtoupper($value['no_seri']); ?></td>
                                    <td><?= ucwords($value['nama_alat']); ?></td>
                                    <th>
                                        <button type="button" class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#spesifikasi<?= $value['id_alat']; ?>" title="Spesifikasi">
                                            <i class="bi bi-eye-fill"></i>
                                        </button>
                                    </th>
                                    <td><?= number_format($value['jumlah']); ?></td>
                                    <td>Rp. <?= number_format($value['harga_sewa']); ?>/Hari</td>
                                    <td>Rp. <?= number_format($value['harga_sewa'] * $value['jumlah']); ?></td>
                                </tr>
                            <?php
                                $subtotal += $value['harga_sewa'] * $value['jumlah'];
                            endforeach; ?>
                            <tr align="center">
                                <th colspan="6">Sub Total</th>
                                <?= form_hidden('sub_total', $subtotal); ?>
                                <th>Rp. <?= number_format($subtotal); ?></th>
                            </tr>
                        </tbody>
                    </table>
                    <h6 class="text-capitalize pt-4">informasi pemesanan</h6>
                    <hr>
                    <div class="mb-3">
                        <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?= ucwords($this->session->userdata('nama_lengkap')) ?>" disabled readonly>
                    </div>
                    <div class="mb-3">
                        <label for="tanggal_sewa" class="form-label">Tanggal Sewa</label>
                        <input type="date" class="form-control" id="tanggal_sewa" name="tanggal_sewa" required>
                    </div>
                    <div class="mb-3">
                        <label for="tanggal_kembali" class="form-label">Tanggal Kembali</label>
                        <input type="date" class="form-control" id="tanggal_kembali" name="tanggal_kembali" required>
                    </div>
                    <div class="mb-3">
                        <label for="no_telp" class="form-label">No Telp</label>
                        <input type="number" min="0" class="form-control" id="no_telp" name="no_telp" placeholder="Masukkan no telp" required>
                    </div>
                    <div class="mb-3">
                        <label for="metode_pembayaran" class="form-label">Metode Pembayaran</label>
                        <select id="metode_pembayaran" name="metode_pembayaran" class="form-select" required>
                            <option disabled selected value="">Pilih</option>
                            <option value="cash">Cash</option>
                            <option value="transfer">Transfer</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="opsi_pembayaran" class="form-label">Opsi Pembayaran</label>
                        <select id="opsi_pembayaran" name="opsi_pembayaran" class="form-select" required>
                            <option disabled selected value="">Pilih</option>
                            <option value="dp">DP</option>
                            <option value="lunas">Lunas</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-warning mt-2">Konfirmasi</button>
                    <a href="<?= base_url('cart'); ?>" class="btn btn-dark mt-2">Kembali</a>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php foreach ($cart as $value) : ?>
    <!-- MODAL FOTO -->
    <div class="modal fade" id="foto<?= $value['id_alat']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"><?= $value['nama_alat']; ?></h1>
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
<?php endforeach; ?>