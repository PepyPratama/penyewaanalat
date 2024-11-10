<!DOCTYPE html>
<html>
<head>
    <title>Perpanjang Sewa</title>
</head>
<body>
    <div class="container">
        <h2>Perpanjang Sewa</h2>
        <form action="<?= base_url('user/proses_perpanjangan_sewa'); ?>" method="post">
            <input type="hidden" name="id_penyewaan" value="<?= $penyewaan['id_penyewaan']; ?>">
            <div class="form-group">
                <label for="tanggal_kembali">Tanggal Kembali Baru:</label>
                <input type="date" id="tanggal_kembali" name="tanggal_kembali" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Perpanjang</button>
        </form>
    </div>
</body>
</html>