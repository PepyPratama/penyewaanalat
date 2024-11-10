<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laporan Penyewaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
        }

        header {
        margin-bottom: 20px;
        }

        #logo {
            width: 140px;
            height: 160px;
        }

        #text-header {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        #text-header h2 {
            margin: 0;
            font-size: 2.5rem; /* Adjust as needed */
        }

        #logo {
            width: 140px;
            height: 160px;
        }

        #text-header {
            text-align: left;
        }

        #text-header h3 {
            margin: 0;
            text-align: center;
            font-size: 1.75rem; /* Adjusted font size */
        }

        #text-header h1 {
            margin: 0;
            text-align: center;
            font-size: 2.5rem; /* Adjusted font size */
            font-weight: bold;
        }

        #text-header h6 {
            margin: 0;
            text-align: center;
            font-size: 1rem; /* Adjusted font size */
        }

        #text-header h5 {
            margin: 0;
            text-align: center;
            font-size: 1.25rem; /* Adjusted font size */
        }

        .container {
            padding: 0 15px;
        }
    </style>
</head>

<body>

<style>
h1,h3,h5,h6{
  text-align:center;
  padding-right:200px;
}
.row{
  margin-top: 20px;
}
.logo{
  font-size:2vw;
}
.alamatlogo{
  font-size:1.5vw;
}
.kodeposlogo{
  font-size:1.7vw;
}
#tls{
 text-align:right; 
}
.alamat-tujuan{
  margin-left:50%;
}
.garis1{
  border-top:3px solid black;
  height: 2px;
  border-bottom:1px solid black;
}
#logo{
  margin: auto;
  margin-left: 30%;
  margin-right: auto;
}
#tempat-tgl{
  margin-left:120px;
}
#camat{
  text-align:center;
}
#nama-camat{
  margin-top:100px;
  text-align:center;
}

</style>
<div>
  <header>
    <div class="row">
      <div id="img" class="col-md-3">
        <img id="logo" src="<?= base_url('assets/images/logo/logo-hitam.png'); ?>" class="img-fluid" alt="" width="120" height="140">
      </div>
      <div id="text-header" class="col-md-9">
        <h3 class="logo">PT. MEZZO KREASI UTAMA</h3>
        <h6 class="alamatlogo">Jl. Puyuh Dalam II No.50, RT.02/RW.10, Telepon 08990278778</h6>
      </div>
    </div>
  </header>


    <div class="container">
    <hr class="garis1"/>
        <div class="row">
            <h4 class="text-center text-uppercase">Laporan Penyewaan</h4>
            <div class="col-12 mt-3">
                <table class="table table-striped table-hover table-bordered">
                    <thead>
                        <tr>
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
                            <tr>
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
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Nama Alat</th>
                            <th scope="col">Total Disewa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($ringkasan_alat as $key => $alat) : ?>
                            <tr>
                                <th scope="row"><?= $key + 1; ?>.</th>
                                <td><?= ucwords($alat['nama_alat']); ?></td>
                                <td><?= $alat['total_disewa']; ?> kali</td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <!-- <script>
        window.print();
    </script> -->
</body>

</html>
