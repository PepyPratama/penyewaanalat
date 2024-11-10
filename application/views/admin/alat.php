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
                                        <th width="5%">No.</th>
                                        <th width="10%">No Seri</th>
                                        <th>Nama Alat</th>
                                        <th width="10%">Harga Sewa</th>
                                        <th>Stok Keseluruhan</th>
                                        <th>Stok Tersedia</th>
                                        <th>Stok Rusak</th>
                                        <th>Stok Disewa</th>
                                        <th>Spesifikasi</th>
                                        <th>Foto</th>
                                        <th width="15%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($alat as $key => $value) : ?>
                                        <tr align="center">
                                            <td><?= $key + 1; ?>.</td>
                                            <td><?= ucwords($value['no_seri']); ?></td>
                                            <td><?= ucwords($value['nama_alat']); ?></td>
                                            <td>Rp <?= number_format($value['harga_sewa']); ?></td>
                                            <td><?= number_format(max(0, $value['stok_keseluruhan'])); ?></td>
                                            <td><?= number_format(max(0, $value['stok_tersedia'])); ?></td>
                                            <td><?= number_format(max(0, $value['stok_rusak'])); ?></td>
                                            <td><?= number_format(max(0, $value['stok_disewa'])); ?></td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#spesifikasi<?= $value['id_alat']; ?>">
                                                    <i class="fa fa-cog" aria-hidden="true"></i>
                                                </button>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#foto<?= $value['id_alat']; ?>">
                                                    <i class="fa fa-picture-o" aria-hidden="true"></i>
                                                </button>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#detail<?= $value['id_alat']; ?>">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </button>
                                                <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#edit<?= $value['id_alat']; ?>">
                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                </button>
                                                <a href="<?= base_url('admin/hapus_alat/' . $value['id_alat']); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data?')">
                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                </a>
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
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <?= form_open_multipart('admin/tambah_alat') ?>
            <div class="modal-body">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="id_pembelian">Nama Alat</label>
                            <select class="form-control" id="id_pembelian" name="id_pembelian" required>
                                <option selected disabled value="">Pilih</option>
                                <?php foreach ($pembelian as $data) : ?>
                                    <option value="<?= $data['id_pembelian']; ?>"><?= ucwords($data['nama_alat']); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="id_kategori_alat">Kategori</label>
                            <select class="form-control" id="id_kategori_alat" name="id_kategori_alat" required>
                                <option selected disabled value="">Pilih</option>
                                <?php foreach ($kategori as $data) : ?>
                                    <option value="<?= $data['id_kategori_alat']; ?>"><?= ucwords($data['nama_kategori']); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="no_seri">No Seri</label>
                            <input type="text" class="form-control" id="no_seri" name="no_seri" placeholder="Masukkan nomor seri" required>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="harga_sewa">Harga Sewa</label>
                            <input type="number" min="1" class="form-control" id="harga_sewa" name="harga_sewa" placeholder="Masukkan harga sewa" required>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="foto">Foto</label>
                            <input type="file" class="form-control-file" id="foto" name="foto" required>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="spesifikasi">Spesifikasi</label>
                            <textarea class="form-control" id="spesifikasi" name="spesifikasi" rows="3" placeholder="Masukkan spesifikasi" required></textarea>
                        </div>
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

