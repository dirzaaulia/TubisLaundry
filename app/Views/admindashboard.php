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
                        <a class="nav-link text-white" href="<?= base_url("/dashboard") ?>"><b>Beranda</b></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="<?= base_url("/dashboard/pelanggan") ?>">Pelanggan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="<?= base_url("/dashboard/layanan") ?>">Layanan</a>
                    </li>
                <?php endif; ?>
                <?php if (session()->get('nama') == 'Admin') : ?>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="<?= base_url("/dashboard/pegawai") ?>">Pegawai</a>
                    </li>
                <?php endif; ?>
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
                <h5 style="float: left;">Daftar Transaksi</h5>
                <!-- Button Trigger Modal -->
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalTransaksiBaru" style="float: right;">
                    + Transaksi Baru
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table text-center">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode</th>
                                <th>Pelanggan</th>
                                <th>Layanan</th>
                                <th>Berat</th>
                                <th>Tanggal Masuk</th>
                                <th>Tanggal Selesai</th>
                                <th>Biaya</th>
                                <th>Biaya Antar</th>
                                <th>Total Biaya</th>
                                <th>Status</th>
                                <th>Ubah</th>
                            </tr>
                        </thead>
                        <?php
                        $kon = mysqli_connect("localhost", "root", "", "laundry");
                        $batas   = 10;
                        $halaman = @$_GET['halaman'];
                        if (empty($halaman)) {
                            $posisi  = 0;
                            $halaman = 1;
                        } else {
                            $posisi  = ($halaman - 1) * $batas;
                        }

                        $no = $posisi + 1;
                        $sql = "SELECT transaksi.id, transaksi.kode_transaksi, pelanggan.nama_pelanggan, layanan.nama_layanan, transaksi.berat, transaksi.tanggal_masuk, transaksi.tanggal_selesai, transaksi.biaya_antar, transaksi.biaya, transaksi.total_biaya, transaksi.status FROM transaksi,pelanggan,layanan WHERE pelanggan.id = transaksi.pelanggan_id AND layanan.id = transaksi.layanan_id ORDER BY transaksi.id DESC LIMIT $posisi,$batas";
                        $hasil = mysqli_query($kon, $sql);
                        while ($data = mysqli_fetch_array($hasil)) {
                        ?>
                            <?php $biaya_antar = "Rp." . number_format($data['biaya_antar'], 0, ',', '.') ?>
                            <?php $biaya = "Rp." . number_format($data['biaya'], 0, ',', '.') ?>
                            <?php $total_biaya = "Rp." . number_format($data['total_biaya'], 0, ',', '.') ?>
                            <?php $transaksi_id = $data['id']; ?>
                            <tbody>
                                <tr>
                                    <td scope="row"><?php echo $no; ?></td>
                                    <td><?php echo $data['kode_transaksi'] ?></td>
                                    <td><?php echo $data['nama_pelanggan'] ?></td>
                                    <td><?php echo $data['nama_layanan'] ?></td>
                                    <td><?php echo $data['berat'] ?></td>
                                    <td><?php echo $data['tanggal_masuk'] ?></td>
                                    <td><?php echo $data['tanggal_selesai'] ?></td>
                                    <td><?php echo $biaya ?></td>
                                    <td><?php echo $biaya_antar ?></td>
                                    <td><?php echo $total_biaya ?></td>
                                    <td><?php echo $data['status'] ?></td>
                                    <td>
                                        <a href="" type="button" class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#modalUbahTransaksi<?php echo $transaksi_id; ?>">Ubah</a>
                                        <!-- Modal Ubah Transaksi -->
                                        <div class="modal fade" id="modalUbahTransaksi<?php echo $transaksi_id ?>" role="dialog" style="font-family: 'PT Sans', sans-serif;">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="judulModalUbahTransaksi<?php echo $transaksi_id; ?>">Perubahan Transaksi</h5>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form role="form" action="<?= base_url('/dashboard/updatetransaksi') ?>" method="POST">
                                                            <?php
                                                            $kon = mysqli_connect("localhost", "root", "", "laundry");
                                                            $id = $transaksi_id;
                                                            $query = mysqli_query($kon, "SELECT transaksi.id, transaksi.pelanggan_id, transaksi.layanan_id, pelanggan.nama_pelanggan, layanan.nama_layanan, transaksi.berat, transaksi.tanggal_masuk, transaksi.tanggal_selesai, transaksi.biaya_antar, transaksi.biaya, transaksi.total_biaya, transaksi.status FROM transaksi,pelanggan,layanan WHERE pelanggan.id = transaksi.pelanggan_id AND layanan.id = transaksi.layanan_id AND transaksi.id = $id");
                                                            while ($row = mysqli_fetch_array($query)) {
                                                            ?>
                                                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                                                <input type="hidden" name="idPelangganLama" value="<?php echo $row['pelanggan_id']; ?>">
                                                                <input type="hidden" name="idLayananLama" value="<?php echo $row['layanan_id']; ?>">
                                                                <input type="hidden" name="beratLama" value="<?php echo $row['berat']; ?>">
                                                                <input type="hidden" name="biaya_antar" value="<?php echo $row['biaya_antar']; ?>">
                                                                <input type="hidden" name="statusLama" value="<?php echo $row['status']; ?>">
                                                                <div class="alert alert-primary" role="alert">
                                                                    Data yang tersimpan saat ini
                                                                </div>
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" disabled="true" value="<?php echo $row['nama_pelanggan']; ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" disabled="true" value="<?php echo $row['nama_layanan']; ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <input type="number" class="form-control" disabled="true" value="<?php echo $row['berat']; ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" disabled="true" value="<?php echo $row['status']; ?>">
                                                                </div>
                                                                <div class="dropdown-divider"></div>
                                                                <div class="alert alert-primary" role="alert">
                                                                    Isi form dibawah untuk melakukan perubahan data. Jika ada bagian yang tidak ingin diubah silahkan kosongkan atau biarkan pada pilihan awal.
                                                                </div>
                                                                <div class="form-group">
                                                                    <select class="form-control" name="pelangganUbah" id="pelangganUbah">
                                                                        <option value="">Pilih Pelanggan</option>
                                                                        <?php foreach ($pelanggan as $row => $data) : ?>
                                                                            <option value="<?= $data['id'] ?>"><?= $data['nama_pelanggan'] ?></option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <select class="form-control" name="layananUbah" id="layananUbah">
                                                                        <option value="">Pilih Layanan</option>
                                                                        <?php foreach ($layanan as $row => $data) : ?>
                                                                            <option value="<?= $data['id'] ?>"><?= $data['nama_layanan'] ?></option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <input type="number" class="form-control" name="beratUbah" id="beratUbah" min="1" placeholder="Berat Cucian / kg">
                                                                </div>
                                                                <div class="form-group">
                                                                    <select class="form-control" name="statusUbah" id="statusUbah">
                                                                        <option value="">Pilih Status</option>
                                                                        <option value="Selesai">Selesai</option>
                                                                        <option value="Diambil">Diambil</option>
                                                                        <option value="Delivery - Antar Cucian">Delivery - Antar Cucian</option>
                                                                    </select>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="submit" class="btn btn-primary btn-block">Simpan Perubahan Transaksi</button>
                                                                </div>
                                                            <?php
                                                            }
                                                            ?>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        <?php
                            $no++;
                        }
                        ?>
                    </table>
                    <?php
                    $query2     = mysqli_query($kon, "SELECT * FROM transaksi");
                    $jmldata    = mysqli_num_rows($query2);
                    $jmlhalaman = ceil($jmldata / $batas);
                    ?>
                    <div class="text-center">
                        <ul class="pagination">
                            <?php
                            for ($i = 1; $i <= $jmlhalaman; $i++) {
                                if ($i != $halaman) {
                                    echo "<li class='page-item'><a class='page-link' href='?halaman=$i'>$i</a></li>";
                                } else {
                                    echo "<li class='page-item active'><a class='page-link' href='#'>$i</a></li>";
                                }
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Pelanggan & Transaksi Baru -->
<div class="modal fade" id="modalTransaksiBaru" tabindex="-1" role="dialog" aria-labelledby="modalTransaksiBaru" aria-hidden="true" style="font-family: 'PT Sans', sans-serif;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="judulModalTransaksiBaru">Transaksi Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?= base_url('/dashboard/registerpelanggan') ?>">
                    <div class="alert alert-primary" role="alert">
                        Isi form dibawah ini terlebih dahulu jika data pelanggan belum ada.
                    </div>
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
                    <button type="submit" class="btn btn-info btn-block">Daftarkan Pelanggan</button>
                </form>
                <div class="dropdown-divider"></div>
                <form method="POST" action="<?= base_url('/dashboard/registertransaksi') ?>">
                    <div class="alert alert-primary" role="alert">
                        Isi form dibawah ini jika data pelanggan sudah ada.
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="pelanggan" id="pelanggan">
                            <option value="">Pilih Pelanggan</option>
                            <?php foreach ($pelanggan as $row => $data) : ?>
                                <option value="<?= $data['id'] ?>"><?= $data['nama_pelanggan'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="layanan" id="layanan">
                            <option value="">Pilih Layanan</option>
                            <?php foreach ($layanan as $row => $data) : ?>
                                <option value="<?= $data['id'] ?>"><?= $data['nama_layanan'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="number" class="form-control" name="berat" id="berat" min="1" placeholder="Berat Cucian / kg">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Tambahkan Transaksi</button>
                </form>
            </div>
        </div>
    </div>
</div>