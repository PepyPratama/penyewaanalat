<div class="container" style="padding: 100px 0;">
    <div class="row">
        <h2 class="text-capitalize">pembayaran</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('home'); ?>" class="text-decoration-none">Beranda</a></li>
                <li class="breadcrumb-item active" aria-current="page">Pembayaran</li>
            </ol>
        </nav>

        <?= $this->session->flashdata('pesan'); ?>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <!-- RINCIAN PENYEWAAN -->
        <h5 class="text-capitalize">rincian penyewaan</h5>
                    <hr>
                    <table class="table table-striped">
                        <thead>
                            <tr align="center">
                                <th width="10%">Foto</th>
                                <th>No Seri</th>
                                <th>Nama Alat</th>
                                <th>Tanggal Sewa</th>
                                <th>Jumlah Hari</th>
                                <th>Spesifikasi</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $total_semua = 0;

                            foreach ($penyewaan as $key => $value) :
                                // Hitung jumlah hari sewa
                                $tanggal_sewa       = new DateTime($value['tanggal_sewa']);
                                $tanggal_kembali    = new DateTime($value['tanggal_kembali']);
                                
                                // Calculate the difference in days
                                $interval           = $tanggal_sewa->diff($tanggal_kembali);
                                $jumlah_hari        = ($tanggal_sewa == $tanggal_kembali) ? 1 : ($interval->days + 1); // If the dates are the same, set jumlah_hari to 1

                                // Hitung total biaya sewa untuk item ini
                                $total_biaya_item = $value['harga_sewa'] * $value['jumlah'] * $jumlah_hari;
                                $total_semua += $total_biaya_item; // Tambahkan total biaya item ini ke total keseluruhan
                            ?>
                                <tr align="center">
                                    <th>
                                        <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#foto<?= $value['id_alat']; ?>" title="foto">
                                            <i class="bi bi-image"></i>
                                        </button>
                                    </th>
                                    <td><?= strtoupper($value['no_seri']); ?></td>
                                    <td><?= ucwords($value['nama_alat']); ?></td>
                                    <td><?= tanggalIndonesia($value['tanggal_sewa']) . ' - ' . tanggalIndonesia($value['tanggal_kembali']); ?></td>
                                    <td><?= $jumlah_hari . ''; ?></td>
                                    <th>
                                        <button type="button" class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#spesifikasi<?= $value['id_alat']; ?>" title="Spesifikasi">
                                            <i class="bi bi-eye-fill"></i>
                                        </button>
                                    </th>
                                    <td><?= number_format($value['jumlah']); ?></td>
                                    <td>Rp. <?= number_format($value['harga_sewa']); ?>/Hari</td>
                                    <td>Rp. <?= number_format($total_biaya_item); ?></td>
                                </tr>
                            <?php
                            endforeach;
                            ?>
                            <tr align="center">
                                <th colspan="8">Sub Total</th>
                                <td>Rp. <?= number_format($total_semua); ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-12 text-center mt-3">

                <!-- METODE TRANSFER OPSI LUNAS -->
                <?php if ($value['metode_pembayaran'] == 'transfer' && $value['opsi_pembayaran'] == 'lunas') : ?>
                    <?php if (empty($bukti_transfer_lunas) && $value['status_pembayaran'] != 'ditolak') : ?>
                        <h5 class="fw-semibold text-capitalize">Batas waktu untuk melakukan pembayaran:</h5>
                        <div id="countdown-timer" class="mt-5">
                            <div class="timer-unit" id="hours">00</div>
                            <div class="separator">:</div>
                            <div class="timer-unit" id="minutes">00</div>
                            <div class="separator">:</div>
                            <div class="timer-unit" id="seconds">00</div>
                        </div>
                    <?php endif; ?>
                    <?php if ($value['status_pembayaran'] == 'ditolak') : ?>
                        <div class="alert alert-danger d-flex align-items-center" role="alert" style="border-radius: 0.5rem; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                            <svg xmlns="http://www.w3.org/2000/svg" style="width: 24px; height: 24px; margin-right: 10px;" fill="currentColor" class="bi bi-exclamation-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zM8 4a.905.905 0 0 1 1 .905v4.19a.905.905 0 1 1-2 0v-4.19A.905.905 0 0 1 8 4zm0 8a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                            </svg>
                            <div>
                                <strong>Pembayaran ditolak!</strong> <?= $value['keterangan_ditolak']; ?>.
                            </div>
                        </div>
                    <?php endif; ?>
                    <p class="fw-semibold my-5">Untuk melakukan proses penyewaan Anda, silahkan melakukan pembayaran <br> dengan cara Transfer ke nomor rekening dibawah ini :</p>
                    <div class="row d-flex justify-content-center align-items-center mt-5">
                        <div class="col-12 col-md-6 pt-1">
                            <img src="<?= base_url('assets/images/logo/Bank-BCA.png'); ?>" alt="" class="img-fluid" width="300">
                            <p class="fw-medium mt-3">7772934974 a/n PT KREASI MEZZO UTAMA</p>
                        </div>
                    </div>
                    <div class="my-5">
                        <p>Jumlah yang harus Anda bayar sebesar :</p>
                        <h4 class="fw-semibold">Rp <?= number_format($value['sub_total']); ?>,-</h4>
                    </div>
                    <div class="row d-flex justify-content-center">
                        <div class="col-12 col-md-6">
                            <?= form_open_multipart('user/transfer_lunas') ?>
                            <?= form_hidden('id_penyewaan', $value['id_penyewaan']) ?>
                            <?= form_hidden('id_transaksi', $id_transaksi) ?>
                            <div class="mb-3">
                                <label for="bukti_transfer_lunas" class="form-label">Silahkan upload bukti pembayaran dibawah ini :</label>
                                <input class="form-control" type="file" id="bukti_transfer_lunas" name="bukti_transfer_lunas" required>
                            </div>
                            <div class="d-grid gap-2 mt-4">
                                <button class="btn btn-warning shadow-sm">
                                    <?= empty($bukti_transfer_lunas) ? 'Upload Bukti' : 'Upload Ulang Bukti' ?>
                                </button>
                                <a href="<?= base_url('transaksi'); ?>" class="btn btn-dark">Nanti</a>
                                <?php if (!empty($bukti_transfer_lunas)) : ?>
                                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#bukti_lunas">Lihat Bukti Transfer
                                    </button>
                                <?php endif; ?>
                            </div>
                            <?= form_close() ?>
                        </div>
                    </div>

                    <!-- METODE TRANSFER OPSI DP -->
                <?php elseif ($value['metode_pembayaran'] == 'transfer' && $value['opsi_pembayaran'] == 'dp') : ?>
                    <?php if (empty($bukti_transfer_dp_awal) && $value['status_pembayaran'] != 'ditolak') : ?>
                        <h5 class="fw-semibold text-capitalize">Batas waktu untuk melakukan pembayaran:</h5>
                        <div id="countdown-timer" class="mt-5">
                            <div class="timer-unit" id="hours">00</div>
                            <div class="separator">:</div>
                            <div class="timer-unit" id="minutes">00</div>
                            <div class="separator">:</div>
                            <div class="timer-unit" id="seconds">00</div>
                        </div>
                    <?php endif; ?>
                    <?php if ($value['status_pembayaran'] == 'ditolak') : ?>
                        <div class="alert alert-danger d-flex align-items-center" role="alert" style="border-radius: 0.5rem; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                            <svg xmlns="http://www.w3.org/2000/svg" style="width: 24px; height: 24px; margin-right: 10px;" fill="currentColor" class="bi bi-exclamation-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zM8 4a.905.905 0 0 1 1 .905v4.19a.905.905 0 1 1-2 0v-4.19A.905.905 0 0 1 8 4zm0 8a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                            </svg>
                            <div>
                                <strong>Pembayaran ditolak!</strong> <?= $value['keterangan_ditolak']; ?>.
                            </div>
                        </div>
                    <?php endif; ?>
                    <p class="fw-semibold my-5">Untuk melakukan proses penyewaan Anda, silahkan melakukan pembayaran <br> dengan cara Transfer ke nomor rekening dibawah ini :</p>
                    <div class="row d-flex justify-content-center align-items-center mt-5">
                        <div class="col-12 col-md-6 pt-1">
                            <img src="<?= base_url('assets/images/logo/Bank-BCA.png'); ?>" alt="" class="img-fluid" width="300">
                            <p class="fw-medium mt-3">7772934974 a/n PT KREASI MEZZO UTAMA</p>
                        </div>
                    </div>
                    <div class="my-5">
                        <?php if ($value['status_pembayaran'] != 'diterima') : ?>
                            <p>Jumlah DP Awal yang harus Anda bayar sebesar :</p>
                            <h4 class="fw-semibold">Rp <?= number_format($value['sub_total'] / 2); ?>,-</h4>
                        <?php endif; ?>
                    </div>
                    <div class="row d-flex justify-content-center">
                        <div class="col-12 col-md-6">
                            <?php if ($value['status_pembayaran'] != 'diterima') : ?>
                                <?= form_open_multipart('user/transfer_dp_awal') ?>
                                <?= form_hidden('id_penyewaan', $value['id_penyewaan']) ?>
                                <?= form_hidden('id_transaksi', $id_transaksi) ?>
                                <div class="mb-3">
                                    <label for="bukti_transfer_dp_awal" class="form-label">Silahkan upload bukti DP awal dibawah ini :</label>
                                    <input class="form-control" type="file" id="bukti_transfer_dp_awal" name="bukti_transfer_dp_awal" required>
                                </div>
                                <div class="d-grid gap-2 mt-4">
                                    <button class="btn btn-warning shadow-sm">
                                        <?= empty($bukti_transfer_dp_awal) ? 'Upload Bukti DP Awal' : 'Upload Ulang Bukti DP Awal' ?>
                                    </button>
                                    <?php if (!empty($bukti_transfer_dp_awal)) : ?>
                                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#bukti_dp_awal">Lihat Bukti DP Awal</button>
                                    <?php endif; ?>
                                    <a href="<?= base_url('transaksi'); ?>" class="btn btn-dark">Nanti</a>
                                </div>
                                <?= form_close() ?>
                            <?php endif; ?>
                            <?php if (!empty($bukti_transfer_dp_awal) && $value['status_pembayaran'] == 'diterima') : ?>
                                <div class="my-5">
                                    <p>Jumlah Pelunasan yang harus Anda bayar sebesar :</p>
                                    <h4 class="fw-semibold">Rp <?= number_format($value['sub_total'] / 2); ?>,-</h4>
                                </div>
                                <?= form_open_multipart('user/transfer_dp_akhir') ?>
                                <?= form_hidden('id_penyewaan', $value['id_penyewaan']) ?>
                                <?= form_hidden('id_transaksi', $id_transaksi) ?>
                                <div class="mt-5">
                                    <div class="mb-3">
                                        <label for="bukti_transfer_dp_akhir" class="form-label">Silahkan upload bukti pelunasan dibawah ini :</label>
                                        <input class="form-control" type="file" id="bukti_transfer_dp_akhir" name="bukti_transfer_dp_akhir" required>
                                    </div>
                                    <div class="d-grid gap-2 mt-4">
                                        <button class="btn btn-warning shadow-sm">Upload Bukti Pelunasan</button>
                                        <?php if (!empty($bukti_transfer_dp_akhir)) : ?>
                                            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#bukti_dp_akhir">Lihat Bukti Pelunasan</button>
                                        <?php endif; ?>
                                        <a href="<?= base_url('transaksi'); ?>" class="btn btn-dark">Nanti</a>
                                    </div>
                                </div>
                                <?= form_close() ?>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- METODE CASH OPSI LUNAS -->
                <?php elseif ($value['metode_pembayaran'] == 'cash' && $value['opsi_pembayaran'] == 'lunas') : ?>
                    <?php if ($value['status_pembayaran'] == 'belum dibayar') : ?>
                        <!-- <h5 class="fw-semibold text-capitalize">Batas waktu untuk melakukan pembayaran:</h5>
                        <div id="countdown-timer" class="mt-5">
                            <div class="timer-unit" id="hours">00</div>
                            <div class="separator">:</div>
                            <div class="timer-unit" id="minutes">00</div>
                            <div class="separator">:</div>
                            <div class="timer-unit" id="seconds">00</div>
                        </div> -->
                        <p class="fw-semibold my-5">Untuk melakukan proses penyewaan Anda, silahkan melakukan pembayaran <br> dengan cara datang langsung ke Toko kami.</p>
                        <h5 class="fw-semibold">Pada Tanggal: <?= tanggalIndonesia($value['tanggal_sewa']); ?></h5>
                        <div class="my-5">
                            <p>Jumlah yang harus Anda bayar sebesar :</p>
                            <h4 class="fw-semibold">Rp <?= number_format($value['sub_total']); ?>,-</h4>
                        </div>
                        <div>
                            <a href="<?= base_url('transaksi'); ?>" class="btn btn-warning shadow-sm">Cek Status Pembayaran</a>
                        </div>
                    <?php endif; ?>

                    <!-- METODE CASH OPSI DP -->
                <?php elseif ($value['metode_pembayaran'] == 'cash' && $value['opsi_pembayaran'] == 'dp') : ?>
                    <?php if ($value['status_pembayaran'] == 'belum dibayar') : ?>
                        <!-- <h5 class="fw-semibold text-capitalize">Batas waktu untuk melakukan pembayaran:</h5>
                        <div id="countdown-timer" class="mt-5">
                            <div class="timer-unit" id="hours">00</div>
                            <div class="separator">:</div>
                            <div class="timer-unit" id="minutes">00</div>
                            <div class="separator">:</div>
                            <div class="timer-unit" id="seconds">00</div>
                        </div> -->
                        <p class="fw-semibold my-5">Untuk melakukan proses penyewaan Anda, silahkan melakukan pembayaran <br> dengan cara datang langsung ke Toko kami.</p>
                        <h5 class="fw-semibold">Pada Tanggal: <?= tanggalIndonesia($value['tanggal_sewa']); ?></h5>
                        <div class="my-5">
                            <p>Jumlah DP Awal yang harus Anda bayar sebesar :</p>
                            <h4 class="fw-semibold">Rp <?= number_format($value['sub_total'] / 2); ?>,-</h4>
                        </div>
                        <div>
                            <a href="<?= base_url('transaksi'); ?>" class="btn btn-warning shadow-sm">Cek Status Pembayaran</a>
                        </div>
                    <?php elseif ($value['status_pembayaran'] == 'diterima') : ?>
                        <p class="fw-semibold my-5">Untuk melakukan proses penyewaan Anda, silahkan melakukan pembayaran <br> dengan cara datang langsung ke Toko kami.</p>
                        <h5 class="fw-semibold">Pada Tanggal: <?= tanggalIndonesia($value['tanggal_sewa']); ?></h5>
                        <div class="my-5">
                            <p>Jumlah Pelunasan yang harus Anda bayar sebesar :</p>
                            <h4 class="fw-semibold">Rp <?= number_format($value['sub_total'] / 2); ?>,-</h4>
                        </div>
                        <div>
                            <a href="<?= base_url('transaksi'); ?>" class="btn btn-warning shadow-sm">Cek Status Pembayaran</a>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
        </div>
    </div>
