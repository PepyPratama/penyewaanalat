<div class="container" style="padding: 100px 0;">
    <div class="row d-flex justify-content-between align-items-center">
        <div class="col-md-5 rounded-2 d-flex justify-content-center align-items-center border shadow-sm">
            <img src="<?= base_url('assets/images/upload_alat/' . $alat['foto']); ?>" class="img-fluid" alt="...">
        </div>
        <div class="col-md-7">
            <div class="row d-flex justify-content-between align-items-center">
                <div class="col-md-7 px-5">
                    <?= form_open('user/addToCart/' . $alat['id_alat']); ?>
                    <div class="mb-5">
                        <h2><?= ucwords($alat['nama_alat']); ?></h2>
                        <h4 class="pt-3">Rp. <?= number_format($alat['harga_sewa']); ?>/hari</h4>
                    </div>
                    <div class="row my-4">
                        <div class="col-6">
                            <p>Kategori</p>
                            <p>Stok Keseluruhan</p>
                            <p>Stok Tersedia</p>
                        </div>
                        <div class="col-6">
                            <p>: <?= ucwords($alat['nama_kategori']); ?></p>
                            <p>: <?= number_format(!empty($alat['stok_keseluruhan']) ? $alat['stok_keseluruhan'] : 0); ?></p>
                            <p>: <?= number_format(!empty($alat['stok_tersedia']) ? $alat['stok_tersedia'] : 0); ?></p>
                        </div>
                    </div>
                    <div class="">
                        <button type="submit" class="btn btn-warning"><i class="bi bi-cart-fill"></i> Masukkan Keranjang</button>
                        <a href="<?= base_url('home'); ?>" class="btn btn-dark">Kembali</a>
                    </div>
                    <?= form_close() ?>
                </div>
                <div class="col-md-5">
                    <div id="kalender"></div>
                    <div class="row my-4">
                        <div class="col-12">
                            <p><span class="bg-danger rounded-5" style="padding: 2px 11px;">&nbsp;</span> Barang Disewa</p>
                            <p><span class="bg-success rounded-5" style="padding: 2px 11px;">&nbsp;</span> Barang Dikembalikan</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-md-12">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="spesifikasi-tab" data-bs-toggle="tab" data-bs-target="#spesifikasi-tab-pane" type="button" role="tab" aria-controls="spesifikasi-tab-pane" aria-selected="true">Spesifikasi</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active pt-3" id="spesifikasi-tab-pane" role="tabpanel" aria-labelledby="spesifikasi-tab" tabindex="0">
                    <?php
                    $spesifikasi = nl2br($alat['spesifikasi']);
                    $baris = explode('<br />', $spesifikasi);
                    if (count($baris) > 1) {
                        echo '<ol>';
                        foreach ($baris as $item) {
                            if (trim($item) !== '') {
                                echo '<li>' . trim($item) . '</li>';
                            }
                        }
                        echo '</ol>';
                    } else {
                        echo '<p>' . $spesifikasi . '</p>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tambahkan ini untuk menggunakan jQuery UI Datepicker -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<!-- <script>
    $(document).ready(function() {
        var tanggalDisewa = <?= json_encode(array_column($tanggalDisewa, 'tanggal_sewa')) ?>;

        $("#kalender").datepicker({
            beforeShowDay: function(date) {
                var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
                if (tanggalDisewa.indexOf(string) != -1) {
                    return [true, 'sewa-taken', 'Barang Tidak Tersedia'];
                }
                return [true, '', ''];
            }
        });
    });
</script>
<style>
    .sewa-taken a {
        background-color: red !important;
        color: white !important;
    }
</style> -->

<script>
    $(document).ready(function() {
        var tanggalDisewa = <?= json_encode(array_column($tanggalDisewa, 'tanggal_sewa')) ?>;
        var tanggalKembali = <?= json_encode(array_column($tanggalDisewa, 'tanggal_kembali')) ?>;

        console.log("tanggalDisewa: ", tanggalDisewa);
        console.log("tanggalKembali: ", tanggalKembali);

        $("#kalender").datepicker({
            beforeShowDay: function(date) {
                var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
                if (tanggalKembali.indexOf(string) != -1) {
                    return [true, 'sewa-return', 'Barang Dikembalikan'];
                }
                if (tanggalDisewa.indexOf(string) != -1) {
                    return [true, 'sewa-taken', 'Barang Disewa'];
                }
                return [true, '', ''];
            }
        });
    });
</script>

<style>
    .sewa-taken a {
        background-color: red !important;
        color: white !important;
    }

    .sewa-return a {
        background-color: green !important;
        color: white !important;
    }
</style>