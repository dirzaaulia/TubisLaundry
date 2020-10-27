<div class="d-flex" id="wrapper">
    <div id="page-content-wrapper">
        <nav class="navbar navbar-expand-lg navbar-light bg-primary border-bottom">
            <div class="container">
                <button class="navbar-toggler bg-light mr-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars"></i>
                </button>
                <a class="navbar-brand text-white mr-auto" href="#"><b>Tubis Laundry</b></a>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                        <li class="nav-item active">
                            <a class="nav-link text-white" href="<?= base_url() ?>">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="<?= base_url('/delivery') ?>"><b>Layanan Delivery</b></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div>

<div class="container" style="font-family: Balsamiq Sans, cursive;">
    <br>
    <div class="row">
        <div class="card mb-3" style="width: 100%;">
            <h5 class="card-header bg-primary text-white">Layanan Delivery</h5>
            <div class="card-body">
                <?php if (session()->get('success')) : ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert" style="width: 100%;">
                        <?= session()->get('success') ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>
                <p class="card-text">
                    Silahkan isi form berikut ini untuk layanan delivery
                </p>
                <form action="<?= base_url('/delivery/registerdelivery') ?>" method="POST">
                    <div class="form-group">
                        <input type="text" class="form-control" required="true" name="namaPelanggan" id="namaPelanggan" aria-describedby="namaPelanggan" placeholder="Nama Lengkap Pelanggan">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" required="true" name="alamatPelanggan" id="alamatPelanggan" placeholder="Alamat Pelanggan">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" required="true" name="nomorHpPelanggan" id="nomorHpPelanggan" placeholder="Nomor Handphone Pelanggan">
                    </div>
                    <div class="form-group">
                        <label>Pilih Lokasi Pelanggan</label>
                        <div id="map" style="width: 100%; height: 400px; float: none;"></div>
                    </div>
                    <input type="hidden" class="form-control" name="posisiLat" id="posisiLat" placeholder="Posisi Lat">
                    <input type="hidden" class="form-control" name="posisiLang" id="posisiLang" placeholder="Posisi Lang">
                    <div class="form-group">
                        <select class="form-control" name="layanan" id="layanan">
                            <option value="">Pilih Layanan</option>
                            <?php foreach ($layanan as $row => $data) : ?>
                                <option value="<?= $data['id'] ?>"><?= $data['nama_layanan'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-info btn-block">Submit Transaksi</button>
                </form>
            </div>
        </div>
    </div>
</div>

<footer class="page-footer font-small text-white pt-4 bg-primary">
    <div class="container text-center">
        Aplikasi Teknologi Online <br>
        Kelompok IF-11K-1 <br>
        UNIKOM <br><br>
    </div>
    <div class="footer-copyright text-center py-3">© 2020 Copyright:
        Kelompok IF-11K-1
    </div>
</footer>

<!-- Google Maps API -->
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyANKd9qmaATJbd6xKOvJHRuj70C5d6Eufs&callback=initMap&libraries=&v=weekly" defer></script>

<!-- JS Google Maps Delivery -->
<script>
    var map;
    var marker;

    function initMap() {
        //Membuat map baru pada lat dan lang tertentu dengan zoom tertentu
        map = new google.maps.Map(document.getElementById('map'), {
            center: new google.maps.LatLng(-6.885419, 107.622899),
            zoom: 12,
            scrollwheel: false,
        });

        map.addListener('click', function(event) {
            // get lat/lon of click
            var clickLat = event.latLng.lat();
            var clickLon = event.latLng.lng();

            // show in input box
            document.getElementById("posisiLat").value = clickLat.toFixed(5);
            document.getElementById("posisiLang").value = clickLon.toFixed(5);


            placeMarker(event.latLng);
        });

    }

    function placeMarker(location) {

        if (!marker) {

            marker = new google.maps.Marker({
                position: location,
                map: map,
                animation: google.maps.Animation.BOUNCE
            });

        } else {

            marker.setPosition(location);
        }
    }
</script>