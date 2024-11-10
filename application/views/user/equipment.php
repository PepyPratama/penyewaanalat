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