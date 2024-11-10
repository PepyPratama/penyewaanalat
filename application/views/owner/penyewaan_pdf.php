<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laporan Penyewaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<style>
  p {
    font-size: 15px;
  }
</style>

<body>

<div>
    <div class="container-fluid">
      <div class="row">
        <div class="col-12 text-center">
          <img src="<?= base_url('assets/images/logo/logo-hitam.png'); ?>" class="img-fluid" alt="" width="120" height="140">
          <h3 class="py-4">PT. MEZZO KREASI UTAMA</h3>
          <h6>Jl. Puyuh Dalam II No.50, RT.02/RW.10, Telepon 08990278778</h6>
        </div>
      </div>
    <hr/>
        <div class="row">
            <h4 class="text-center text-uppercase">Laporan Penyewaan</h4>
            <div class="col-12 mt-3">
                <table class="table table-striped table-hover table-bordered">
                    <thead>
                    <tr align="center" style="font-size: 13px">
                            <th scope="col">No.</th>
                            <th scope="col">Nama Lengkap</th>
                            <th scope="col">Tanggal Penyewaan</th>
                            <th scope="col">No. Telp</th>
                            <th scope="col">Metode</th>
                            <th scope="col">Opsi</th>
                            <th scope="col">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($penyewaan as $key => $value) : ?>
                          <tr align="center" style="font-size: 13px">
                            <th scope="row"><?= $key + 1; ?>.</th>
                                <td><?= ucwords($value['nama_lengkap']); ?></td>
                                <td><?= tanggalIndonesia($value['tanggal_sewa']) . ' - ' . tanggalIndonesia($value['tanggal_kembali']); ?></td>
                                <td><?= $value['no_telp']; ?></td>
                                <td><?= ucwords($value['metode_pembayaran']); ?></td>
                                <td><?= ucwords($value['opsi_pembayaran']); ?></td>
                                <td>Rp <?= number_format($value['sub_total']); ?>,-</td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row mt-5">
            <h4 class="text-center text-uppercase">Alat yang Sering Disewa</h4>
            <div class="col-12 mt-3">
                <table class="table table-striped table-hover table-bordered">
                    <thead>
                        <tr align="center" style="font-size: 13px">
                            <th scope="col">No.</th>
                            <th scope="col">Nama Alat</th>
                            <th scope="col">Total Disewa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($ringkasan_alat as $key => $alat) : ?>
                          <tr align="center" style="font-size: 13px">
                                <th scope="row"><?= $key + 1; ?>.</th>
                                <td><?= ucwords($alat['nama_alat']); ?></td>
                                <td><?= $alat['total_disewa']; ?> kali</td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
          <div class="col-12 text-end">
            <p>Di Print oleh : <?= $user['nama_lengkap'] ?></p>
            <p>Tanggal : <?= date('Y-m-d') ?></p>
          </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script>
        window.print();
    </script>
</body>

</html>
