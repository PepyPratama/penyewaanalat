<div class="quixnav">
    <div class="quixnav-scroll">
        <ul class="metismenu" id="menu">
            <li class="nav-label first">Menu</li>

            <li>
                <a href="<?= base_url('admin'); ?>" aria-expanded="false"><i class="fa fa-fw fa-home" aria-hidden="true"></i>
                    <span class="nav-text pl-1">Dashboard</span></a>
            </li>

            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="fa fa-fw fa-database" aria-hidden="true"></i>
                    <span class="nav-text pl-1">Data Master</span></a>
                <ul aria-expanded="false">
                    <li><a href="<?= base_url('admin/kategori_alat'); ?>">Alat Kategori</a></li>
                    <li><a href="<?= base_url('admin/alat'); ?>">Data Alat</a></li>
                </ul>
            </li>

            <!-- <li>
                <a href="<?= base_url('admin/alat'); ?>" aria-expanded="false">
                    <i class="fa fa-video-camera" aria-hidden="true"></i>
                    <span class="nav-text pl-1">Data Alat</span></a>
            </li> -->

            <li>
                <a href="<?= base_url('admin/pembelian'); ?>" aria-expanded="false">
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                    <span class="nav-text pl-1">Data Pembelian</span></a>
            </li>

            <!-- <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="fa fa-fw fa-shopping-cart" aria-hidden="true"></i>
                    <span class="nav-text pl-1">Data Penyewaan</span></a>
                <ul aria-expanded="false">
                    <li><a href="<?= base_url('admin/penyewaan'); ?>">Penyewaan</a></li>
                    <li><a href="<?= base_url('admin/penyewaan_detail'); ?>">Penyewaan Detail</a></li>
                </ul>
            </li> -->

            <li>
                <a href="<?= base_url('admin/transaksi'); ?>" aria-expanded="false">
                    <i class="fa fa-cc-visa" aria-hidden="true"></i>
                    <span class="nav-text pl-1">Data Transaksi</span></a>
            </li>

            <!-- <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="fa fa-fw fa-money" aria-hidden="true"></i>
                    <span class="nav-text pl-1">Data Transaksi</span></a>
                <ul aria-expanded="false">
                    <li><a href="<?= base_url('admin/transaksi'); ?>">Transaksi</a></li>
                </ul>
            </li> -->

            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="fa fa-fw fa-user" aria-hidden="true"></i>
                    <span class="nav-text pl-1">Data User</span></a>
                <ul aria-expanded="false">
                    <li><a href="<?= base_url('admin/user'); ?>">User</a></li>
                    <li><a href="<?= base_url('admin/profile'); ?>">Profile</a></li>
                </ul>
            </li>

            <li>
                <a href="<?= base_url('logout'); ?>" aria-expanded="false"><i class="fa fa-fw fa-sign-out" aria-hidden="true"></i>
                    </i>
                    <span class="nav-text pl-1">Keluar</span></a>
            </li>

        </ul>
    </div>
</div>