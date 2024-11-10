<div class="content-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <?= $this->session->flashdata('pesan'); ?>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"><?= $title; ?></h4>
                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambah"><i class="fa fa-plus" aria-hidden="true"></i>
                            Tambah</button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-responsive-sm">
                                <thead>
                                    <tr align="center">
                                        <th>Kode Pembelian</th>
                                        <th>Nama Alat</th>
                                        <th>Nama Toko</th>
                                        <th>Jumlah Pembelian</th>
                                        <th>Harga Beli</th>
                                        <th>Jenis Pembelian</th>
                                        <th>Status</th>
                                        <th width="15%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($pembelian as $key => $value) : ?>
                                        <tr align="center">
                                            <td><?= ucwords($value['kode_pembelian']); ?></td>
                                            <td><?= ucwords($value['nama_alat']); ?></td>
                                            <td><?= ucwords($value['nama_toko']); ?></td>
                                            <td><?= number_format($value['jumlah_pembelian']); ?></td>
                                            <td>Rp <?= number_format($value['harga_beli']); ?></td>
                                            <td><?= ucwords($value['jenis_pembelian']); ?></td>
                                            <td>
                                                <?php
                                                $status = [
                                                    'pending'          => 'badge-warning',
                                                    'tidak disetujui'  => 'badge-danger',
                                                    'disetujui'        => 'badge-success',
                                                ];

                                                $statusClass = isset($status[$value['status']]) ? $status[$value['status']] : '';
                                                ?>

                                                <span class="badge rounded-pill <?= $statusClass; ?> fw-normal">
                                                    <?= ucwords($value['status']); ?>
                                                </span>
                                            </td>
                                            <td>
                                                <a href="<?= base_url('admin/detail_pembelian/' . $value['id_pembelian']); ?>" class="btn btn-sm btn-secondary text-white" title="Detail">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </a>
                                                <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#edit<?= $value['id_pembelian']; ?>">
                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                </button>
                                                <!-- <a href="<?= base_url('admin/hapus_pembelian/' . $value['id_pembelian']); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data?')">
                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                </a> -->
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL TAMBAH -->
<div class="modal fade" id="tambah">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <?= form_open('admin/tambah_pembelian') ?>
            <div class="modal-body">
                <div class="form-group">
                    <label for="jenis_pembelian">Jenis Pembelian</label>
                    <select class="form-control" id="jenis_pembelian" name="jenis_pembelian" required>
                        <option selected disabled value="">Pilih</option>
                        <option value="alat baru">Alat Baru</option>
                        <option value="alat lama">Alat Lama</option>
                    </select>
                </div>

                <!-- FORM PEMBELIAN ALAT BARU -->
                <div id="form_pembelian_baru" style="display: none;">
                    <div class="form-group">
                        <label for="nama_alat_baru">Nama Alat</label>
                        <input type="text" class="form-control" id="nama_alat_baru" name="nama_alat_baru" placeholder="Masukkan nama alat" required>
                    </div>
                    <div class="form-group">
                        <label for="nama_toko_baru">Nama Toko</label>
                        <input type="text" class="form-control" id="nama_toko_baru" name="nama_toko_baru" placeholder="Masukkan nama toko" required>
                    </div>
                    <div class="form-group">
                        <label for="jumlah_pembelian_baru">Jumlah Pembelian</label>
                        <input type="number" min="1" class="form-control" id="jumlah_pembelian_baru" name="jumlah_pembelian_baru" placeholder="Masukkan jumlah" required>
                    </div>
                    <div class="form-group">
                        <label for="harga_beli_baru">Harga</label>
                        <input type="number" min="1" class="form-control" id="harga_beli_baru" name="harga_beli_baru" placeholder="Masukkan harga" required>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_pembelian_baru">Tanggal Pembelian</label>
                        <input type="date" class="form-control" id="tanggal_pembelian_baru" name="tanggal_pembelian_baru" required>
                    </div>
                </div>

                <!-- FORM PEMBELIAN ALAT LAMA -->
                <div id="form_pembelian_lama" style="display: none;">
                    <div class="form-group">
                        <label for="nama_alat_lama">Pilih Alat</label>
                        <select class="form-control" id="nama_alat_lama" name="nama_alat_lama" required>
                            <option selected disabled value="">Pilih</option>
                            <?php foreach ($alat as $data) : ?>
                                <option value="<?= $data['nama_alat']; ?>"><?= ucwords($data['nama_alat']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nama_toko_lama">Nama Toko</label>
                        <input type="text" min="1" class="form-control" id="nama_toko_lama" name="nama_toko_lama" placeholder="Masukkan toko lama" required>
                    </div>
                    <div class="form-group">
                        <label for="jumlah_pembelian_lama">Jumlah Pembelian</label>
                        <input type="number" min="1" class="form-control" id="jumlah_pembelian_lama" name="jumlah_pembelian_lama" placeholder="Masukkan jumlah" required>
                    </div>
                    <div class="form-group">
                        <label for="harga_beli_lama">Harga</label>
                        <input type="number" min="1" class="form-control" id="harga_beli_lama" name="harga_beli_lama" placeholder="Masukkan harga" required>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_pembelian_lama">Tanggal Pembelian</label>
                        <input type="date" class="form-control" id="tanggal_pembelian_lama" name="tanggal_pembelian_lama" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<!-- MODAL EDIT -->
<?php foreach ($pembelian as $value) : ?>
    <div class="modal fade" id="edit<?= $value['id_pembelian']; ?>">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <?= form_open('admin/edit_pembelian/' . $value['id_pembelian']) ?>
                <?= form_hidden('id_pembelian', $value['id_pembelian']) ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_alat">Nama Alat</label>
                        <input type="text" class="form-control" id="nama_alat" name="nama_alat" placeholder="Masukkan nama alat" value="<?= ucwords($value['nama_alat']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="nama_toko">Nama Toko</label>
                        <input type="text" class="form-control" id="nama_toko" name="nama_toko" placeholder="Masukkan nama toko" value="<?= ucwords($value['nama_toko']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="jumlah_pembelian">Jumlah Pembelian</label>
                        <input type="number" class="form-control" id="jumlah_pembelian" name="jumlah_pembelian" placeholder="Masukkan jumlah" value="<?= $value['jumlah_pembelian']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="harga_beli">Harga</label>
                        <input type="number" class="form-control" id="harga_beli" name="harga_beli" placeholder="Masukkan harga" value="<?= $value['harga_beli']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_pembelian">Tanggal Pembelian</label>
                        <input type="date" class="form-control" id="tanggal_pembelian" name="tanggal_pembelian" placeholder="Masukkan harga" value="<?= $value['tanggal_pembelian']; ?>" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
                <?= form_close() ?>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<script>
    document.getElementById('jenis_pembelian').addEventListener('change', function() {
        var formPembelianBaru = document.getElementById('form_pembelian_baru');
        var formPembelianLama = document.getElementById('form_pembelian_lama');
        var pilihan = this.value;

        var showBaru = (pilihan === 'alat baru');
        var showLama = (pilihan === 'alat lama');

        formPembelianBaru.style.display = showBaru ? 'block' : 'none';
        formPembelianLama.style.display = showLama ? 'block' : 'none';

        setRequiredAttributes(formPembelianBaru, showBaru);
        setRequiredAttributes(formPembelianLama, showLama);
    });

    function setRequiredAttributes(form, required) {
        form.querySelectorAll('input, select, textarea').forEach(field => {
            field.required = required;
        });
    }
</script>