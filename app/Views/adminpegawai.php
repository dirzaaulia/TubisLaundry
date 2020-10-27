<nav class="navbar navbar-expand-lg navbar-light bg-primary">
    <div class="container">
        <a class="navbar-brand text-white"><b>Tubis Laundry</b></a>
        <button class="navbar-toggler bg-white" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>
        <?php if (session()->get('isLoggedIn')) : ?>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="<?= base_url("/dashboard") ?>">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="<?= base_url("/dashboard/pelanggan") ?>">Pelanggan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="<?= base_url("/dashboard/layanan") ?>">Layanan</a>
                    </li>
                <?php endif; ?>
                <?php if (session()->get('isLoggedIn') == 'Admin') : ?>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="<?= base_url("/dashboard/pegawai") ?>"><b>Pegawai</b></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?= session()->get('nama'); ?>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <form action="<?= base_url("/dashboard/logout") ?>" method="POST">
                                <input type="hidden" name="uri" value="<?php session()->get('id'); ?>">
                                <button type="submit" class="dropdown-item btn-block">Logout</button>
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        <?php endif; ?>
    </div>
</nav>
<div class="container" style="font-family: 'PT Sans', sans-serif;">
    <br><br>
    <div class="row">
        <?php if (session()->get('success')) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert" style="width: 100%;">
                <?= session()->get('success') ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
        <div class="card mb-3" style="width: 100%;">
            <div class="card-header bg-primary text-white inline">
                <h5 style="float: left;">Daftar Pegawai</h5>
                <!-- Button Trigger Modal -->
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalPegawaiBaru" style="float: right;">
                    + Pegawai Baru
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table text-center">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>Username</th>
                                <th>Ubah</th>
                                <th>Hapus</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($pegawai as $row => $data) : ?>
                                <?php $pegawai_id = $data['id'] ?>
                                <tr>
                                    <td scope="row"><?php echo $no++; ?></td>
                                    <td><?php echo $data['nama'] ?></td>
                                    <td><?php echo $data['username'] ?></td>
                                    <td>
                                        <a href="" type="button" class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#modalUbahPegawai<?php echo $pegawai_id; ?>">Ubah</a>
                                        <!-- Modal Ubah Pegawai -->
                                        <div class="modal fade" id="modalUbahPegawai<?php echo $pegawai_id ?>" role="dialog" style="font-family: 'PT Sans', sans-serif;">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="judulmodalUbahPegawai<?php echo $pegawai_id; ?>">Perubahan Layanan</h5>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form role="form" action="<?= base_url('/dashboard/updatepegawai') ?>" method="POST">
                                                                <input type="hidden" name="id" value="<?php echo $pegawai_id; ?>">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" name="nama" value="<?php echo $data['nama']; ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" name="username" value="<?php echo $data['username']; ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <input type="password" class="form-control" required="true" name="password" placeholder="Input Password Lama / Password Baru">
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="submit" class="btn btn-primary btn-block">Simpan Perubahan Pegawai</button>
                                                                </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="" type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#modalHapusPegawai<?php echo $pegawai_id; ?>">Hapus</a>
                                        <!-- Modal Hapus Pegawai -->
                                        <div class="modal fade" id="modalHapusPegawai<?php echo $pegawai_id ?>" role="dialog" style="font-family: 'PT Sans', sans-serif;">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="judulmodalHapusPegawai<?php echo $pegawai_id; ?>">Hapus Layanan</h5>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="alert alert-danger" role="alert">
                                                            Apakah anda yakin untuk menghapus data pegawai ini? Mohon pastikan kembali sebelum menghapus data
                                                        </div>
                                                        <form role="form" action="<?= base_url('/dashboard/deletepegawai') ?>" method="POST">
                                                                <input type="hidden" name="id" value="<?php echo $pegawai_id; ?>">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" disabled="true" value="<?php echo $data['nama']; ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" disabled="true" value="<?php echo $data['username'] ?>">
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="submit" class="btn btn-danger btn-block">Hapus Pegawai</button>
                                                                </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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

<!-- Modal Tambah Layanan Baru -->
<div class="modal fade" id="modalPegawaiBaru" tabindex="-1" role="dialog" aria-labelledby="modalPegawaiBaru" aria-hidden="true" style="font-family: 'PT Sans', sans-serif;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="judulmodalPegawaiBaru">Pegawai Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?= base_url('/dashboard/registerpegawai') ?>">
                    <div class="form-group">
                        <input type="text" class="form-control" name="nama" id="nama" aria-describedby="nama" placeholder="Nama Pegawai">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="username" id="username" placeholder="Username">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Daftarkan Pegawai</button>
                </form>
            </div>
        </div>
    </div>
</div>