</div>

<!-- MODAL LIHAT BUKTI TRANSFER LUNAS -->
<div class="modal fade" id="bukti_lunas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Bukti Transfer Lunas</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img src="<?= base_url('assets/images/bukti_transfer/lunas/' . $bukti_transfer_lunas); ?>" alt="" class="img-fluid" style=" width: 100%; height: 450px; object-fit: contain;">
            </div>
        </div>
    </div>
</div>

<!-- MODAL LIHAT BUKTI DP AWAL -->
<div class="modal fade" id="bukti_dp_awal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Bukti Transfer DP Awal</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img src="<?= base_url('assets/images/bukti_transfer/dp_awal/' . $bukti_transfer_dp_awal); ?>" alt="" class="img-fluid" style=" width: 100%; height: 450px; object-fit: contain;">
            </div>
        </div>
    </div>
</div>

<!-- MODAL LIHAT BUKTI DP AKHIR -->
<div class="modal fade" id="bukti_dp_akhir" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Bukti Transfer DP Akhir</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img src="<?= base_url('assets/images/bukti_transfer/dp_akhir/' . $bukti_transfer_dp_akhir); ?>" alt="" class="img-fluid" style=" width: 100%; height: 450px; object-fit: contain;">
            </div>
        </div>
    </div>
</div>

