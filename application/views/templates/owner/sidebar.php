<div class="quixnav">
    <div class="quixnav-scroll">
        <ul class="metismenu" id="menu">
            <li class="nav-label first">Menu</li>
            <li>
                <a href="<?= base_url('owner'); ?>" aria-expanded="false"><i class="fa fa-fw fa-home" aria-hidden="true"></i>
                    <span class="nav-text pl-1">Dashboard</span></a>
            </li>

            <li>
                <a href="<?= base_url('owner/pembelian'); ?>" aria-expanded="false">
                    <i class="fa fa-fw fa-shopping-cart" aria-hidden="true"></i>
                    <span class="nav-text pl-1">Pembelian</span></a>
            </li>

            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="fa fa-print" aria-hidden="true"></i>
                    <span class="nav-text pl-1">Laporan</span></a>
                <ul aria-expanded="false">
                    <li><a href="<?= base_url('owner/laporan_alat'); ?>">Laporan Alat</a></li>
                    <li><a href="<?= base_url('owner/laporan_alat_rusak'); ?>">Laporan Alat Rusak</a></li>
                    <li><a href="<?= base_url('owner/laporan_pembelian'); ?>">Laporan Pembelian</a></li>
                    <li><a href="<?= base_url('owner/laporan_penyewaan'); ?>">Laporan Penyewaan</a></li>
                </ul>
            </li>

            <li>
                <a href="<?= base_url('owner/profile'); ?>" aria-expanded="false">
                    <i class="fa fa-fw fa-user" aria-hidden="true"></i>
                    <span class="nav-text pl-1">Profile</span></a>
            </li>

            <li>
                <a href="<?= base_url('logout'); ?>" aria-expanded="false"><i class="fa fa-fw fa-sign-out" aria-hidden="true"></i>
                    </i>
                    <span class="nav-text pl-1">Keluar</span></a>
            </li>

        </ul>
    </div>
</div>