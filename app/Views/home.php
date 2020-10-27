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
							<a class="nav-link text-white" href="<?= base_url() ?>"><b>Beranda</b></a>
						</li>
						<li class="nav-item">
							<a class="nav-link text-white" href="<?= base_url('/delivery') ?>">Layanan Delivery</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>
	</div>
</div>

<div class="container" style="font-family: Balsamiq Sans, cursive;">
	<div class="row">
		<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
			<ol class="carousel-indicators">
				<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
				<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
				<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
			</ol>
			<div class="carousel-inner">
				<div class="carousel-item active">
					<img class="d-block w-100" src="assets/image/carousel1.png" alt="First slide">
				</div>
				<div class="carousel-item">
					<img class="d-block w-100" src="assets/image//carousel2.png" alt="Second slide">
				</div>
				<div class="carousel-item">
					<img class="d-block w-100" src="assets/image/carousel3.png" alt="Third slide">
				</div>
			</div>
			<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			</a>
			<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			</a>
		</div>
	</div>
	<div class="row mt-5">
		<h3 class="text-primary">Selamat Datang Di Tubis Laundry</h3>
	</div>
	<div class="row">
		<div class="card mb-3" style="width: 100%;">
			<h5 class="card-header bg-primary text-white">Cek Order</h5>
			<div class="card-body">
				<p class="card-text">
					Input kode transaksi untuk melihat status orderan kamu
				</p>
				<form action="<?= base_url('/home/cekorder') ?>" method="POST">
					<div class="form-group">
						<input type="text" class="form-control" required="true" name="kode_transaksi" id="kode_transaksi" aria-describedby="kode_transaksi" placeholder="Kode Transaksi">
					</div>
					<button type="submit" class="btn btn-info btn-block">Cek Order</button>
				</form>
				<?php if (session()->get('success')) : ?>
					<script type="text/ javascript">
						alert(<?= session()->get('success') ?>);
					</script>
					<!--
					<p class="card-text">
						<div class="alert alert-success alert-dismissible fade show" role="alert" style="width: 100%;">
							<?= session()->get('success') ?>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					</p>
				-->
				<?php endif; ?>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="card mb-3" style="width: 100%;">
			<h5 class="card-header bg-primary text-white">Informasi Layanan</h5>
			<div class="card-body">
				<p class="card-text">
					Berikut layanan yang tersedia di Tubis Laundry
				</p>
				<table class="table table-hover">
					<thead>
						<tr>
							<th scope="col">No</th>
							<th scope="col">Layanan</th>
							<th scope="col">Biaya</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<th scope="row">1</th>
							<td>Cuci - Reguler</td>
							<td>Rp.2.500,- / kg</td>
						</tr>
						<tr>
							<th scope="row">2</th>
							<td>Cuci - Express</td>
							<td>Rp.5.000,- / kg</td>
						</tr>
						<tr>
							<th scope="row">3</th>
							<td>Cuci & Setrika - Reguler</td>
							<td>Rp.5.500,- / kg</td>
						</tr>
						<tr>
							<th scope="row">4</th>
							<td>Cuci & Setrika - Express</td>
							<td>Rp.7.000,- / kg</td>
						</tr>
					</tbody>
				</table>
				<p class="card-text">
					Tersedia juga tambahan layanan delivery. Biaya delivery akan menyesuaikan dengan jarak dari lokasi delivery dan Tubis Laundry.
				</p>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="card mb-3" style="width: 100%;">
			<h5 class="card-header bg-primary text-white">Hubungi Kami</h5>
			<div class="card-body">
				<div id="map" style="width: 100%; height: 400px; float: none;"></div><br>
				<p class="card-text">
					<i class="fa fa-map-marker" aria-hidden="true"></i>&ensp;<b>Lokasi : Jalan Tubagus Ismail Raya No.100A | Bandung</b>
				</p>
				<p class="card-text">
					<i class="fa fa-whatsapp" aria-hidden="true"></i>&ensp;<b>Whatsapp : 0812 2345 6789</b>
				</p>
				<p class="card-text">
					<i class="fa fa-instagram" aria-hidden="true"></i>&ensp;<b>Instagram : TubisLaundry</b>
				</p>
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

<!-- JS Google Maps Home -->
<script>
	function initMap() {
		var lokasi = {
			lat: -6.885419,
			lng: 107.622899
		};

		var map = new google.maps.Map(
			document.getElementById('map'), {
				zoom: 12,
				center: lokasi
			});

		var marker = new google.maps.Marker({
			position: lokasi,
			map: map
		});
	}
</script>