<style>
    #countdown-timer {
        font-family: 'Orbitron', sans-serif;
        font-size: 4em;
        text-align: center;
        background-color: #000;
        color: #00bcd4;
        padding: 20px;
        border-radius: 15px;
        display: flex;
        justify-content: center;
        align-items: center;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.6);
        margin: 20px auto;
        position: relative;
        overflow: hidden;
        max-width: 500px;
        width: 100%;
    }

    .timer-unit {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100px;
        height: 100px;
        padding: 10px;
        background: #111;
        color: #00bcd4;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.7);
        margin: 0 10px;
        position: relative;
        font-size: 1em;
    }

    .separator {
        color: #00bcd4;
        font-size: 1.5em;
        line-height: 100px;
        margin: 0 10px;
    }

    #countdown-timer:before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(0, 188, 212, 0.3) 0%, rgba(0, 188, 212, 0) 70%);
        transform: translate(-50%, -50%);
        pointer-events: none;
        z-index: 1;
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0% {
            opacity: 0.3;
        }

        50% {
            opacity: 0.6;
        }

        100% {
            opacity: 0.3;
        }
    }

    @import url('https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&display=swap');
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var hoursElement = document.getElementById('hours');
        var minutesElement = document.getElementById('minutes');
        var secondsElement = document.getElementById('seconds');
        var batasWaktuUpload = new Date('<?= date('Y-m-d H:i:s', strtotime($batas_waktu_upload = $value['batas_waktu_upload'])); ?>').getTime();

        function updateCountdown() {
            var now = new Date().getTime();
            var distance = batasWaktuUpload - now;

            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            hoursElement.textContent = hours.toString().padStart(2, '0');
            minutesElement.textContent = minutes.toString().padStart(2, '0');
            secondsElement.textContent = seconds.toString().padStart(2, '0');

            if (distance < 0) {
                clearInterval(x);
                hoursElement.textContent = '00';
                minutesElement.textContent = '00';
                secondsElement.textContent = '00';
                changePaymentStatus();
            }
        }

        function changePaymentStatus() {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '<?= base_url("user/pembatalan_otomatis"); ?>', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                    alert('Batas waktu untuk melakukan pembayaran telah berakhir. Silakan lakukan checkout kembali.');
                    window.location.href = '<?= base_url("user/transaksi"); ?>';
                }
            };
            xhr.send('id_penyewaan=<?= $value['id_penyewaan']; ?>');
        }

        var x = setInterval(updateCountdown, 1000);
        updateCountdown();
    });
</script>