<?php foreach ($alat as $value) : ?>
    <!-- MODAL SPESIFIKASI -->
    <div class="modal fade" id="spesifikasi<?= $value['id_alat']; ?>">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?= ucwords($value['nama_alat']); ?></h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php
                    $spesifikasi = ucwords($value['spesifikasi']);
                    $spesifikasi_dengan_br = nl2br($spesifikasi);
                    $counter = 0;
                    $spesifikasi_bernomor = preg_replace_callback(
                        '/(.+?)(<br\s*\/?>\s*|$)/i',
                        function ($matches) use (&$counter) {
                            $counter++;
                            return $counter . '. ' . $matches[1] . $matches[2];
                        },
                        $spesifikasi_dengan_br
                    );
                    echo $spesifikasi_bernomor;
                    ?>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL FOTO -->
    <div class="modal fade" id="foto<?= $value['id_alat']; ?>">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?= ucwords($value['nama_alat']); ?></h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img src="<?= base_url('assets/images/upload_alat/' . $value['foto']); ?>" style=" width: 100%; height: 450px; object-fit: contain;">
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL EDIT -->
    <div class="modal fade" id="edit<?= $value['id_alat']; ?>">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <?= form_open_multipart('admin/edit_alat/' . $value['id_alat']) ?>
                <?= form_hidden('id_alat', $value['id_alat']) ?>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="id_pembelian">Nama Alat</label>
                                <select class="form-control" id="id_pembelian" name="id_pembelian" required>
                                    <option selected disabled value="">Pilih</option>
                                    <?php foreach ($pembelian as $data) : ?>
                                        <option value="<?= $data['id_pembelian']; ?>" <?= ($value['id_pembelian'] == $data['id_pembelian']) ? 'selected' : '' ?>><?= ucwords($data['nama_alat']); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="id_kategori_alat">Kategori</label>
                                <select class="form-control" id="id_kategori_alat" name="id_kategori_alat" required>
                                    <option selected disabled value="">Pilih</option>
                                    <?php foreach ($kategori as $data) : ?>
                                        <option value="<?= $data['id_kategori_alat']; ?>" <?= ($value['id_kategori_alat'] == $data['id_kategori_alat']) ? 'selected' : '' ?>><?= ucwords($data['nama_kategori']); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="no_seri">No Seri</label>
                                <input type="text" class="form-control" id="no_seri" name="no_seri" placeholder="Masukkan no seri" value="<?= $value['no_seri']; ?>" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="harga_sewa">Harga Sewa</label>
                                <input type="number" min="0" class="form-control" id="harga_sewa" name="harga_sewa" placeholder="Masukkan harga sewa" value="<?= $value['harga_sewa']; ?>" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="stok_keseluruhan">Stok Keseluruhan</label>
                                <input type="number" min="0" class="form-control" id="stok_keseluruhan" name="stok_keseluruhan" placeholder="Masukkan stok keseluruhan" value="<?= $value['stok_keseluruhan']; ?>" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="stok_rusak">Stok Rusak</label>
                                <input type="number" min="0" class="form-control" id="stok_rusak" name="stok_rusak" placeholder="Masukkan stok rusak" value="<?= $value['stok_rusak']; ?>" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="foto">Foto</label>
                                <input type="file" class="form-control-file" id="foto" name="foto">
                                <small class="form-text text-muted">*Biarkan kosong jika tidak ingin mengubah foto.</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="spesifikasi">Spesifikasi</label>
                                <textarea class="form-control" id="spesifikasi" name="spesifikasi" rows="5" placeholder="Masukkan spesifikasi" required><?= ucwords($value['spesifikasi']); ?></textarea>
                            </div>
                        </div>
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

    <!-- MODAL DETAIL -->
    <div class="modal fade" id="detail<?= $value['id_alat']; ?>">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Data</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <fieldset disabled>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="id_pembelian">Nama Alat</label>
                                    <input type="text" class="form-control" id="id_pembelian" name="id_pembelian" value="<?= $value['nama_alat']; ?>" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="id_kategori_alat">Kategori Alat</label>
                                    <input type="text" class="form-control" id="id_kategori_alat" name="id_kategori_alat" value="<?= $value['nama_kategori']; ?>" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="no_seri">No Seri</label>
                                    <input type="text" class="form-control" id="no_seri" name="no_seri" value="<?= $value['no_seri']; ?>" required>
                                </div>
                            </div>
                            <!-- <div class="col-6">
                                <div class="form-group">
                                    <label for="jumlah_alat">Jumlah</label>
                                    <input type="number" class="form-control" id="jumlah_alat" name="jumlah_alat" value="<?= $value['jumlah_alat']; ?>" required>
                                </div>
                            </div> -->
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="harga_sewa">Harga Sewa</label>
                                    <input type="number" min="1" class="form-control" id="harga_sewa" name="harga_sewa" value="<?= $value['harga_sewa']; ?>" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="stok_keseluruhan">Stok Keseluruhan</label>
                                    <input type="number" min="0" class="form-control" id="stok_keseluruhan" name="stok_keseluruhan" value="<?= $value['stok_keseluruhan']; ?>" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="stok_rusak">Stok Rusak</label>
                                    <input type="number" min="0" class="form-control" id="stok_rusak" name="stok_rusak" value="<?= $value['stok_rusak']; ?>" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="stok_tersedia">Stok Tersedia</label>
                                    <input type="number" min="0" class="form-control" id="stok_tersedia" name="stok_tersedia" value="<?= $value['stok_tersedia']; ?>" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="stok_disewa">Stok Disewa</label>
                                    <input type="number" min="0" class="form-control" id="stok_disewa" name="stok_disewa" value="<?= $value['stok_disewa']; ?>" required>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                </div>
                </fieldset>
            </div>
        </div>
    </div>
<?php endforeach; ?>