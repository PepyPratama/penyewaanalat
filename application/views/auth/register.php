<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Registrasi Akun</title>

    <!-- Favicon icon -->
    <!-- <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('assets/images/favicon.png'); ?>"> -->
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
                                    <h4 class="text-center mb-4">Registrasi</h4>
                                    <?= form_open('auth/register'); ?>
                                    <div class="form-group">
                                        <label><strong>Nama Lengkap</strong></label>
                                        <input type="text" class="form-control" placeholder="Masukkan nama lengkap" name="nama_lengkap" value="<?= set_value('nama_lengkap'); ?>">
                                        <?= form_error('nama_lengkap', ' <small class="pl-2 text-danger">', '</small>') ?>
                                    </div>
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
                                    <div class="text-center mt-4">
                                        <button type="submit" class="btn btn-dark btn-block">Registrasi</button>
                                    </div>
                                    <?= form_close() ?>
                                    <div class="new-account text-center mt-3">
                                        <p class="text-dark">Sudah punya akun? <a class="text-primary" href="<?= base_url('login'); ?>">Login</a></p>
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

</body>

</html>