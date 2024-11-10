<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Nota Penyewaan</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/nota-style.css'); ?>">
</head>

<body>
    <header class="clearfix">
        <div id="logo">
            <img src="<?= base_url('assets/images/logo/logo-hitam.png'); ?>">
        </div>
        <h1>INVOICE</h1>
        <div id="company" class="clearfix">
            <img src="<?= base_url('assets/images/lunas.png'); ?>" alt="" width="120">
        </div>
        <div id="project">
            <div><span>KODE</span> <?= $penyewaan['kode_penyewaan']; ?></div>
            <div><span>NAMA</span> <?= ucwords($penyewaan['nama_lengkap']); ?></div>
            <div><span>EMAIL</span> <?= ucwords($penyewaan['email']); ?></div>
            <div><span>TGL SEWA</span> <?= tanggalIndonesia($penyewaan['tanggal_sewa']); ?></div>
            <div><span>TGL KEMBALI</span> <?= tanggalIndonesia($penyewaan['tanggal_kembali']); ?></div>
        </div>
    </header>
    <main>
        <table>
            <thead>
                <tr>
                    <th class="service">NO</th>
                    <th class="service">NO SERI</th>
                    <th class="desc">NAMA ALAT</th>
                    <th>JUMLAH</th>
                    <th>HARGA</th>
                    <th>TOTAL</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($penyewaan_detail as $key => $value) :
                    $total_semua = 0;

                    $tanggal_sewa       = new DateTime($value['tanggal_sewa']);
                    $tanggal_kembali    = new DateTime($value['tanggal_kembali']);
                    $interval           = $tanggal_sewa->diff($tanggal_kembali);
                    $jumlah_hari        = $interval->days + 1;
                    $total_biaya_item   = $value['harga_sewa'] * $value['jumlah'] * $jumlah_hari;

                    $total_semua += $total_biaya_item; ?>
                    <tr>
                        <td class="service"><?= $key + 1; ?>.</td>
                        <td class="service"><?= strtoupper($value['no_seri']); ?></td>
                        <td class="desc"><?= ucwords($value['nama_alat']); ?></td>
                        <td class="unit"><?= number_format($value['jumlah']); ?></td>
                        <td class="qty">Rp <?= number_format($value['harga_sewa']); ?>,-</td>
                        <td class="total">Rp. <?= number_format($total_biaya_item); ?>,-</td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="5" class="grand total">SUB TOTAL</td>
                    <td class="grand total">Rp. <?= number_format($total_semua); ?>,-</td>
                </tr>
            </tbody>
        </table>
        <!-- <div id="notices">
            <div>NOTICE:</div>
            <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
        </div> -->
    </main>
</body>

</html>

<script>
    window.print();
</script>