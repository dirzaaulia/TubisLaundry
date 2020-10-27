<?php

namespace App\Controllers;

use App\Models\LayananModel;
use App\Models\TransaksiModel;
use App\Models\PelangganModel;

class Delivery extends BaseController
{
	public function index()
	{
		$model = new LayananModel();

		$data = [
			'layanan'   => $model->findAll(),
		];

		echo view('templates/header', $data);
		echo view('delivery', $data);
		echo view('templates/footer', $data);
	}

	public function registerdelivery()
	{
		$model = new TransaksiModel();
		$model2 = new LayananModel();
		$model3 = new PelangganModel();

		$data = [
			'nama_pelanggan'	=> $this->request->getVar('namaPelanggan'),
			'alamat'      		=> $this->request->getVar('alamatPelanggan'),
			'nohp'        		=> $this->request->getVar('nomorHpPelanggan'),
		];

		$data = [
			'pelanggan' => $model3->where('nohp', $data['nohp'])
				->first()
		];

		$lat = $this->request->getVar('posisiLat');
		$lang = $this->request->getVar('posisiLang');

		$url = "https://maps.googleapis.com/maps/api/distancematrix/json?units=metric&origins=$lat,$lang&destinations=-6.885745,107.623124&key=AIzaSyANKd9qmaATJbd6xKOvJHRuj70C5d6Eufs";
		$json = file_get_contents($url);
		$json_data = json_decode($json);

		$jarak = $json_data->rows[0]->elements[0]->distance->value;

		if (!empty($data['pelanggan'])) {

			$data2 = [
				'layanan' => $model2->find($this->request->getVar('layanan'))
			];

			//$harga = $data2['layanan']['harga'];
			$durasi = $data2['layanan']['durasi'];
			$tanggal_masuk = date("Y-m-d");
			$tanggal_selesai = date("Y-m-d", strtotime("+$durasi days"));
			$kode = $data['pelanggan']['id'] . date("Ymd");

			if ($jarak <= 2000) {
				$biaya_antar = 4000;
			} else if ($jarak <= 5000) {
				$biaya_antar = 6000;
			} else if ($jarak <= 10000) {
				$biaya_antar = 8000;
			} else if ($jarak > 10000) {
				$biaya_antar = 10000;
			}

			$data = [
				'kode_transaksi'	=> $kode,
				'pelanggan_id'      => $data['pelanggan']['id'],
				'layanan_id'        => $this->request->getVar('layanan'),
				'tanggal_masuk'     => $tanggal_masuk,
				'tanggal_selesai'   => $tanggal_selesai,
				'biaya_antar'		=> $biaya_antar,
				'status'            => 'Delivery - Ambil Cucian',
			];

			$model->insert($data);
			$session = session();
			$session_string = "Transaksi berhasil ditambahkan. Mohon menunggu telfon dari pengemudi delivery kami yang akan menjemput barang kamu. Kode transaksi kamu yaitu " . $data['kode_transaksi'] . ". Kode transaksi dapat digunakan untuk melihat status orderan kamu.";
 			$session->setFlashdata('success', $session_string);
			return redirect()->to(base_url("/delivery"));

		} else {
			$data = [
				'nama_pelanggan'	=> $this->request->getVar('namaPelanggan'),
				'alamat'      		=> $this->request->getVar('alamatPelanggan'),
				'nohp'        		=> $this->request->getVar('nomorHpPelanggan'),
			];

			$model3->insert($data);
			
			$data = [
				'pelanggan' => $model3->where('nohp', $data['nohp'])
					->first()
			];


			$data2 = [
				'layanan' => $model2->find($this->request->getVar('layanan'))
			];

			//$harga = $data2['layanan']['harga'];
			$durasi = $data2['layanan']['durasi'];
			$tanggal_masuk = date("Y-m-d");
			$tanggal_selesai = date("Y-m-d", strtotime("+$durasi days"));
			$kode = $data['pelanggan']['id'] . date("Ymd");

			if ($jarak <= 2000) {
				$biaya_antar = 4000;
			} else if ($jarak <= 5000) {
				$biaya_antar = 6000;
			} else if ($jarak <= 10000) {
				$biaya_antar = 8000;
			} else if ($jarak > 10000) {
				$biaya_antar = 10000;
			}

			$data = [
				'kode_transaksi'	=> $kode,
				'pelanggan_id'      => $data['pelanggan']['id'],
				'layanan_id'        => $this->request->getVar('layanan'),
				'tanggal_masuk'     => $tanggal_masuk,
				'tanggal_selesai'   => $tanggal_selesai,
				'biaya_antar'		=> $biaya_antar,
				'status'            => 'Delivery - Ambil Cucian',
			];

			$model->insert($data);
			$session = session();
			$session_string = "Transaksi berhasil ditambahkan. Mohon menunggu telfon dari pengemudi delivery kami yang akan menjemput barang kamu. Kode transaksi kamu yaitu " . $data['kode_transaksi'] . ". Kode transaksi dapat digunakan untuk melihat status orderan kamu.";
 			$session->setFlashdata('success', $session_string);
			return redirect()->to(base_url("/delivery"));
		}
	}
}
