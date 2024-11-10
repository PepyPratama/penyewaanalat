<section id="hero" class="hero" style="background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('assets/images/foto/bg.jpg');">
    <div class="container">
        <div class="row d-flex justify-content-center align-items-center vh-100">
            <div class="col-12">
                <h1 class="text-center">Mezzorent Kamera</h1>
            </div>
        </div>
    </div>
</section>


<section id="equipment" style="padding: 150px 0;">
    <div class="container">
        <h3 class="text-center text-uppercase">equipment</h3>
        <div class="row mt-5">
            <div class="col-12">

                <!-- Kategori -->
                <ul class="nav nav-pills mb-3 justify-content-center" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="btn btn-warning active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#semua" type="button" role="tab" aria-controls="semua" aria-selected="true">Semua</button>
                    </li>
                    <?php foreach ($kategori as $kat) :
                        $kategori_id = strtolower(str_replace(' ', '_', $kat['nama_kategori']));
                    ?>
                        <li class="nav-item" role="presentation">
                            <button class="btn text-dark" id="pills-<?= $kategori_id; ?>-tab" data-bs-toggle="pill" data-bs-target="#pills-<?= $kategori_id; ?>" type="button" role="tab" aria-controls="pills-<?= $kategori_id; ?>" aria-selected="false"><?= ucwords($kat['nama_kategori']); ?></button>
                        </li>
                    <?php endforeach; ?>
                </ul>

                <!-- Konten -->
                <div class="tab-content mt-5" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="semua" role="tabpanel" aria-labelledby="pills-home-tab">
                        <div class="row px-3 px-md-0">
                            <?php foreach ($alat as $data) : ?>
                                <div class="col-12 col-md-3 mb-3">
                                    <a href="<?= base_url('detail/' . $data['id_alat']); ?>" class="text-decoration-none text-dark">
                                        <div class="card shadow-sm" style="height: 100%;">
                                            <img src=" <?= base_url('assets/images/upload_alat/' . $data['foto']); ?>" class="card-img-top" alt="..." style="width: 100%; height: 100%; object-fit: cover;">
                                            <div class="card-body" style="flex-grow: 1; display: flex; flex-direction: column; justify-content: space-between;">
                                                <h6 class="card-title">
                                                    <?php
                                                    $nama_alat = ucwords($data['nama_alat']);
                                                    echo (strlen($nama_alat) > 20) ? substr($nama_alat, 0, 20) . '...' : $nama_alat;
                                                    ?>
                                                </h6>
                                                <div class="d-flex justify-content-between align-items-center mt-2">
                                                    <p class="card-text">Rp. <span class="fs-3"><?= number_format($data['harga_sewa']); ?></span></p>
                                                    <a href="<?= base_url('detail/' . $data['id_alat']); ?>" class="btn btn-warning">
                                                        <i class="bi bi-cart3"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <?php foreach ($kategori as $kat) :
                        $kategori_id = strtolower(str_replace(' ', '_', $kat['nama_kategori']));
                    ?>
                        <div class="tab-pane fade" id="pills-<?= $kategori_id; ?>" role="tabpanel" aria-labelledby="pills-<?= $kategori_id; ?>-tab">
                            <div class="row px-3 px-md-0">
                                <?php
                                // Filter $alat berdasarkan kategori
                                $alat_kategori = array_filter($alat, function ($item) use ($kat) {
                                    return $item['nama_kategori'] == $kat['nama_kategori'];
                                });

                                foreach ($alat_kategori as $data) :
                                ?>

                                    <div class="col-12 col-md-3 mb-3">
                                        <a href="<?= base_url('detail/' . $data['id_alat']); ?>" class="text-decoration-none text-dark">
                                            <div class="card shadow-sm" style="height: 100%;">
                                                <img src=" <?= base_url('assets/images/upload_alat/' . $data['foto']); ?>" class="card-img-top" alt="..." style="width: 100%; height: 100%; object-fit: cover;">
                                                <div class="card-body" style="flex-grow: 1; display: flex; flex-direction: column; justify-content: space-between;">
                                                    <h6 class="card-title">
                                                        <?php
                                                        $nama_alat = ucwords($data['nama_alat']);
                                                        echo (strlen($nama_alat) > 20) ? substr($nama_alat, 0, 20) . '...' : $nama_alat;
                                                        ?>
                                                    </h6>
                                                    <div class="d-flex justify-content-between align-items-center mt-2">
                                                        <p class="card-text">Rp. <span class="fs-3"><?= number_format($data['harga_sewa']); ?></span></p>
                                                        <a href="<?= base_url('detail/' . $data['id_alat']); ?>" class="btn btn-warning">
                                                            <i class="bi bi-cart3"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="tentang" class="tentang" style="padding: 150px 0;">
    <div class="container">
        <h3 class="text-center text-uppercase">tentang kami</h3>
        <div class="row d-flex justify-content-center align-items-center mt-5">
            <div class="col-12 col-lg-6 d-flex align-items-center">
                <img src="<?= base_url('assets/images/logo/logo-hitam.png'); ?>" class="img-fluid" alt="">
            </div>
            <div class="col-12 col-lg-6 mt-4 mt-md-0 d-flex align-items-center">
                <div>
                    <p>Didirikan dengan semangat untuk mendukung para kreator, kami adalah penyedia layanan penyewaan alat fotografi yang siap memenuhi 
                        kebutuhan Anda. Dengan beragam pilihan peralatan profesional, mulai dari kamera, lensa, hingga pencahayaan, kami hadir untuk membantu 
                        Anda menangkap momen terbaik dalam setiap proyek kreatif. Kami berkomitmen memberikan layanan berkualitas tinggi, 
                        didukung dengan peralatan yang terawat dan tim yang siap membantu Anda mendapatkan hasil terbaik.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="kontak" style="padding: 150px 0px;">
    <div class="textkontak" style="padding-bottom: 100px;">
    <h2 class="text-center text-uppercase fw-semibold">kontak</h2>
    </div>
    <div class="container">
        <div class="row d-flex justify-content-center align-items-stretch">
        <div class="col-12 col-md-6 d-flex align-items-stretch">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1980.1887129919876!2d107.61656685101996!3d-6.877084269313946!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e7c5db434f09%3A0x293aaebbc83d1b69!2sJl.%20Puyuh%20Dalam%20II%20No.50%2C%20RT.02%2FRW.10%2C%20Sadang%20Serang%2C%20Kec.%20Coblong%2C%20Kota%20Bandung%2C%20Jawa%20Barat%2040133!5e0!3m2!1sen!2sid!4v1697626349442!5m2!1sen!2sid"
                width="100%"
                height="100%"
                style="border:0;"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
            <div class="col-12 col-md-6 d-flex align-items-stretch">
                <div class="card shadow-sm w-100">
                    <div class="card-body">
                        <h1 class="text-hijau text-uppercase fw-bolder">Mezzorent <span class="text-cream-tua">Kamera</span></h1>
                        <ul class="list-unstyled d-flex flex-column gap-2 mt-5">
                            <li class="">
                                <a href="https://maps.app.goo.gl/dvwm7Gjx9tQe3rxw6" target="_blank" class="text-black fs-6 d-flex align-item-start gap-3"><i class="bi bi-geo-alt-fill fs-3"></i> Jl. Puyuh Dalam II No.50, RT.02/RW.10, Sadang Serang, Kecamatan Coblong, Kota Bandung, Jawa Barat 40133</a>
                            </li>
                            <li class="">
                                <a href="https://www.instagram.com/mezzorentalkamera/" target="_blank" class="text-black fs-6 d-flex align-items-center gap-3">
                                    <i class="bi bi-instagram fs-3"></i> mezzorentalkamera
                                </a>
                            </li>
                            <li class="">
                                <a href="https://api.whatsapp.com/send?phone=628990278778" target="_blank" class="text-black fs-6 d-flex align-items-center gap-3">
                                    <i class="bi bi-whatsapp fs-3"></i> +62 899-0278-778
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        $('#equipment .nav .btn').on('click', function() {
            $('#equipment .nav .btn').removeClass('active btn-warning text-dark').addClass('text-dark');
            $(this).addClass('active btn-warning').removeClass('text-dark');
        });
    });
</script>