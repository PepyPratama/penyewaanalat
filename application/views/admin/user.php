<!--**********************************
            Content body start
        ***********************************-->
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
                                        <th>No.</th>
                                        <th>Nama Lengkap</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($user as $key => $value) : ?>
                                        <tr align="center">
                                            <td><?= $key + 1; ?>.</td>
                                            <td><?= ucwords($value['nama_lengkap']); ?></td>
                                            <td><?= ucwords($value['email']); ?></td>
                                            <td><?= ucwords($value['role']); ?></td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#edit<?= $value['id_user']; ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                </button>
                                                <a href="<?= base_url('admin/hapus_user/' . $value['id_user']); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data?')"><i class="fa fa-trash" aria-hidden="true"></i>
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
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <?= form_open('admin/tambah_user'); ?>
            <div class="modal-body">
                <div class="form-group">
                    <label for="nama_lengkap">Nama Lengkap</label>
                    <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" placeholder="Masukkan nama lengkap" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" name="email" placeholder="Masukkan email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="text" class="form-control" id="password" name="password" placeholder="Masukkan password" required>
                </div>
                <div class="form-group">
                    <label for="id_role">Role</label>
                    <select class="form-control" id="id_role" name="id_role" required>
                        <option selected disabled value="">Pilih</option>
                        <?php foreach ($role as $data) : ?>
                            <option value="<?= $data['id_role']; ?>"><?= ucwords($data['role']); ?></option>
                        <?php endforeach; ?>
                    </select>
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
<?php foreach ($user as $value) : ?>
    <div class="modal fade" id="edit<?= $value['id_user']; ?>">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <?= form_open('admin/edit_user/' . $value['id_user']) ?>
                <?= form_hidden('id_user', $value['id_user']) ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_lengkap">Nama Lengkap</label>
                        <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" placeholder="Masukkan nama lengkap" value="<?= ucwords($value['nama_lengkap']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="Masukkan email" value="<?= ucwords($value['email']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="id_role">Role</label>
                        <select class="form-control" id="id_role" name="id_role" required>
                            <option selected disabled value="">Pilih</option>
                            <?php foreach ($role as $data) : ?>
                                <option value="<?= $data['id_role']; ?>" <?= ($value['id_role'] == $data['id_role']) ? 'selected' : '' ?>><?= ucwords($data['role']); ?></option>
                            <?php endforeach; ?>
                        </select>
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