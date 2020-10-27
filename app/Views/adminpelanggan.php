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
                        <a class="nav-link text-white" href="<?= base_url("/dashboard/pelanggan") ?>"><b>Pelanggan</b></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="<?= base_url("/dashboard/layanan") ?>">Layanan</a>
                    </li>
                <?php endif; ?>
                <?php if (session()->get('isLoggedIn') == 'Admin') : ?>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="<?= base_url("/dashboard/pegawai") ?>">Pegawai</a>
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
                <h5 style="float: left;">Daftar Pelanggan</h5>
                <!-- Button Trigger Modal -->
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalPelangganBaru" style="float: right;">
                    + Pelanggan Baru
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table text-center">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Nomor Handphone</th>
                                <th>Alamat</th>
                                <th>Ubah</th>
                                <th>Hapus</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($pelanggan as $row => $data) : ?>
                                <?php $pelanggan_id = $data['id'] ?>
                                <tr>
                                    <td scope="row"><?php echo $no++; ?></td>
                                    <td><?php echo $data['nama_pelanggan'] ?></td>
                                    <td><?php echo $data['nohp'] ?></td>
                                    <td><?php echo $data['alamat'] ?></td>
                                    <td>
                                        <a href="" type="button" class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#modalUbahPelanggan<?php echo $pelanggan_id; ?>">Ubah</a>
                                        <!-- Modal Ubah Pelanggan -->
                                        <div class="modal fade" id="modalUbahPelanggan<?php echo $pelanggan_id ?>" role="dialog" style="font-family: 'PT Sans', sans-serif;">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="judulmodalUbahPelanggan<?php echo $pelanggan_id; ?>">Perubahan Transaksi</h5>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form role="form" action="<?= base_url('/dashboard/updatepelanggan') ?>" method="POST">
                                                                <input type="hidden" name="id" value="<?php echo $pelanggan_id; ?>">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" name="nama_pelanggan" value="<?php echo $data['nama_pelanggan']; ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" name="nohp" value="<?php echo $data['nohp']; ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" name="alamat" value="<?php echo $data['alamat']; ?>">
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="submit" class="btn btn-primary btn-block">Simpan Perubahan Pelanggan</button>
                                                                </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="" type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#modalHapusPelanggan<?php echo $pelanggan_id; ?>">Hapus</a>
                                        <!-- Modal Hapus Pelanggan -->
                                        <div class="modal fade" id="modalHapusPelanggan<?php echo $pelanggan_id ?>" role="dialog" style="font-family: 'PT Sans', sans-serif;">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="judulModalHapusPelanggan<?php echo $pelanggan_id; ?>">Hapus Pelanggan</h5>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="alert alert-danger" role="alert">
                                                            Apakah anda yakin untuk menghapus data pelanggan ini? Mohon pastikan kembali sebelum menghapus data
                                                        </div>
                                                        <form role="form" action="<?= base_url('/dashboard/deletepelanggan') ?>" method="POST">
                                                                <input type="hidden" name="id" value="<?php echo $pelanggan_id; ?>">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" disabled="true" value="<?php echo $data['nama_pelanggan']; ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" disabled="true" value="<?php echo $data['nohp']; ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" disabled="true" value="<?php echo $data['alamat']; ?>">
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="submit" class="btn btn-danger btn-block">Hapus Pelanggan</button>
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
                    <?= $pager->links('bootstrap', 'bootstrap_pagination') ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Pelanggan Baru -->
<div class="modal fade" id="modalPelangganBaru" tabindex="-1" role="dialog" aria-labelledby="modalPelangganBaru" aria-hidden="true" style="font-family: 'PT Sans', sans-serif;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="judulmodalPelangganBaru">Pelanggan Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?= base_url('/dashboard/registerpelanggan') ?>">
                    <input type="hidden" name="uri" value="<?php $uri = $_SERVER['REQUEST_URI'];
                                                            echo $uri; ?>">
                    <div class="form-group">
                        <input type="text" class="form-control" name="namaPelangganBaru" id="namaPelangganBaru" aria-describedby="namaPelangganBaru" placeholder="Nama Pelanggan">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="alamatPelangganBaru" id="alamatPelangganBaru" placeholder="Alamat">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="nomorHpPelangganBaru" id="nomorHpPelangganBaru" placeholder="Nomor Handphone">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Daftarkan Pelanggan</button>
                </form>
            </div>
        </div>
    </div>
</div>