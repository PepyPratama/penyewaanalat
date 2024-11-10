<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laporan Pembeliaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

    body {
        font-family: 'Poppins', sans-serif;
    }
</style>

<body>

    <div class="container-fluid">
        <h4 class="text-center text-uppercase">laporan pembelian</h4>
        <div class="row">
            <div class="col-12 mt-4">
                <table class="table table-striped table-hover table-bordered">
                    <thead>
                        <tr align="center">
                            <th scope="col">No.</th>
                            <th scope="col">Kode Pembeliaan</th>
                            <th scope="col">Nama Alat</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">Tanggal Pembelian</th>
                            <th scope="col">Jenis</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pembelian as $key => $value) : ?>
                            <tr align="center">
                                <th scope="row"><?= $key + 1; ?>.</th>
                                <td><?= $value['kode_pembelian']; ?></td>
                                <td><?= ucwords($value['nama_alat']); ?></td>
                                <td>Rp <?= number_format($value['harga_beli']); ?>,-</td>
                                <td><?= number_format($value['jumlah_pembelian']); ?></td>
                                <td><?= tanggalIndonesia($value['tanggal_pembelian']); ?></td>
                                <td><?= ucwords($value['jenis_pembelian']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>

<script>
    window.print()
</script>