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
                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#edit<?= $user['id_user']; ?>">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            Edit Profile</button>
                    </div>
                    <div class="card-body">
                        <form>
                            <fieldset disabled>
                                <div class="form-group">
                                    <label for="disabledTextInput">Nama Lengkap</label>
                                    <input type="text" id="disabledTextInput" class="form-control" placeholder="<?= ucwords($user['nama_lengkap']); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="disabledTextInput">Email</label>
                                    <input type="text" id="disabledTextInput" class="form-control" placeholder="<?= ucwords($user['email']); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="disabledTextInput">Role</label>
                                    <input type="text" id="disabledTextInput" class="form-control" placeholder="<?= ucwords($user['role']); ?>">
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL EDIT -->
<div class="modal fade" id="edit<?= $user['id_user']; ?>">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Data</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <?= form_open('admin/edit_profile') ?>
            <div class="modal-body">
                <div class="form-group">
                    <label for="nama_lengkap">Nama Lengkap</label>
                    <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" placeholder="Masukkan nama lengkap" value="<?= ucwords($user['nama_lengkap']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" name="email" placeholder="Masukkan email" value="<?= ucwords($user['email']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password baru" required>
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