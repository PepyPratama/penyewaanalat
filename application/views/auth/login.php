<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Login</title>

    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('assets/images/logo/logo-putih.png'); ?>">
    <link href="<?= base_url('assets/css/style.css'); ?>" rel="stylesheet">

</head>

<body class="h-100">
    <div class="authincation h-100">
        <div class="container-fluid h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-4">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
                                    <div class="mb-5">
                                        <div class="d-flex justify-content-center align-items-center ">
                                            <img src="<?= base_url('assets/images/logo/logo-hitam.png'); ?>" alt="Logo Hitam" class="img-fluid logo-hitam" width="50">
                                            <h1>Mezzorent</h1>
                                        </div>
                                        <h6 class="text-center pt-3">Welcome! Let's get started !</h6>
                                    </div>
                                    <?= $this->session->flashdata('pesan'); ?>
                                    <?= form_open('auth/login'); ?>
                                    <div class="form-group">
                                        <label><strong>Email</strong></label>
                                        <input type="text" class="form-control" placeholder="Masukkan email" name="email" value="<?= set_value('email'); ?>">
                                        <?= form_error('email', ' <small class="pl-2 text-danger">', '</small>') ?>
                                    </div>
                                    <div class="form-group">
                                        <label><strong>Password</strong></label>
                                        <input type="password" class="form-control" placeholder="Masukkan password" name="password">
                                        <?= form_error('password', ' <small class="pl-2 text-danger">', '</small>') ?>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-dark btn-block">Login</button>
                                    </div>
                                    <?= form_close() ?>
                                    <div class="new-account text-center mt-3">
                                        <p class="text-dark">Tidak punya akun? <a class="text-primary" href="<?= base_url('registrasi'); ?>">Daftar!</a></p>
                                        <p><a class="text-dark" href="<?= base_url('home'); ?>">Halaman utama </a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="<?= base_url('assets/vendor/global/global.min.js'); ?>"></script>
    <script src="<?= base_url('assets/js/quixnav-init.js'); ?>"></script>
    <script src="<?= base_url('assets/js/custom.min.js'); ?>"></script>

</body>

</html>