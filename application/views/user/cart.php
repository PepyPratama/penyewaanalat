<div class="container" style="padding: 100px 0;">
    <div class="row">
        <h2 class="text-capitalize">shopping cart</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('home'); ?>" class="text-decoration-none">Beranda</a></li>
                <li class="breadcrumb-item active" aria-current="page">Keranjang</li>
            </ol>
        </nav>
        <div class="col-12 mt-3">
            <?php if (!empty($cart)) : ?>
                <?= $this->session->flashdata('pesan'); ?>
                <div class="card shadow-sm">
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr align="center">
                                    <th width="10%">Foto</th>
                                    <th>No Seri</th>
                                    <th>Nama Alat</th>
                                    <th>Spesifikasi</th>
                                    <th width="15%">Jumlah</th>
                                    <th>Harga</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $subtotal = 0;
                                foreach ($cart as $value) : ?>
                                    <tr align="center">
                                        <th>
                                            <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#foto<?= $value['id_alat']; ?>" title="Foto">
                                                <i class="bi bi-image"></i>
                                            </button>
                                        </th>
                                        <td><?= strtoupper($value['no_seri']); ?></td>
                                        <td><?= ucwords($value['nama_alat']); ?></td>
                                        <th>
                                            <button type="button" class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#spesifikasi<?= $value['id_alat']; ?>" title="Spesifikasi">
                                                <i class="bi bi-eye-fill"></i>
                                            </button>
                                        </th>
                                        <td>
                                            <?php
                                            $id_keranjang = $value['id_keranjang'];
                                            $stok_keseluruhan = $value['stok_keseluruhan'];
                                            ?>
                                            <?= form_open('edit/' . $id_keranjang); ?>
                                            <?= form_hidden('id_keranjang', $id_keranjang); ?>
                                            <div class="input-group">
                                                <input type="number" min="1" id="jumlah_alat_<?= $id_keranjang ?>" name="jumlah" class="form-control" value="<?= $value['jumlah'] ?>" oninput="checkStock(<?= $stok_keseluruhan ?>, <?= $id_keranjang ?>)">
                                                <button type="submit" class="btn btn-warning" title="Edit">
                                                    <i class="bi bi-arrow-clockwise"></i>
                                                </button>
                                                <a href="<?= base_url('hapus/' . $id_keranjang) ?>" class="btn btn-danger" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus item ini dari keranjang?')">
                                                    <i class="bi bi-x-circle-fill"></i>
                                                </a>
                                            </div>
                                            <?= form_close() ?>
                                        </td>
                                        <td>Rp. <?= number_format($value['harga_sewa']); ?>/Hari</td>
                                        <td>Rp. <?= number_format($value['harga_sewa'] * $value['jumlah']); ?></td>
                                    </tr>
                                <?php
                                    $subtotal += $value['harga_sewa'] * $value['jumlah'];
                                endforeach; ?>
                                <tr align="center">
                                    <th colspan="6">Sub Total</th>
                                    <th>Rp. <?= number_format($subtotal); ?></th>
                                </tr>
                            </tbody>
                        </table>
                        <a href="<?= base_url('checkout'); ?>" class="btn btn-warning">Lanjutkan Penyewaan</a>
                    <?php else : ?>
                        <div class="alert alert-danger">
                            Shopping Cart Kosong
                        </div>
                        <a href="<?= base_url('home'); ?>" class="btn btn-warning">Lanjutkan Berbelanja</a>
                    <?php endif; ?>
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
<?php endforeach; ?>


<script>
    function checkStock(stok_keseluruhan, id_keranjang) {
        var jumlahAlatInput = document.getElementById('jumlah_alat_' + id_keranjang);
        var jumlahAlat = jumlahAlatInput.value;

        if (parseInt(jumlahAlat) > stok_keseluruhan) {
            alert('Jumlah alat melebihi stok yang tersedia!');
            jumlahAlatInput.value = stok_keseluruhan;
        }
    }
</script>