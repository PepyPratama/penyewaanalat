<!--*******************
        Preloader start
    ********************-->
<div id="preloader">
    <div class="sk-three-bounce">
        <div class="sk-child sk-bounce1"></div>
        <div class="sk-child sk-bounce2"></div>
        <div class="sk-child sk-bounce3"></div>
    </div>
</div>
<!--*******************
        Preloader end
    ********************-->


<!--**********************************
        Main wrapper start
    ***********************************-->
<div id="main-wrapper">

    <!--**********************************
        Nav header start
    ***********************************-->
    <div class="nav-header">
        <a href="<?= base_url('admin'); ?>" class="brand-logo">
            <img class="logo-abbr" src="<?= base_url('assets/images/logo/logo-putih.png'); ?> " alt="">
            <!-- <img class="logo-compact" src="<?= base_url('assets/images/logo-text.png'); ?> " alt="">
            <img class="brand-title" src="<?= base_url('assets/images/logo-text.png'); ?>" alt=""> -->
        </a>

        <div class="nav-control">
            <div class="hamburger">
                <span class="line"></span><span class="line"></span><span class="line"></span>
            </div>
        </div>
    </div>
    <!--**********************************
        Nav header end
    ***********************************-->

    <!--**********************************
        Header start
    ***********************************-->
    <div class="header">
        <div class="header-content">
            <nav class="navbar navbar-expand">
                <div class="collapse navbar-collapse justify-content-between">
                    <div class="header-left">
                        <!-- <div class="search_bar dropdown">
                            <span class="search_icon p-3 c-pointer" data-toggle="dropdown">
                                <i class="mdi mdi-magnify"></i>
                            </span>
                            <div class="dropdown-menu p-0 m-0">
                                <form>
                                    <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                                </form>
                            </div>
                        </div> -->
                    </div>
                    <ul class="navbar-nav header-right">
                        <li class="nav-item dropdown notification_dropdown">
                            <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                                <i class="mdi mdi-bell"></i>
                                <?php if (count($notifikasi) > 0) : ?>
                                    <div class="notification-badge badge badge-danger" style="margin: 2px 1px 0 0;">
                                        <?= count($notifikasi); ?>
                                    </div>
                                <?php endif; ?>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <ul class="list-unstyled">
                                    <?php foreach ($notifikasi as $notip) : ?>
                                        <li class="media dropdown-item">
                                            <span class="primary"><i class="ti-shopping-cart"></i></span>
                                            <div class="media-body">
                                                <a href="<?= base_url('admin/detail_transaksi/' . $notip['id_penyewaan']); ?>">
                                                    <p><strong><?= htmlspecialchars($notip['nama_lengkap']); ?></strong> melakukan pemesanan pada <?= tanggalIndonesia($notip['tanggal_checkout']); ?>.</p>
                                                </a>
                                            </div>
                                            <span class="notify-time"><?= date('H:i', strtotime($notip['tanggal_checkout'])); ?></span>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                                <a class="all-notification" href="<?= base_url('admin/transaksi'); ?>">See all notifications <i class="ti-arrow-right"></i></a>
                            </div>
                        </li>
                        <li class="nav-item dropdown header-profile">
                            <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                                <i class="mdi mdi-account"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="<?= base_url('admin/profile'); ?>" class="dropdown-item">
                                    <i class="icon-user"></i>
                                    <span class="ml-2">Profile </span>
                                </a>
                                <a href="<?= base_url('logout'); ?>" class="dropdown-item">
                                    <i class="icon-key"></i>
                                    <span class="ml-2">Logout </span>
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
    <!--**********************************
        Header end ti-comment-alt
    ***********************************-->